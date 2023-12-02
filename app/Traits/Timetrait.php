<?php

namespace App\Traits;

trait Timetrait
{
    // public function getCreatedAttribute()
    // {
    //     return \Carbon\Carbon::parse($this->created_at)->format('d M Y');
    // }

    public function getUpdatedAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d M Y');
    }

    public function getCreatedAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('F j, Y');
    }
}