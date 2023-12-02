<?php

namespace App\Http\Controllers;

use App\DataTables\OtherDepositDataTable;
use App\Models\BackupOtherDeposit;
use App\Models\BankInfo;
use App\Models\BankName;
use App\Models\BankTransaction;
use App\Models\OtherDeposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositOtherController extends Controller
{
    public function __construct() {
        $this->middleware('permission:other-deposit-list|new-other-deposit|other-deposit-edit|other-deposit-view', ['only' => ['index', 'create', 'store', 'edit', 'update', 'show']]);
        $this->middleware('permission:new-other-deposit', ['only' => ['create', 'store']]);
        $this->middleware('permission:other-deposit-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:other-deposit-view', ['only' => ['show']]);
    }

    public function index(OtherDepositDataTable $otherDepositDataTable)
    {
        $data['page'] = 'index';
        $data['title'] = 'Other Deposits';
        if(auth()->user()->can('other-deposit-view')) {
            $data['modal'] = 'modules.modal';
            $data['modal_title'] = 'Other Deposit Detail';
            $data['modal_type'] = 'depositother';
            $data['modalbodyClass'] = 'p-0';
            $otherDepositDataTable->setModaltype($data['modal_type']);
        }
        return $otherDepositDataTable->render('home', $data);
    }

    public function show(string $id) {
        $data['depositother'] = OtherDeposit::with(array_merge(['entrier'], BankTransaction::JOINTABLES))->findorfail($id);
        if(request()->ajax()) {
            return view('depositother.show', $data)->render();
        } else abort(404);
    }

    public function create() { //view('depositother.create')
        $data['title'] = 'New Deposit';
        $data['page'] = 'depositother.create';
        $data['bankNames'] = BankName::where('status', 1)->get(['id', 'name']);
        return view('home', $data);
    }
    
    public function edit(string $id) { //view('depositother.edit')
        $data['depositOther'] = OtherDeposit::with(BankTransaction::JOINTABLES)->findorfail($id);
        $data = array_merge($data, bankDetails($data['depositOther']));
        $data['title'] = 'Edit Deposit';
        $data['page'] = 'depositother.edit';
        return view('home', $data);
    }

    public function store(Request $request) { return $this->upstore($request); }

    public function update(Request $request, string $id) { return $this->upstore($request, $id); } 

    public function upstore($request, $id = null) {
        $input = $this->validation($request);
        $input['date'] = formatdate($input['date']); 
        DB::beginTransaction();
        try {
            if(is_null($id)) {
                $otherDeposit = new OtherDeposit();
                $otherDeposit->account_id = autoIdGenerator('other_deposits');
                if(array_key_exists('document', $input)) $otherDeposit->document = newuploadFile('otherdeposit/', $otherDeposit->account_id, $input['document']);
            } else {
                $otherDeposit = OtherDeposit::with('bank_transaction', 'bank_transaction.bank_info')->findorfail($id);
                BackupOtherDeposit::store($otherDeposit, $input['comment']);
                BankInfo::updateOldPayment($otherDeposit->bank_transaction->amount, $otherDeposit->bank_transaction->bank_info);
                if(array_key_exists('document', $input)) $otherDeposit->document = newuploadFile('otherdeposit/', $otherDeposit->account_id, $input['document'], $otherDeposit->document);
            }
            $otherDeposit->other = $input['other_deposit'];
            $otherDeposit->entry = entry();
            $otherDeposit->save();
            $input['status'] = 1;
            $input['model_type'] = get_class($otherDeposit);
            $input['model_id'] = $otherDeposit->id;
            BankTransactionController::upstore($input);
            BankInfo::updateAmount($input);
            DB::commit();
        } catch (\Exception $e) {
            return redirect()->back()->with(['message' => 'New Deposit Other Failed. Please try again!', 'alert-type' => 'error']);
        }
        $msg = (is_null($id)) ? 'Deposit Other Create Successfully.' : 'Deposit Other Update Successfully.';
        return redirect()->route('deposit-other.index')->with(['message' => $msg, 'alert-type' => 'success']);
    }

    public function validation($request) 
    {
        $validate['date'] = ['required'];
        $validate['other_deposit'] = ['nullable'];
        $validate['document'] = ['nullable'];
        $validate = array_merge($validate, BankTransactionController::validation($request));
        return $request->validate($validate);
    }
}