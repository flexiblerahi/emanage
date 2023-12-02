<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupSalary extends Model
{
    use HasFactory;

    public static function store($salary, $comment) {
        $backup_salaries = new self;
        $backup_salaries->salary_id = $salary->id;
        $backup_salaries->user_detail_id = $salary->user_detail_id;
        $backup_salaries->group_id = $salary->group_id;
        $backup_salaries->type_id = $salary->type_id;
        $backup_salaries->other = $salary->other;
        $backup_salaries->monthly = $salary->monthly;
        $backup_salaries->comment = $comment;
        $backup_salaries->entry = $salary->entry;
        $backup_salaries->save();
    }
}
