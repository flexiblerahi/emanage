<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;

class BackupOtherDeposit extends Model
{
    use HasFactory;

    public static function store($otherDeposit, $comment) {
        $name = autoIdGenerator('backup_other_deposits', true);
        $backupOtherDeposit = new self;
        $backupOtherDeposit->other_deposit_id = $otherDeposit->id;
        $backupOtherDeposit->other = $otherDeposit->other;
        $backupOtherDeposit->comment = $comment;
        $backupOtherDeposit->entry = entry();
        if(!is_null($otherDeposit->document)) {
            $extension = explode('.', $otherDeposit->document);
            $path = 'otherdeposit/backup/'.$name.'.'.$extension[1];
            File::copy(public_path($otherDeposit->document), public_path($path));
            $backupOtherDeposit->document = $path;
        }
        $backupOtherDeposit->save();
    }
}
