<?php

namespace App\Models;

use App\Traits\Timetrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory, Timetrait;

    public function getParentNameAttribute($value)
    {
        if(is_null($value)) {
            return (object) array('father' => null, 'mother' => null);
        }
        return json_decode($value);
    }

    public function getOccupationNameAttribute() {
        if(is_null($this->occupation)) return 'No Entry Yet';
        else return $this->occupation;
    }
}
