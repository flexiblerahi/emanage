<?php

namespace App\Models;

use App\Traits\Entrytraits;
use App\Traits\Timetrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseItem extends Model
{
    use HasFactory, Entrytraits, Timetrait;

    public function getOtherAttribute($value)
    {
        return json_decode($value, 1);
    }

    public function expenseItems()
    {
        return $this->hasMany(ExpenseItem::class, 'parent', 'id')->with('expenseItems');
    }

    public function childExpenseItems()
    {
        return $this->hasMany(ExpenseItem::class, 'parent', 'id')->with('childExpenseItems')->select(['id', 'title', 'parent']);
    }

    public function parents() 
    {
        return $this->belongsTo(ExpenseItem::class, 'parent', 'id')->with('parents')->select(['id', 'title', 'parent']);
    }

    public function expenses() {
        return $this->hasMany(Expense::class, 'expense_item_id', 'id');
    }
}
