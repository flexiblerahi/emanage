<?php

namespace App\Models;

use App\Traits\Timetrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankName extends Model
{
    use HasFactory, Timetrait;
    const CASH = 1;

    public function bankInfos() 
    {
        return $this->hasMany(BankInfo::class);
    }
}
