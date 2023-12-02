<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupPayment extends Model
{
    use HasFactory;

    public static function store($payment, $comment)
    {
        
        $backup_payment = new self;
        $backup_payment->payment_id = $payment->id;
        $backup_payment->sale_id = $payment->sale_id;
        $backup_payment->commission = $payment->commission;
        $backup_payment->commission_type = $payment->commission_type;
        $backup_payment->percentage = $payment->percentage;
        $backup_payment->entry = $payment->entry;
        $backup_payment->comment = $comment;
        $backup_payment->save();
    }
}
