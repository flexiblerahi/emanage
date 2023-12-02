<?php

namespace App\Http\Controllers;

use App\DataTables\InvestmentWithdrawDataTable;
use App\Models\InvestmentWithdraw;
use App\Models\BackupTransaction;
use App\Models\BankInfo;
use App\Models\BankName;
use App\Models\BankTransaction;
use App\Models\Investor;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestmentWithdrawController extends Controller
{
    public function index(InvestmentWithdrawDataTable $investmentWithdrawDataTable) //view('index')
    {
        $data['page'] = 'index';
        $data['title'] = 'Investment Withdraw';
        $data['modal'] = 'modules.modal';
        $data['modal_title'] = 'Withdraw Detail';
        $data['modal_type'] = 'withdraw';
        $data['modalbodyClass'] = 'p-0';
        $investmentWithdrawDataTable->setModaltype($data['modal_type']);
        return $investmentWithdrawDataTable->render('home', $data);
    }

    public function show(string $id) {
        if(request()->ajax()) {
            $data['withdraw'] = Transaction::with(array_merge(['user', 'entrier'], BankTransaction::JOINTABLES))->findorfail($id);
            return view('withdraw.show', $data)->render();
        } else abort(404);
    }

    public function create() {//view('withdraw.investor.create') //view('withdraw.manager')
        $data['page'] = 'withdraw.investor.create';
        $data['title'] = 'New Withdraw';
        $data['bankNames'] = BankName::where('status', 1)->get(['id', 'name']);
        return view('home', $data);
    }

    public function store(Request $request) { return $this->uporsave($request); }
    
    public function update(Request $request, string $id) { return $this->uporsave($request, $id); }

    public function edit($id) {//view('withdraw.investor.edit')
        $data['withdraw'] = Transaction::with(array_merge(['investor'], BankTransaction::JOINTABLES))->findOrFail($id);
        $data['page'] = 'withdraw.investor.edit';
        $data['title'] = 'Edit Withdraw';
        $data = array_merge($data, bankDetails($data['withdraw']));
        return view('home', $data);
    }

    public function uporsave($request, $id = null) {
        $input = $this->validation($request, $id);
        $input['date'] = formatdate($input['date']);
        $input['status'] = 0;
        $investor = Investor::find($input['investor_id']);
        $bankInfo = BankInfo::find($input['bank_infos_id']);
        $chk_balance = checkBalance($input['amount'], $bankInfo['amount'], $investor['income']);
        if(array_key_exists('message', $chk_balance)) return response()->json($chk_balance, 422);
        DB::beginTransaction();
        try {
            if(is_null($id)) $withdraw = new Transaction();
            else {
                $withdraw = Transaction::with('investor', 'bank_transaction', 'bank_transaction.bank_info')->findorfail($id);
                $olduserwithdraw = $withdraw->investor;
                $updateIncome = (int) $olduserwithdraw->income + (int) abs($withdraw->bank_transaction->amount);
                $olduserwithdraw->income = $updateIncome;
                $olduserwithdraw->save();
                $investor = Investor::find($input['investor_id']);
                BackupTransaction::store($withdraw, $request->input('comment'));
                BankInfo::updateOldPayment($withdraw->bank_transaction->amount, $withdraw->bank_transaction->bank_info);
            }
            $withdraw->user_details_id = $investor->id;
            $current_balance = $investor->income - (double) $input['amount'];
            $withdraw->amount = -$input['amount'];
            $withdraw->model_type = 'App\Models\Investor';
            $withdraw->model_id = $investor->id;
            $withdraw->date = $input['date'];
            $withdraw->status = $input['status'];
            $withdraw->entry = entry();
            $withdraw->save();
            $investor->income = $current_balance;
            $investor->save();
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
        return response()->json(['message' => $msg, 'amount' => $investor->income]);
    }

    public function validation($request) {
        $validate['investor_id'] = ['required'];
        $validate['date'] = ['required'];
        $validate = array_merge($validate, BankTransactionController::validation($request));
        return $request->validate($validate, ['bank_infos_id' => 'Bank Account Not selected', 'investor_id' => 'Investor Must be required.']);
    }
}
