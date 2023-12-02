<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupExpenseItem extends Model
{
    use HasFactory;

    public static function store($expenseItem, $comment)
    {
        $backupExpenseItem = new self;
        $backupExpenseItem->expense_item_id = $expenseItem->id;
        $backupExpenseItem->title = $expenseItem->title;
        $backupExpenseItem->parent = $expenseItem->parent;
        $backupExpenseItem->entry = $expenseItem->entry;
        $backupExpenseItem->comment = $comment;
        $backupExpenseItem->save();
    }
}
