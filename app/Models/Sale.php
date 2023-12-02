<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public static function store($sale, $input)
    {
        $sale->price = $input['price'];
        $sale->sector = $input['sector'];
        $sale->block = $input['block'];
        $sale->road = $input['road'];
        $sale->plot = $input['plot'];
        $sale->kata = $input['kata'];
        $sale->date = formatdate($input['saledate']);
        $sale->type = $input['type'];
        $sale->entry = entry();
        $sale->save();
        return $sale;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function shareholder()
    {
        return $this->belongsTo(UserDetail::class, 'shareholder_id', 'id');
    }

    public function agent()
    {
        return $this->belongsTo(UserDetail::class, 'agent_id', 'id');
    }

    public static function getDetails($id = null, $uuid = null)
    {
        $sale = self::with('customer');
        $sale = (is_null($id)) ? $sale->where('uuid', $uuid) : $sale->where('id', $id);
        $data['sale'] = $sale = $sale->firstOrFail();
        $data['commissions'] = $commissions = json_decode($sale->commission, 1);
        $data['referencesIds'] = $referencesIds = array_map(fn($item) => isset($item['agent_id']) ? $item['agent_id'] : $item['shareholder_id'], $commissions['installment']);
        $data['referenceUsers'] = $referenceUsers = UserDetail::query()->whereIn('id', $referencesIds)->select('account_id', 'role', 'name', 'status', 'phone', 'emergency_contact', 'total_kata', 'id')->get();
        $data['commission_names'] = Commission::VARIABLEKEYS;
        $userId = (is_null($sale->agent_id)) ? $sale->shareholder_id : $sale->agent_id;
        $data['user'] = $referenceUsers->find($userId);
        $data['rank'] = countRank($data['user']->total_kata);
        return $data;
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'sale_id', 'id');
    }

    public function commissionMultiple($sale, $deposit_final_total, $commission_final_total) // for commissionMultipleSale report 
    {
        $deposit = 0;
        $commissions = ['installment' => 0, 'booking_money' => 0, 'down_payment' => 0];
        $commission_total = 0;
        if(count($sale->payments) > 0) {
            foreach ($sale->payments as $payment) {
                $deposit = $deposit + (double) $payment->bank_transaction->amount;
                $commissions[$payment->commission_type] = $commissions[$payment->commission_type] +  (double) $payment->transactions->first()->amount;
            }
        }
        foreach($commissions as $commission) {
            $commission_total = $commission_total + $commission;
        }
        $deposit_final_total = $deposit_final_total + $deposit;
        $commission_final_total = $commission_final_total + $commission_total;
        return [$deposit, $commissions, $commission_total, $deposit_final_total, $commission_final_total];
    }
}
