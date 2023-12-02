<?php

namespace App\Models;

use App\Traits\TransactionBanktraits;
use App\Traits\Entrytraits;
use App\Traits\Timetrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory, TransactionBanktraits, Entrytraits, Timetrait;

    public function investor()
    {
        return $this->belongsTo(Investor::class);
    }
}
