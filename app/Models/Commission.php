<?php

namespace App\Models;

use App\Traits\Timetrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory, Timetrait;
    const NAMES = [ 'Installment', 'Down Payment', 'Booking Money'];
    const VARIABLE = [ 'installment', 'down_payment', 'booking_money'];
    const VARIABLEKEYS = [ 'installment'=> 'Installment', 'down_payment'=> 'Down Payment', 'booking_money'=> 'Booking Money'];

    public static function commissionCal($input, $reference_user)
    {
        $commissions = self::get(['id', 'type', 'total']);
        $countCommissions = array();
        if(is_null($reference_user->reference_id)) {
            foreach($commissions as $commission) {
                $countCommissions[$commission->type_variable][] = [ 'hand' => 'shareholder', 'percentage' => $commission->total, 'shareholder_id' => $reference_user->id ];
            }
        } else {
            $input_all_commissions = filter_key_array($input, 'commission_');
            foreach($input_all_commissions as $commission_key => $input_commissions) {
                $commission = $commissions->find($commission_key);
                $total = 0;
                $eachCommission = array();
                foreach($input_commissions as $input_key => $input_commission) {
                    $splitKey = explode('-', $input_key);
                    $account_id = explode('_', $splitKey[2]);
                    if(str_contains($splitKey[0], 'hand')) {
                        $eachCommission[] = [ 'hand' => $splitKey[0], 'percentage' => (float) $input_commission, 'agent_id' => $account_id[1] ];
                        $total = $total + (float) $input_commission;
                    } else $eachCommission[] = [ 'hand' => $splitKey[0], 'percentage' => ((float) $commission->total - $total), 'shareholder_id' => $account_id[1] ];
                }    
                $countCommissions[$commission->type_variable]  = $eachCommission;
            }
        }
        return json_encode($countCommissions);
    }

    public function getTypeNameAttribute()
    {
        return self::NAMES[$this->type];
    }

    public function getTypeVariableAttribute()
    {
        return self::VARIABLE[$this->type];
    }

    public function user_detail()
    {
        return $this->belongsTo(UserDetail::class, 'user_details_id', 'id');
    }

    public function getRankingAttribute()
    {
        return json_decode($this->rank, true);
    }
}
