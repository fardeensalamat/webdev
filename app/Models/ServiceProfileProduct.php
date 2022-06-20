<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProfileProduct extends Model
{
    use HasFactory;
    public function subscription()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber_id');
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
    public function fi()
    {
        if ($this->feature_image_name) {
            return $this->feature_image_name;
        } else {
            return 'pfi.png';
        }
    }
    public function galary_image()
    {
        return $this->hasMany(ServiceProductImage::class, 'product_id');
    }

    public function totalPrice( )
    {
       return $this->quantity * $this->sale_price;
    }
    // public

    public function isActiveOrder()
    {
        return $this->belongsTo(Category::class, 'ws_cat_id')->where('sp_order',true);
    }
    public function wishlistProducts()
    {
        return $this->hasMany(ServiceProfileProductWishlist::class,'service_product_id');
    }
    public function isMyWishlisted()
    {
        return $this->wishlistProducts()->where('user_id',\Auth::id())->count();
    }
    // public function wishlistedByCategory(){
    //     return $this->wishlistProducts()->where('user_id',\Auth::id())->where('service_profile_id',$this->serviceProfile()->id)->count();
    // }

    public function favourite()
    {
        return $this->morphMany(Favourite::class,'favourable');
    }

    public function isMyFavourite()
    {
        return $this->favourite()->where('user_id',\Auth::id())->count();
    }
    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit');
    }
}
