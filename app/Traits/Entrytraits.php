<?php

namespace App\Traits;

use App\Models\UserDetail;

trait Entrytraits
{
    public function entrier()
    {   
        return $this->belongsTo(UserDetail::class, 'entry', 'id');
    }
}