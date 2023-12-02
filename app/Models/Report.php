<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;


    public static function dateSplit($date) {
        $date = explode('-', $date);
        return [formatdate(trim($date[0])), formatdate(trim($date[1]))];
    }
}
