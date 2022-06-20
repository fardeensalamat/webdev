<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory; 

    protected $fillable = [
        'category_id',
        'referral_id'
    ];

    public function district()
    {
        return $this->belongsTo('App\Models\District');
    }

    public function workStation()
    {
        return $this->belongsTo('App\Models\WorkStation');
    }

    public function workLinks()
    {
        return $this->hasMany(JobWorkLink::class, 'subscriber_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category','category_id','id');
    }
    public function isOrderActive()
    {
        return $this->category()->where('sp_order',true)->count();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id')->withoutGlobalScopes();
    }

    public function referrer()
    {
        return $this->belongsTo('App\Models\Subscriber','referral_id');
    }

    public function referredTeam()
    {
        return $this->hasMany('App\Models\Subscriber', 'referral_id');
    }

    public function leftHand()
    {
        $lid = $this->ws_position * 2;
        $s = Subscriber::where('ws_position', $lid)->where('work_station_id', $this->work_station_id)->first();
        if($s)
        {
            return $s;
        }
        return false;
    }

    public function rightHand()
    {
        $lid = ($this->ws_position * 2) + 1;
        $s = Subscriber::where('ws_position', $lid)->where('work_station_id', $this->work_station_id)->first();
        if($s)
        {
            return $s;
        }
        return false;
    }

    public function topId()
    {
        $tid = (int) ($this->ws_position /2);
        $s = Subscriber::where('ws_position', $tid)->where('work_station_id', $this->work_station_id)->first();
        if($s)
        {
            return $s;
        }
        return false;
    }

    public function balanceTransactions()
    {
        return $this->hasMany('App\Models\BalanceTransaction');
    }

    public function movedTotalToWallet()
    {
        return $this->balanceTransactions()->where('purpose', 'move_to_wallet')->sum('moved_balance');
    }
}
