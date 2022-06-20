<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProductOrder extends Model
{
    use HasFactory;
    public function orderItems()
    {
        return $this->hasMany(ServiceProductOrderItem::class,'service_product_order_id' );
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'ws_cat_id');
    }
    public function workStation()
    {
        return $this->belongsTo(WorkStation::class, 'workstation_id');
    }
    public function serviceProfile()
    {
        return $this->belongsTo(ServiceProfile::class, 'service_profile_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function color()
    {
        return $this->belongsTo(Color::class,'color');
    }
    public function size()
    {
        return $this->belongsTo(Size::class,'size');
    }
    public function deliveryman()
    {
        return $this->belongsTo(DeliveryMan::class,'deliveryman_id');
    }


}
