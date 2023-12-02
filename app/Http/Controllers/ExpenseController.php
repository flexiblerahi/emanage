<?php

namespace App\Http\Controllers;

use App\DataTables\ExpenseDataTable;
use App\Models\BackupExpense;
use App\Models\BankInfo;
use App\Models\BankName;
use App\Models\BankTransaction;
use App\Models\Expense;
use App\Models\ExpenseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function __construct() {
        $this->middleware('permission:expense-list|new-expense|expense-edit|expense-view', ['only' => ['index', 'create', 'store', 'edit', 'update', 'show']]);
        $this->middleware('permission:new-expense', ['only' => ['create', 'store']]);
        $this->middleware('permission:expense-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:expense-view', ['only' => ['show']]);
    }

    public function index(ExpenseDataTable $expenseDataTable) // view('modules.modal')
    {
        
        $data = ['page' => 'index', 'title' => 'Expenses'];
        if(auth()->user()->can('expense-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = 'Expense Detail';
            $data['modal_type'] = 'expense';
            $expenseDataTable->setModaltype($data['modal_type']);
        }
        return $expenseDataTable->render('home', $data);
    }

    public function show($id) {//view('expense.show')
        if(request()->ajax()) {
            $data['expense'] = $expense = Expense::with(array_merge(['type', 'entrier'], BankTransaction::JOINTABLES))->findorfail($id);
            if(!is_null($expense->type->parents)) $data['parentTitles'] =  printNestedArray($expense->type->parents->toArray());
            return view('expense.show', $data)->render();
        } else abort(404);
    }

    public function create() {// view('expense.create')
        $data['title'] = 'New Expense';
        $data['page'] = 'expense.create';
        $data['expenseItems'] = ExpenseItem::whereNull('parent')->get(['id', 'title']);
        $data['bankNames'] = BankName::where('status', 1)->get(['id', 'name']);
        return view('home', $data);
    }

    public function edit(string $id) {// view('expense.edit')
        $data['expense'] = $expense = Expense::with(array_merge(['type'], BankTransaction::JOINTABLES))->findorfail($id);
        $typesParents = $this->getAllParentKeyValue($expense->type->toArray());
        sort($typesParents);
        $typesParents[] = $expense->type->id;
        $data['typesParents'] = $typesParents;
        $data['expenseItem'] = $data['expense']->type;
        $data['title'] = 'Edit Expense';
        $data['page'] = 'expense.edit';
        $data['expenseTypes'] = ExpenseItem::whereIn('parent', $typesParents)->orWhereNull('parent')->get(['id', 'title', 'parent']);
        $data = array_merge($data, bankDetails($data['expense']));
        return view('home', $data);
    }

    public function getAllParentKeyValue($array, &$result = []) {
        foreach ($array as $key => $value) {
            if ($key == 'parents' && !is_null($value)) $this->getAllParentKeyValue($value, $result);
            elseif ($key == 'parent' ) $result[] = $value;
        }
        return $result;
    }

    public function update(Request $request, string $id) { return $this->upstore($request, $id); }
    
    public function store(Request $request) { return $this->upstore($request); }

    private function upstore($request, $id = null)
    {
        $input = $this->validation($request);
        $input['date'] = formatdate($input['date']);
        $bankInfo = BankInfo::find($input['bank_infos_id']);
        $chk_balance = checkBalance($input['amount'], $bankInfo['amount']);
        if(array_key_exists('message', $chk_balance)) return redirect()->back()->with(array_merge($chk_balance, ['alert-type' => 'error']));
        DB::beginTransaction();
        try {
            if(is_null($id)) {
                $expense = new Expense();
                $latest = autoIdGenerator('expenses', true);
            } else {
                $expense = Expense::with('bank_transaction', 'bank_transaction.bank_info')->findorfail($id);
                BackupExpense::store($expense, $input['comment']);
                BankInfo::updateOldPayment($expense->bank_transaction->amount, $expense->bank_transaction->bank_info);
            }
            $expense->expense_item_id = $input['expense_item_id'];
            $expense->entry = entry();
            if(array_key_exists('document', $input)) {
                if(is_null($id)) $expense->document = newuploadFile('expense/', $latest, $input['document']);
                else $expense->document = newuploadFile('expense/', $expense->id, $input['document'], $expense->document);
            }
            $expense->save();
            $input['status'] = 0;
            $input['model_type'] = get_class($expense);
            $input['model_id'] = $expense->id;
            BankTransactionController::upstore($input);
            BankInfo::updateAmount($input);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('expense.create')->with(['message' => 'Error '. $e, 'alert-type' => 'error']);
        }
        $msg = is_null($id) ? 'Expense Create Successfully.' : 'Expense Updated Successfully.';
        return redirect()->route('expense.index')->with(['message' => $msg, 'alert-type' => 'success']);
    }

    private function validation($request) 
    {
        $validate['document'] = ['nullable'];
        $validate['date'] = ['required'];
        $validate['expense_item_id'] = ['required'];
        $validate = array_merge($validate, BankTransactionController::validation($request));
        return $request->validate($validate, [ 'expense_item_id' => 'Expense Type must be is required.' ]);
    }
}
