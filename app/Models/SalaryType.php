<?php

namespace App\Models;

use App\Traits\Timetrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryType extends Model
{
    use HasFactory, Timetrait;

    public function salaries() {
        return $this->hasOne(Salary::class, 'type_id', 'id');
    }
}
