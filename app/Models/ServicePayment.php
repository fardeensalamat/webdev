<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePayment extends Model
{
    use HasFactory;
    public function serviceitem()
    {
        return $this->belongsTo(Serviceitem::class,'item_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function subscriber()
    {
        return $this->belongsTo(Subscriber::class, 'subscriber_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function workstation()
    {
        return $this->belongsTo(WorkStation::class, 'workstation_id');
    }
    public function serviceProfile()
    {
        return $this->belongsTo(ServiceProfile::class, 'service_profile_id');
    }


  

}
