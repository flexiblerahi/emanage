<?php

namespace App\Http\Controllers;

use App\DataTables\SalaryDataTable;
use App\Models\BackupSalary;
use App\Models\BankInfo;
use App\Models\BankName;
use App\Models\BankTransaction;
use App\Models\Salary;
use App\Models\SalaryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SalaryController extends Controller
{
    public function __construct() {
        $this->middleware('permission:salary-list|new-salary|salary-edit|salary-view', ['only' => ['index', 'create', 'store', 'edit', 'update', 'show']]);
        $this->middleware('permission:new-salary', ['only' => ['create', 'store']]);
        $this->middleware('permission:salary-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:salary-view', ['only' => ['show']]);
    }
    
    public function index(SalaryDataTable $salaryDataTable) {//view('salary.index')
        $data['title'] = 'Salaries';
        $data['page'] = 'index';
        if(auth()->user()->can('salary-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = 'Salary Detail';
            $data['modal_type'] = 'salary';
        }
        $salaryDataTable->setModaltype($data['modal_type']);
        return $salaryDataTable->render('home', $data);
    }

    public function show(string $id) { //view('salary.show')
        if(request()->ajax()) {
            $data['salary'] = Salary::with(array_merge(['entrier', 'user'], BankTransaction::JOINTABLES))->findorfail($id);
            return view('salary.show', $data)->render();
        } else abort(404);
    }

    public function create() { //view('salary.create')
        $data['title'] = 'New Salary';
        $data['page'] = 'salary.create';
        $data['bankNames'] = BankName::where('status', 1)->get(['id', 'name']);
        $data['salaryTypes'] = SalaryType::where('status', 1)->get(['id', 'title']);
        return view('home', $data);
    }

    public function edit(string $id) { //view('salary.edit')
        $data['salary'] = $salary = Salary::with(array_merge(['user'], BankTransaction::JOINTABLES))->findorfail($id);
        if(is_null($salary->type_id)) { //check if it is main salary.
            $data['other_salary'] = Salary::with('bank_transaction')->where('group_id', $salary->id)->first();
        }
        else { // if it is other salary.
            $data['main_salary'] = (is_null($salary->group_id)) ? null : Salary::with('bank_transaction')->find($salary->group_id);
        }
        $data['title'] = 'Edit Salary';
        $data['page'] = 'salary.edit';
        $data['salaryTypes'] = SalaryType::where('status', 1)->get(['id', 'title']);
        $data = array_merge($data, bankDetails($data['salary']));
        return view('home', $data);
    }

    public function store(Request $request) {
        $input = $this->validation($request);
        // dd($input, $salary);
        $input['date'] = formatdate($input['date']);
        $other_amount = is_null($input['other_amount']) ? 0 : (int) $input['other_amount'];
        $salary_amount = is_null($input['salary_amount']) ? 0 : (int) $input['salary_amount'];
        $total_amount = $other_amount + $salary_amount;
        $bankInfo = BankInfo::find($input['bank_infos_id']);
        $chk_balance = checkBalance($total_amount, $bankInfo['amount']);
        if(array_key_exists('message', $chk_balance)) return redirect()->back()->with(array_merge($chk_balance, ['alert-type' => 'error']));

        DB::beginTransaction();
        try {
            //salary amount
            $salary = new Salary();
            $input['model_type'] = get_class($salary);
            $input['status'] = 0;
            if(!is_null($input['salary_amount'])) {
                $salary->user_detail_id = $input['user_id'];
                $salary->monthly = $input['monthly'];
                $salary->entry = entry();
                $salary->save();
                $input['amount'] = $input['salary_amount'];
                $input['model_id'] = $salary->id;
                BankTransactionController::upstore($input);
                BankInfo::updateAmount($input);
            }
            if(!is_null($input['other_amount'])) {
                $other_salary = new Salary();
                $other_salary->user_detail_id = $input['user_id'];
                $other_salary->type_id = $input['type_id'];
                $other_salary->group_id = is_null($input['salary_amount']) ? null : $salary->id;
                $other_salary->entry = entry();
                $other_salary->save();
                $input['amount'] = $input['other_amount'];
                $input['model_id'] = $other_salary->id;
                BankTransactionController::upstore($input);
                BankInfo::updateAmount($input);
            }
            DB::commit();
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollback();
            return redirect()->back()->with(['message' => 'Salary Update Failed', 'alert-type' => 'error']);
        }
        $msg = isUpdate() ? 'Salary Update Successfully' : 'Salary Create Successfully';
        // return response()->json(['message' => $msg, 'amount' => $user_details->income]);
        return to_route('salary.index')->with(['message' => $msg, 'alert-type' => 'success']);
    }

    public function update(Request $request, string $id) {

        $salary = Salary::with(array_merge(['user'], BankTransaction::JOINTABLES))->findorfail($id);
        $input = $salaryInput = $this->validation($request);
        $input['date'] = $salaryInput['date'] = formatdate($input['date']);
        $input['model_type'] = $salaryInput['model_type'] = get_class($salary);
        $input['status'] = $salaryInput['status'] = 0;
        //initial validation
        $other_amount = is_null($input['other_amount']) ? 0 : (int) $input['other_amount'];
        $salary_amount = is_null($input['salary_amount']) ? 0 : (int) $input['salary_amount'];
        $total_amount = $other_amount + $salary_amount;
        $bankInfo = BankInfo::find($input['bank_infos_id']);
        $chk_balance = checkBalance($total_amount, $bankInfo['amount']);
        if(array_key_exists('message', $chk_balance)) return redirect()->back()->with(array_merge($chk_balance, ['alert-type' => 'error']));
        // get previous value for backup
        $other_salary = null;
        $main_salary = null;
        if(is_null($salary->type_id)) { //if salary is main salary.
            $other_salary = Salary::with(BankTransaction::JOINTABLES)->where('group_id', $salary->id)->first();
        } else {
            if(!is_null($salary->group_id)) { // if salary is other salary.
                $main_salary = Salary::with(BankTransaction::JOINTABLES)->find($salary->group_id);
            }
        }
        DB::beginTransaction();
        try {
            BackupSalary::store($salary, $input['comment']);
            $bankInfo = BankInfo::updateOldPayment($salary->bank_transaction->amount, $salary->bank_transaction->bank_info);
            if(is_null($salary->type_id)) { // if salary is main salary.
                if(is_null($other_salary)) {
                    if(!is_null($input['other_amount'])) {
                        $other_salary = new Salary();
                        $other_salary->user_detail_id = $input['user_id'];
                        $other_salary->type_id = $input['type_id'];
                        $other_salary->group_id = is_null($input['salary_amount']) ? null : $salary->id;
                        $other_salary->entry = entry();
                        $other_salary->save();
                        $input['amount'] = $input['other_amount'];
                        $input['model_id'] = $other_salary->id;
                        BankTransactionController::upstore($input, true);
                        $bankInfo = BankInfo::updateAmount($input, $bankInfo);
                    }
                } else {
                    BackupSalary::store($other_salary, $input['comment']);
                    $bankInfo = BankInfo::updateOldPayment($other_salary->bank_transaction->amount, $bankInfo);
                    $other_salary->user_detail_id = $input['user_id'];
                    $other_salary->type_id = $input['type_id'];
                    $other_salary->entry = entry();
                    $other_salary->save();
                    $input['amount'] = is_null($input['other_amount']) ? 0 : $input['other_amount'];
                    $input['model_id'] = $other_salary->id;
                    BankTransactionController::upstore($input);
                    $bankInfo = BankInfo::updateAmount($input, $bankInfo);
                }
                $salaryInput['amount'] = is_null($salaryInput['salary_amount']) ? 0 : $salaryInput['salary_amount'];
            } else { // if salary is other salary.
                if(is_null($main_salary)) {
                    if(!is_null($input['salary_amount'])) {
                        $main_salary = new Salary();
                        $main_salary->user_detail_id = $input['user_id'];
                        $main_salary->entry = entry();
                        $main_salary->monthly = $input['monthly'];
                        $main_salary->save();
                        $input['amount'] = $input['salary_amount'];
                        $input['model_id'] = $main_salary->id;
                        BankTransactionController::upstore($input, true);
                        $bankInfo = BankInfo::updateAmount($input, $bankInfo);
                        $salary->group_id = $main_salary->id; 
                    }
                } else {
                    BackupSalary::store($main_salary, $input['comment']);
                    $bankInfo = BankInfo::updateOldPayment($main_salary->bank_transaction->amount, $bankInfo);
                    $main_salary->user_detail_id = $input['user_id'];
                    $main_salary->entry = entry();
                    $main_salary->monthly = $input['monthly'];
                    $main_salary->save();
                    $input['amount'] = is_null($input['salary_amount']) ? 0 : $input['salary_amount'];
                    $input['model_id'] = $main_salary->id;
                    BankTransactionController::upstore($input);
                    $bankInfo = BankInfo::updateAmount($input, $bankInfo);
                }
                $salary->type_id = $salaryInput['type_id'];
                $salaryInput['amount'] = is_null($salaryInput['other_amount']) ? 0 : $salaryInput['other_amount'];
            }
            $salary->user_detail_id = $salaryInput['user_id'];
            $salary->entry = entry();
            $salary->save();
            $salaryInput['model_id'] = $salary->id;
            BankTransactionController::upstore($salaryInput);
            BankInfo::updateAmount($salaryInput, $bankInfo);

            DB::commit();
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollback();
            return redirect()->route('salary.index')->with(['message' => 'Salary Update Failed', 'alert-type' => 'error']);
        }
        return redirect()->route('salary.index')->with(['message' => 'Salary Update Successfully!', 'alert-type' => 'success']);
    }

    public function validation($request) {
        $validate['user_id'] = ['required'];
        $validate['other_amount'] = ['nullable'];
        $validate['salary_amount'] = ['nullable'];
        $validate['date'] = ['required'];
        $validate['type_id'] = is_null($request->input('other_amount')) ? ['nullable'] : ['required'];
        $validate['monthly'] = is_null($request->input('salary_amount')) ? ['nullable'] : ['required'];
        $validate = array_merge($validate, BankTransactionController::validation($request));
        if(!is_null($request->input('other_amount')) || !is_null($request->input('salary_amount'))) {
            unset($validate['amount']);
        }
        return $request->validate($validate, ['bank_infos_id' => 'Bank Account Not selected']);
    }
}