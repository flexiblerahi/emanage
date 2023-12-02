<?php

namespace App\Models;

use App\Traits\TransactionBanktraits;
use App\Traits\Entrytraits;
use App\Traits\Timetrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    use Entrytraits, TransactionBanktraits, Timetrait;

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    public function getPaymentTypeAttribute()
    {
        return Commission::VARIABLEKEYS[$this->commission_type];
    }

    public function transactions()
    {
        return $this->morphMany(Transaction::class, 'model');
    }

    public function getCommissionColAttribute() 
    {
        return collect(json_decode($this->commission));
    }

    // for report part

    public static function getPayments($input) //get payments for report
    {
        list($startDate, $endDate) = Report::dateSplit($input['daterange']);
    
        $payments = self::query();
        $relations = [
            'transactions' => function ($query) {
                $query->select('id', 'model_id', 'model_type', 'amount', 'date', 'status', 'user_details_id', 'created_at');
            },
            'bank_transaction' => function ($query) {
                $query->select('id', 'amount', 'date', 'status', 'model_type', 'model_id', 'other');
            },
        ];

        $payments = $payments->with($relations);
        $payments = $payments->where('sale_id', $input['sale_id']);
        if(empty($input['alldata'])) {
            
            $payments = $payments->whereHas('bank_transaction', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('date', [$startDate, $endDate]);
            });
        } 
        $payments = $payments->select([
            'id', 'sale_id', 
            'commission', 'commission_type',
            'created_at'
        ])->get();

        if(!empty($input['alldata']) && count($payments)>0) {
            $startDate = $payments->first()->bank_transaction->date;
            $endDate = $payments->last()->bank_transaction->date;
        }

        return [$payments, $startDate, $endDate];
    }

    public function commissionDistribution($payment, $total_col)
    {
        $total = 0;
        $data = ['hand_1' => 0, 'hand_2' => 0, 'hand_3' => 0, 'shareholder' => 0];
        $commissions = json_decode($payment->commission, 1);
        $transactions = $payment->transactions;
        foreach ($commissions as $commission) {
            if($commission['hand'] != 'general_manager')
            {
                $transaction = $transactions->where('user_details_id', $commission['account_id'])->first();
                if(is_null($transaction)) {
                    $data[$commission['hand']] = 0;
                } else {
                    $data[$commission['hand']] = (double) $transaction->amount;
                    $total = $total + (double) $transaction->amount;
                    $total_col['total_'.$commission['hand']] = $total_col['total_'.$commission['hand']] + (double) $transaction->amount;
                }
            }
        }
        $total_col['total_deposit_amount'] = $total_col['total_deposit_amount'] + (double) $payment->bank_transaction->amount;
        return [$data, $total, $total_col];
    }
}


