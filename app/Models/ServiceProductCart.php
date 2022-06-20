<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProductCart extends Model
{
    use HasFactory;
    public function workstation()
    {
       return $this->belongsTo(WorkStation::class,'workstation_id');
    }

    public function category()
    {
       return $this->belongsTo(Category::class,'ws_cat_id');
    }
    
    public function product()
    {
        return $this->belongsTo(ServiceProfileProduct::class,'product_id');
    }
    public function course()
    {
        return $this->belongsTo(Courseitem::class,'product_id');
    }
}
