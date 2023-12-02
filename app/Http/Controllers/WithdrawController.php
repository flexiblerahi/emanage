<?php

namespace App\Http\Controllers;

use App\DataTables\TransactionDataTable;
use App\Models\BackupTransaction;
use App\Models\BankInfo;
use App\Models\BankName;
use App\Models\BankTransaction;
use App\Models\Transaction;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function __construct() {
        $this->middleware('permission:withdraw-list|new-withdraw|withdraw-edit', ['only' => ['index', 'create', 'store', 'edit', 'update']]);
        $this->middleware('permission:new-withdraw', ['only' => ['create', 'store']]);
        $this->middleware('permission:withdraw-edit', ['only' => ['update', 'edit']]);
    }

    public function index(TransactionDataTable $transactionDataTable) //view('index')
    {
        $data['page'] = 'index';
        $data['title'] = 'Withdraw';
        $data['modal'] = 'modules.modal';
        $data['modal_title'] = 'Withdraw Detail';
        $data['modal_type'] = 'withdraw';
        $data['modalbodyClass'] = 'p-0';
        $transactionDataTable->setModaltype($data['modal_type']);
        return $transactionDataTable->render('home', $data);
    }

    public function show(string $id) {
        if(request()->ajax()) {
            $data['withdraw'] = Transaction::with(array_merge(['user', 'entrier'], BankTransaction::JOINTABLES))->findorfail($id);
            return view('withdraw.show', $data)->render();
        } else abort(404);
    }

    public function create(Request $request) {//view('withdraw.create') //view('withdraw.manager')
        if($request->has('manager')) {
            $data['auth_user_details'] = UserDetail::where('role', 1)->first();
            $data['page'] = 'withdraw.manager';
            $data['title'] = 'Withdraw Manager';
        } else {
            $data['page'] = 'withdraw.create';
            $data['title'] = 'New Withdraw';
        }
        $data['bankNames'] = BankName::where('status', 1)->get(['id', 'name']);
        return view('home', $data);
    }

    public function store(Request $request) { return $this->uporsave($request); }
    
    public function update(Request $request, string $id) { return $this->uporsave($request, $id); }

    public function edit($id) {//view('withdraw.edit')
        $data['withdraw'] = Transaction::with(array_merge(['user'], BankTransaction::JOINTABLES))->findOrFail($id);
        $data['page'] = 'withdraw.edit';
        $data['title'] = 'Edit Withdraw';
        $data = array_merge($data, bankDetails($data['withdraw']));
        return view('home', $data);
    }

    public function uporsave($request, $id = null) {
        $input = $this->validation($request, $id);
        $input['date'] = formatdate($input['date']);
        $input['status'] = 0;
        $user_details = UserDetail::find($input['withdraw_user']);
        $bankInfo = BankInfo::find($input['bank_infos_id']);
        $chk_balance = checkBalance($input['amount'], $bankInfo['amount'], $user_details['income']);
        if(array_key_exists('message', $chk_balance)) return response()->json($chk_balance, 422);
        DB::beginTransaction();
        try {
            if(is_null($id)) $withdraw = new Transaction();
            else {
                $withdraw = Transaction::with('user', 'bank_transaction', 'bank_transaction.bank_info')->findorfail($id);
                $olduserwithdraw = $withdraw->user;
                $updateIncome = (int) $olduserwithdraw->income + (int) abs($withdraw->bank_transaction->amount);
                $olduserwithdraw->income = $updateIncome;
                $olduserwithdraw->save();
                $user_details = UserDetail::find($input['withdraw_user']);
                BackupTransaction::store($withdraw, $request->input('comment'));
                BankInfo::updateOldPayment($withdraw->bank_transaction->amount, $withdraw->bank_transaction->bank_info);
            }
            $withdraw->user_details_id = $user_details->id;
            $current_balance = $user_details->income - (double) $input['amount'];
            $withdraw->amount = -$input['amount'];
            $withdraw->model_type = 'App\Withdraw';
            $withdraw->date = $input['date'];
            $withdraw->status = $input['status'];
            $withdraw->entry = entry();
            $withdraw->save();
            $user_details->income = $current_balance;
            $user_details->save();

            $input['model_type'] = get_class($withdraw);
            $input['model_id'] = $withdraw->id;
            BankTransactionController::upstore($input);
            BankInfo::updateAmount($input);
            DB::commit();
        } catch (\Exception $e) {
            // Something went wrong, rollback the transaction
            DB::rollback();
            return response()->json(['message' => 'Withdraw Failed. Please Try again'], 422);
        }
        $msg = is_null($id) ? 'Withdraw Request Successfully' : 'Withdraw Update Successfully';
        return response()->json(['message' => $msg, 'amount' => $user_details->income]);
    }

    public function validation($request) {
        $validate['withdraw_user'] = ['required'];
        $validate['date'] = ['required'];
        $validate = array_merge($validate, BankTransactionController::validation($request));
        return $request->validate($validate, ['bank_infos_id' => 'Bank Account Not selected']);
    }
}