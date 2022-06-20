<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo(Category::class,'ws_cat_id');
    }
    public function workstation()
    {
        return $this->belongsTo(WorkStation::class,'workstation_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function bids()
    {
        return $this->hasMany(Bid::class,'need_id');
    }
    public function bidsByPrice()
    {
        return $this->bids()->orderBy('price')->get();
    }
    public function avaragePrice()
    {
        return $this->bids()->avg('price');
    }
    public function hasApprovedBid()
    {
        return $this->bids()->where('status','approved')->first();
    }
    public function favourite()
    {
        return $this->morphMany(Favourite::class,'favourable');
    }

    public function isMyFavourite()
    {
        return $this->favourite()->where('user_id',\Auth::id())->count();
    }
   
}
