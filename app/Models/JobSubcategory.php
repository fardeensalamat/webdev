<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSubcategory extends Model
{
    use HasFactory;
    public function categoryname()
    {
        return $this->belongsto('App\Models\JobCategory','job_category_id');

    }
}
