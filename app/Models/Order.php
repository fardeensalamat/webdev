<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id');
	}

    public function workStation()
    {
        return $this->belongsTo('App\Models\WorkStation','work_station_id');
    }
    public function subscriber()
    {
        return $this->belongsTo('App\Models\Subscriber','subscriber_id','id');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\FreelancerJob','work_station_id');

    }

    public function orderPayment()
    {
        return $this->belongsTo('App\Models\OrderPayment','id','order_id');
    }
}
