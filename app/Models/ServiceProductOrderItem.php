<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProductOrderItem extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(ServiceProfileProduct::class,'service_product_id');
    }
    public function serviceProfile(){
        return $this->belongsTo(ServiceProfile::class,'service_profile_id');
    }
    public function order(){
        return $this->belongsTo(ServiceProductOrder::class,'service_product_order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'ws_cat_id');
    }
    public function fi()
    {
        return $this->feature_img ? $this->img_name : 'ppm.jpg';
    }

    public function color()
    {
        return $this->belongsTo(Color::class,'color');
    }
    public function size()
    {
        return $this->belongsTo(Size::class,'size');
    }
}
