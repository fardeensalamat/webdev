<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProfile extends Model
{
    use HasFactory;

    public function serviceProfileValues()
    {
        return $this->hasMany('App\Models\ServiceProfileInfoValue','service_profile_id');
    }

    public function profileValuesWithoutInfos()
    {
        return $this->serviceProfileValues()->get();
    }

    public function freeValues()
    {
        return $this->serviceProfileValues()
        ->where('access_type', 'free')
        ->orderBy('field_type')
        ->get();
    }

    
    public function shortValues()
    {
        return $this->serviceProfileValues()
        ->where('access_type', 'short_paid')
        ->orderBy('field_type')
        ->get();
    }

    public function fullValues()
    {
        return $this->serviceProfileValues()
        ->where('access_type', 'full_paid')
        ->orderBy('field_type')
        ->get();
    }

    /**
     * Get the category that owns the ServiceProfile
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function workstation()
    {
        return $this->belongsTo(WorkStation::class,'workstation_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'ws_cat_id');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ownerSubscription()
    {
        return $this->belongsTo(Subscriber::class,'subscriber_id');
    }
    public function addedby()
    {
        return $this->belongsTo(User::class,'addedby_id')->where('is_employee',true);
    }
    public function fi()
    {
        if ($this->img_name) {
            return $this->img_name;
        } else {
            return 'pfi.png';
        }
    }
    public function ci()
    {
        if ($this->cover_image) {
            return $this->cover_image;
        }else {
            return 'pfi.png';
        }
    }
    public function cart(){
        return $this->hasMany(ServiceProductCart::class,'service_profile_id');
    }
    public function products(){
        return $this->hasMany(ServiceProfileProduct::class,'service_profile_id');
    }
    public function liveProducts(){
        return $this->hasMany(ServiceProfileProduct::class,'service_profile_id')->where('status','approved')->where('active',true);
    }
    public function isOrderTrue(){
        return $this->belongsTo(Category::class, 'ws_cat_id')->where('sp_order',true);
    }
    public function orders(){
        return $this->belongsTo(ServiceProductOrder::class, 'service_profile_id');
    }
    public function favourite()
    {
        return $this->morphMany(Favourite::class,'favourable');
    }

    public function isMyFavourite()
    {
        return $this->favourite()->where('user_id',\Auth::id())->count();
    }
    public function serviceitems()
    {
        return $this->hasMany(Serviceitem::class,'service_profile_id');
    }
    public function activeServiceCount()
    {
        return $this->serviceitems()->where('status','approved')->where('active',true)->count();
    }
    public function totalServiceItems()
    {
        return $this->serviceItems()->count();
    }
}
