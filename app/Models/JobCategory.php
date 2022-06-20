<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCategory extends Model
{
    use HasFactory;

    public function subcategories()
    {
        return $this->hasMany('App\Models\JobSubcategory','job_category_id');
    }
}
