<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negotiation extends Model
{
    use HasFactory;
    public function customer()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }
    public function CustomerNegotiationsAll($user,$item)
    {
        return $this->where('item_id',$item)->where('user_id',$user)->get();
    }

    public function serviceItem()
    {
      return $this->belongsTo(Serviceitem::class,'item_id');
    }
    public function approvedNg($customer,$item)
    {
      $approvedNg= $this->where('approved',true)->where('user_id',$customer)->where('item_id',$item)->latest()->first();
      return $approvedNg;
    //    return $latest_id;
    //    if ($latest_id) {
    //     return true;
    //    }else {
    //            return false;
    //        }
    //    if ($latest_id == $item_id) {
    //       return true;
    //    }else {
    //        return false;
    //    }
    }
   
}
