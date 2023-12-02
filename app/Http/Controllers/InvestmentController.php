<?php

namespace App\Http\Controllers;

use App\DataTables\InvestmentDataTable;
use App\Models\BackupInvestment;
use App\Models\BankInfo;
use App\Models\BankName;
use App\Models\BankTransaction;
use App\Models\Investment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    public function __construct() {
        $this->middleware('permission:investment-list|new-investment|investment-edit|investment-view', ['only' => ['index', 'create', 'store', 'edit', 'update', 'show']]);
        $this->middleware('permission:new-investment', ['only' => ['create', 'store']]);
        $this->middleware('permission:investment-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:investment-view', ['only' => ['show']]);
    }

    public function index(InvestmentDataTable $investmentDataTable) // view('modules.modal')
    {
        $data['page'] = 'index';
        $data['title'] = 'Investments';
        if(auth()->user()->can('investment-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = 'Investment Detail';
            $data['modal_type'] = 'investment';
            $data['modalbodyClass'] = 'p-0';
            $investmentDataTable->setModaltype($data['modal_type']);
        }
        return $investmentDataTable->render('home', $data);
    }

    public function show(string $id) {//view('investment.show')
        if(request()->ajax()) {
            $data['investment'] = Investment::with(array_merge(['investor', 'entrier'], BankTransaction::JOINTABLES))->findorfail($id);
            return view('investment.show', $data)->render();
        } else abort(404);
    }

    public function create() {// view('investment.create')
        $data['title'] = 'New Investment';
        $data['page'] = 'investment.create';
        $data['bankNames'] = BankName::where('status', 1)->get(['id', 'name']);
        return view('home', $data);
    }

    public function edit(string $id) {//view('investment.edit')
        $data['investment'] = Investment::with(array_merge(['investor'], BankTransaction::JOINTABLES))->findorfail($id);
        $data = array_merge($data, bankDetails($data['investment']));
        $data['title'] = 'Edit Investment';
        $data['page'] = 'investment.edit';
        return view('home', $data);
    }

    public function update(Request $request, string $id) {
        $invesment = Investment::with('bank_transaction', 'bank_transaction.bank_info', 'investor')->findorfail($id);
        return $this->upstore($request, $invesment);
    }

    public function store(Request $request) { return $this->upstore($request, new Investment); }

    public function upstore($request, $invesment)
    {
        $input = $this->validation($request);
        $input['date'] = formatdate($input['date']);
        DB::beginTransaction();
        try {
            if(isUpdate()) {
                $status = key_exists('status', $input) ? 1 : 0;
                $investor = $invesment->investor;
                if($status == 0 && $invesment->status == 1) {
                    $input['amount'] = $invesment->bank_transaction->amount;
                    $investor->income = (int) $investor->income + (int) $invesment->bank_transaction->amount;
                    $investor->save();
                } else if($status == 1 && $invesment->status == 0) {
                    if((int) $invesment->bank_transaction->amount > (int) $investor->income) return redirect()->back()->with(['message' => 'Investor Not Enough Balance.', 'alert-type' => 'error']);;
                    $investor->income = (int) $investor->income - (int) $invesment->bank_transaction->amount;
                    $investor->save();
                } 
                $invesment->status = $status;
                BackupInvestment::store($invesment, $input['comment']);
                BankInfo::updateOldPayment($invesment->bank_transaction->amount, $invesment->bank_transaction->bank_info);
            }
            $invesment->account_id = autoIdGenerator('investments');
            $invesment->investor_id  = $input['investor_id'];
            $invesment->rate = $input['rate'];
            $invesment->duration = $input['duration'];
            $invesment->duration_in = $input['duration_in'];
            $invesment->invest_at = $input['date'];
            if(array_key_exists('document', $input)) {
                if(isUpdate()) $invesment->document = newuploadFile('investment/', $invesment->account_id, $input['document'], $invesment->document);
                else $invesment->document = newuploadFile('investment/', $invesment->account_id, $input['document']);
            }
            $invesment->entry = entry();
            $invesment->save();
            $input['status'] = 1;
            $input['model_type'] = get_class($invesment);
            $input['model_id'] = $invesment->id;
            BankTransactionController::upstore($input);
            BankInfo::updateAmount($input);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with(['message' => 'Investment Failed. Please try again!', 'alert-type' => 'error']);
        }
        $msg = (isUpdate()) ? 'Investment Update Successfully.' : 'Investment Create Successfully.';
        return redirect()->route('investment.index')->with(['message' => $msg, 'alert-type' => 'success']);
    }

    public function validation($request) 
    {
        $validate['rate'] = ['required', 'max:100'];
        $validate['duration'] = ['required', 'max:100'];
        $validate['duration_in'] = ['required'];
        $validate['date'] = ['required'];
        $validate['investor_id'] = ['required'];
        $validate['document'] = ['nullable'];
        $validate['status'] = ['nullable'];
        $validate = array_merge($validate, BankTransactionController::validation($request));
        return $request->validate($validate, [ 'date' => 'Investment time is required.', 'investor_id' => 'Investor is required.' ]);
    }
}
