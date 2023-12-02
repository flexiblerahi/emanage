<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupBankTransaction extends Model
{
    use HasFactory;

    public static function store($bankTransaction, $comment)
    {
        $backupBankTransaction = new self;
        $backupBankTransaction->bank_transaction_id = $bankTransaction->id;
        $backupBankTransaction->account_id = $bankTransaction->account_id;
        $backupBankTransaction->bank_info_id = $bankTransaction->bank_info_id;
        $backupBankTransaction->amount = $bankTransaction->amount;
        $backupBankTransaction->trx_by = $bankTransaction->trx_by;
        $backupBankTransaction->trx_no = $bankTransaction->trx_no;
        $backupBankTransaction->other = $bankTransaction->other;
        $backupBankTransaction->status = $bankTransaction->status;
        $backupBankTransaction->date = $bankTransaction->date;
        $backupBankTransaction->model_type = $bankTransaction->model_type;
        $backupBankTransaction->model_id = $bankTransaction->model_id;
        $backupBankTransaction->entry = $bankTransaction->entry;
        $backupBankTransaction->comment = $comment;
        $backupBankTransaction->save();
    }
}
