<?php

namespace App\Models;

use App\Traits\Entrytraits;
use App\Traits\Timetrait;
use App\Traits\TransactionBanktraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory, Entrytraits, TransactionBanktraits, Timetrait;


    public function type() {
        return $this->belongsTo(SalaryType::class, 'type_id', 'id');
    }

    public function user() {
        return $this->belongsTo(UserDetail::class, 'user_detail_id', 'id');
    }
}
