<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupTransaction extends Model
{
    use HasFactory;

    public static function store($transaction, $comment)
    {
        $backup_transaction = new self;
        $backup_transaction->transaction_id = $transaction->id;
        $backup_transaction->user_details_id = $transaction->user_details_id;
        $backup_transaction->other = $transaction->other;
        $backup_transaction->model_id = $transaction->model_id;
        $backup_transaction->model_type = $transaction->model_type;
        $backup_transaction->amount = $transaction->amount;
        $backup_transaction->date = $transaction->date;
        $backup_transaction->status = $transaction->status;
        $backup_transaction->entry = $transaction->entry;
        $backup_transaction->comment = $comment;
        $backup_transaction->save();
    }
}
