<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WorkStation;

class SubcriberPayment extends Model
{
    use HasFactory;

    public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id')->withoutGlobalScopes();
	}

    public function paidBy()
    {
        return $this->belongsTo('App\Models\User', 'paidby_id')->withoutGlobalScopes();
    }

    public function district()
	{
	    return $this->belongsTo('App\Models\District', 'district_id');
	}

    public function workStation()
    {
        return $this->belongsTo('App\Models\WorkStation','work_station_id');

    }
    // public function workstation()
    // {
    //     return $this->belongsTo(WorkStation::class, 'work_station_id');
    // }
}
