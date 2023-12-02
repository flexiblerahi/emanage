<?php

namespace App\Models;

use App\Traits\Entrytraits;
use App\Traits\Timetrait;
use App\Traits\TransactionBanktraits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory, TransactionBanktraits, Entrytraits, Timetrait;
    
    public function type()
    {
        return $this->belongsTo(ExpenseItem::class, 'expense_item_id', 'id')->with('parents')->select(['id', 'title', 'parent']);
    }
}
