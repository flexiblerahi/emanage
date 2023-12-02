<?php

namespace App\Models;

use App\Traits\Timetrait;
use App\Traits\TransactionBanktraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvestmentCommission extends Model
{
    use HasFactory, Timetrait, TransactionBanktraits;

    public static function store($investment, $interest) {
        $commission = new InvestmentCommission;
        $commission->investment_id = $investment->id;
        $commission->amount = $interest;
        $commission->investor_id = $investment->investor_id;
        $commission->save();
    }

    public function investor() {
        return $this->BelongsTo(Investor::class);
    }

    public function investment() {
        return $this->BelongsTo(Investment::class);
    }

}
