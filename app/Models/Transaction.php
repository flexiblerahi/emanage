<?php

namespace App\Models;

use App\Traits\Entrytraits;
use App\Traits\Timetrait;
use App\Traits\TransactionBanktraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, Entrytraits, TransactionBanktraits, Timetrait;

    // public function model() { return $this->morphTo(); }
    
    public static function store($input, $transactions)
    {
        if(isUpdate()) $oldtransactions = self::where(['model_id' => $input['model_id'], 'model_type' => $input['model_type']])->get();
        foreach ($transactions as $data) {
            if(isUpdate()) {
                $transaction = $oldtransactions->where('user_details_id', $data['user_details_id'])->first();
                if(is_null($transaction)) $transaction = new self;
                else BackupTransaction::store($transaction, $input['comment']);
            } else $transaction = new self;
            $transaction->user_details_id = $data['user_details_id'];
            $transaction->amount = $data['amount'];
            $transaction->other = 'percentage='.$data['percentage'].'%';
            $transaction->model_id = $input['model_id'];
            $transaction->model_type = $input['model_type'];
            $transaction->date = $input['date'];
            $transaction->status = $input['status'];
            $transaction->entry = entry();
            $transaction->save();
        }
    }

    public function user()
    {   
        return $this->belongsTo(UserDetail::class, 'user_details_id', 'id');
    }

    public function investor()
    {
        return $this->belongsTo(Investor::class, 'user_details_id', 'id');    
    }

    public function getWithdrawedAttribute()
    {
        return \Carbon\Carbon::parse($this->withdraw_at)->format('d M Y');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'model_id');
    }

    public function getTransactionTypeAttribute()
    {
        return ($this->status == 0) ? 'Withdraw' : 'Cash In'; 
    }

    public function balance($old, $new, $type)
    {
        if($type == 1) $balance = $old + $new;
        else $balance = $old - $new;
        return $balance;
    }
}
