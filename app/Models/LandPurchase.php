<?php

namespace App\Models;

use App\Traits\Timetrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandPurchase extends Model
{
    use HasFactory, Timetrait;

    public function entrier()
    {
        return $this->belongsTo(UserDetail::class, 'entry', 'id');
    }
}
