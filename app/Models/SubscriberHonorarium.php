<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriberHonorarium extends Model
{
    use HasFactory;

    public function workstation()
    {
        return $this->belongsTo('App\Models\WorkStation','workstation_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscriber','subscriber_id');
    }
}
