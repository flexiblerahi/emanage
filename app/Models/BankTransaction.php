<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;
    const JOINTABLES = array('bank_transaction', 'bank_transaction.bank_info', 'bank_transaction.bank_info.bankname');
    const TRXBY = ['Cash', 'Online Transfer', 'Check'];
    public function model() { $this->morphTo(); }

    public function bank_info()
    {
        return $this->belongsTo(BankInfo::class, 'bank_info_id', 'id');
    }

    public function getCustomDateAttribute()
    {
        return \DateTime::createFromFormat('Y-m-d', $this->date)->format('d M Y');
    }

    public function getTransactionbyAttribute()
    {
        return self::TRXBY[$this->trx_by];
    }

    public function getCustomStatusAttribute() 
    {
        return ($this->status == 0) ? 'Cash Out' : 'Cash In';
    }

    public function getSectorAttribute()
    {
        $seperator = explode('\\', $this->model_type);
        return last($seperator);
    }

    public function getOtherDescribeAttribute()
    {
        if(empty($this->other)) {
            return '<p class="text-danger">No Entry Yet.</p>';
        } 
        return '<p>' . $this->other . '</p>';
    }

    /**
     * all transaction for report section.
     * each calculate each eachtransaction in loop section
     */

     public function allTransaction($transaction, $closingAmounts, $initialAmounts, $sl):array  
     {
         if($transaction->amount > 0) {
             $closingAmounts[$transaction->bank_info_id]['in'] = $transaction->amount + $closingAmounts[$transaction->bank_info_id]['in'];
         } else {
             $closingAmounts[$transaction->bank_info_id]['out'] = $transaction->amount + $closingAmounts[$transaction->bank_info_id]['out'];
         }
        //  dd($transaction->amount);
         $sl = $sl + 1;
         $beforeBalance = $initialAmounts[$transaction->bank_info_id]['amount'];
        //  dd($initialAmounts);
         $afterBalance = $transaction->amount + $beforeBalance;
         $initialAmounts[$transaction->bank_info_id]['amount'] = $afterBalance;
        //  $closingAmounts[$transaction->bank_info_id]['balance'] = $closingAmounts[$transaction->bank_info_id]['balance'] + $initialAmounts[$transaction->bank_info_id]['amount'];
         return [$closingAmounts, $beforeBalance, $afterBalance, $sl, $initialAmounts];
     }
}