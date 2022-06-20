<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courseitem extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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
    public function fi()
    {
        if ($this->courseimage) {
            return $this->courseimage;
        } else {
            return 'pfi.png';
        }
    }
    public function negotiations()
    {
       return $this->hasMany(Negotiation::class,'item_id');
    }

    public function negotiationCount()
    {
       return $this->negotiations()->count();
    }
    public function negotiationByCustomer()
    {
       return $this->negotiations()->where('user_id',Auth::id())->get();
    }
    function approvedNegotiationByCustomer()
    {
        return $this->negotiations()->where('user_id',Auth::id())->where('approved',true)->first();
    }
    function approvedNegotiation($customer)
    {
        return $this->negotiations()->where('user_id',Auth::id())->orWhere('user_id',$customer)->where('approved',true)->first();
    }
    public function negotiationsUserGroup()
    {
        return $this->negotiations()->groupBy('user_id')->get();
    }
    public function servicePayments()
    {
        return $this->hasMany(ServicePayment::class,'item_id');
    }
    public function paymentByUser($customer)
    {
        return $this->servicePayments()->where('user_id',$customer)->latest()->first();
    }
    public function hasOrderStatusPending($customer)
    {
        return $this->servicePayments()->where('user_id',$customer)->latest()->first()->order_staus;
    }

    public function totalOrder()
    {
        return $this->servicePayments()->count();
    }
    public function hasOrder()
    {
        return (bool) $this->servicePayments()->where('user_id',Auth::id())->count();
    }
}
