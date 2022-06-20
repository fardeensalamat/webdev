<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    
    public function categoryname()
    {
        return $this->belongsto('App\Models\Category','category_id');

    }
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }
}
