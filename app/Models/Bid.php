<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    use HasFactory;
    public function user()
    {
       return $this->belongsTo(User::class,'user_id');
    }
    public function serviceProfile()
    {
       return $this->belongsTo(ServiceProfile::class,'service_profile');
    }
    public function need()
    {
       return $this->belongsTo(Need::class,'need_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'ws_cat_id');
    }
    public function workstation()
    {
        return $this->belongsTo(WorkStation::class,'workstation_id');
    }
    public function payment()
    {
        return $this->hasMany(NeedsPayment::class,'bid_id');
    }
    public function paymentStatus()
    {
        return $this->payment()->select('payment_status')->first();
    }
}
