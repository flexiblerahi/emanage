<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackupSale extends Model
{
    use HasFactory;
    // protected $fillable = [ 'sale_id', 'customer_id', 'agent_id', 'shareholder_id', 'price', 'sector', 'block', 'road', 'plot', 'kata', 'type', 'commission', 'date', 'entry_id', 'comment'];
    public static function store($input, $comment)
    {
        $input['sale_id'] = $input['id'];
        unset($input['id'], $input['uuid'], $input['created_at'], $input['updated_at']);
        $input['comment'] = $comment;
        $backupSale = new self;
        $backupSale->attributes = $input;
        $backupSale->save();
    }
}
