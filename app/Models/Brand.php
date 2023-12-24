<?php

namespace App\Models;

use App\Traits\Timetrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory, Timetrait;
}
