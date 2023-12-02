<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class BackupExpense extends Model
{
    use HasFactory;

    public static function store($expense, $comment)
    {
        $name = autoIdGenerator('backup_expenses', true);
        $backupExpense = new self;
        $backupExpense->expense_id = $expense->id;
        $backupExpense->expense_item_id = $expense->expense_item_id;
        $backupExpense->entry = $expense->entry;
        if(!is_null($expense->document)) {
            $extension = explode('.', $expense->document);
            $path = 'expense/backup/'.$name.'.'.$extension[1];
            File::copy(public_path($expense->document), public_path($path));
            $backupExpense->document = $path;
        }
        $backupExpense->comment = $comment;
        $backupExpense->save();
    }
}
