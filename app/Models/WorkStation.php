<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkStation extends Model
{
    use HasFactory;
    public function imageName()
    {
        return $this->feature_img ?: 'wsfi.jpg';
    }

    public function categories()
    {
        return $this->hasMany('App\Models\Category','work_station_id','id')->orderBy('name');
    }
    public function isOrderTrueInCategories()
    {
        return $this->hasMany('App\Models\Category','work_station_id','id')->where('sp_order',true);
    }
}
