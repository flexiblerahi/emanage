<?php

namespace App\Models;

use App\Traits\Entrytraits;
use App\Traits\Timetrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Entrytraits, Timetrait;

    public function getParentNameAttribute($value)
    {
        if(is_null($value)) {
            return (object) array('father' => null, 'mother' => null);
        }
        return json_decode($value);
    }

    public function getAccountedIdAttribute() 
    {
        $str = $this->account_id;
        $result = substr($str, 2);
        return $result;
    }
}
