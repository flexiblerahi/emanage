<?php

namespace App\Http\Controllers;

use App\DataTables\BankTransactionDataTable;
use App\Models\BackupBankTransaction;
use App\Models\BankInfo;
use App\Models\BankTransaction;
use Illuminate\Http\Request;

class BankTransactionController extends Controller
{
    public function index(BankTransactionDataTable $bankTransactionDataTable) //view('index')
    {
        $data['page'] = 'index';
        $data['title'] = 'Investor';
        // if(auth()->user()->can('investor-view')) {
        //     $data['modal'] = 'modules.modal';
        //     $data['modal_title'] = $data['title']. ' Profile';
        //     $data['modal_type'] = 'investor';
        //     $bankTransactionDataTable->setModaltype($data['modal_type']);
        // }
        return $bankTransactionDataTable->render('home', $data);
    }

    public function create() //view('bank-transaction.create')
    {
        $data['title'] = 'New Investor';
        $data['page'] = 'bank-transaction.create';
        return view('home', $data);
    }

    public static function validation($request) 
    {
        $validate['amount'] = ['required', 'numeric'];
        $validate['bank_type'] = ['required'];
        $validate['other'] = ['nullable'];
        $validate['bank_infos_id'] = ['required'];
        $validate['trx_num'] = ['required'];
        $validate['trx_by'] = ['required'];
        if($request->input('bank_type') ==  '1') {
            $request['trx_by'] = 1;
            $request['trx_num'] = 1;
            $validate['trx_num'] = ['nullable'];
            $validate['trx_by'] = ['nullable'];
        }
        if(isUpdate()) $validate['comment'] = ['required'];

        return $validate;
    }

    public static function upstore($input, $new = false)
    {
        if(isUpdate() && ($new == false)) {
            $bank_transaction = BankTransaction::where(['model_type' => $input['model_type'], 'model_id' => $input['model_id']])->firstorfail();
            BackupBankTransaction::store($bank_transaction, $input['comment']);
        } else {
            $bank_transaction = new BankTransaction();
            $bank_transaction->account_id = autoIdGenerator('bank_transactions'); 
        }
        $bank_transaction->bank_info_id = $input['bank_infos_id'];
        $bank_transaction->trx_by = $input['trx_by'];
        $bank_transaction->trx_no = $input['trx_num'];
        $bank_transaction->amount = (int) ($input['status'] == 0) ? -$input['amount'] : $input['amount'];
        $bank_transaction->other = $input['other'];
        $bank_transaction->status = $input['status'];
        $bank_transaction->date = $input['date'];
        $bank_transaction->model_type = $input['model_type'];
        $bank_transaction->model_id = $input['model_id'];
        $bank_transaction->entry = entry();
        $bank_transaction->save();
        return $bank_transaction;
    }
}
