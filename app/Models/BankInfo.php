<?php

namespace App\Models;

use App\Traits\Timetrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankInfo extends Model
{
    use HasFactory, Timetrait;
    
    public static function updateAmount($input, $bankInfo = null)
    {
        if(is_null($bankInfo)) $bankInfo = self::find($input['bank_infos_id']);
        $amount = (int) $bankInfo->amount;
        $amount = ($input['status'] == 1) ? $amount + $input['amount'] : $amount - $input['amount']; //status = 1 = cashin;
        $bankInfo->amount = $amount;
        $bankInfo->save();
        return $bankInfo;
    }

    public static function updateOldPayment($oldamount, $bankInfo) {
        $amount = (int) $bankInfo->amount;
        $amount = ($bankInfo->status == 1) ? $amount - $oldamount : $amount + $oldamount; //status = 1 = cashin;
        // dd($bankInfo, $amount);
        $bankInfo->amount = $amount;

        $bankInfo->save();
        return $bankInfo;
    }

    public function bankname()
    {
        return $this->belongsTo(BankName::class, 'bank_name_id', 'id');
    }

    public function entrier()
    {
        return $this->belongsTo(UserDetail::class, 'entry', 'id');
    }
}
