<?php

namespace App\Models;

use App\Traits\Timetrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Timetrait;
    
    public function getOtherAttribute($value)
    {
        return json_decode($value, 1);
    }

    public function categories()
    {
        return $this->hasMany(self::class, 'parent', 'id')->with('categories');
    }

    public function childCategories()
    {
        return $this->hasMany(self::class, 'parent', 'id')->with('childCategories')->select(['id', 'title', 'parent']);
    }

    public function parents() 
    {
        return $this->belongsTo(self::class, 'parent', 'id')->with('parents')->select(['id', 'title', 'parent']);
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');

    }
}
