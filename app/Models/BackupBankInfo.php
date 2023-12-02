<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupBankInfo extends Model
{
    use HasFactory;

    public static function store($bank_info, $comment)
    {
        $backup_bank_info = new self;
        $backup_bank_info->account_id = $bank_info->account_id;
        $backup_bank_info->bank_name_id = $bank_info->bank_name_id;
        $backup_bank_info->address = $bank_info->address;
        $backup_bank_info->status = $bank_info->status;
        $backup_bank_info->amount = $bank_info->amount;
        $backup_bank_info->entry = $bank_info->entry;
        $backup_bank_info->bank_info_id = $bank_info->id;
        $backup_bank_info->comment = $comment;
        $backup_bank_info->save();
    }
}
