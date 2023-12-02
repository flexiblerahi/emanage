<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use File;
class BackupInvestment extends Model
{
    use HasFactory;

    public static function store($investment, $comment)
    {
        $name = autoIdGenerator('backup_investments', true);
        $backup_invesment = new self;
        $backup_invesment->investment_id = $investment->id;
        $backup_invesment->investor_id = $investment->investor_id;
        $backup_invesment->rate = $investment->rate;
        $backup_invesment->duration = $investment->duration;
        $backup_invesment->duration_in = $investment->duration_in;
        $backup_invesment->invest_at = $investment->invest_at;
        $backup_invesment->comment = $comment;
        $backup_invesment->entry = $investment->entry;
        $backup_invesment->status = $investment->status;
        if(!is_null($investment->document)) {
            $extension = explode('.', $investment->document);
            $path = 'investment/backup/'.$name.'.'.$extension[1];
            File::copy(public_path($investment->document), public_path($path));
            $backup_invesment->document = $path;
        }
        $backup_invesment->save();
    }
}
