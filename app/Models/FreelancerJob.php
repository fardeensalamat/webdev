<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelancerJob extends Model
{
    use HasFactory;

    protected $casts = [
        'expired_day' => 'datetime',
    ];

    protected $fillable = [
        'work_done',
        'status'
    ];

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id');
	}

    public function fiName()
    {
        return $this->img_name ? $this->img_name : 'image.png';
    }



    public function jobPostRemainingDays()
    {
        if($this->expired_day < Carbon::now())
        {
            return 0;
        }
        else
        {
            return Carbon::parse($this->expired_day)->diffInDays(Carbon::now()) + 1;
        }
    }

    public function workstation()
    {
        return $this->belongsTo('App\Models\WorkStation','work_station_id');
    }

    public function subscribe()
    {
        return $this->belongsTo('App\Models\Subscriber','subscriber_id');

    }

    public function lockedWorksCount()
    {
        return $this->works()->where('status', 'locked')->count();
        
    }

    public function works()
    {
        return $this->hasMany('App\Models\FreelanceJobWork','freelancer_job_id');
        
    }

    public function worksCountWithoutReject()
    {
        return $this->works()->where('status', '<>', 'rejected')->count();
        
    }

    public function worksClaimedCount()
    {
        return $this->works()->where('status', 'claimed')->count();
        
    }

    public function category()
    {
        return $this->belongsTo('App\Models\JobCategory','category_id');

    }

    public function subcategory()
    {
        return $this->belongsTo('App\Models\JobSubcategory','subcategory_id');

    }
}
