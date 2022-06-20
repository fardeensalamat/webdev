<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreelanceJobWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'approved_at',
        'distributed_at',
        'job_owner_note',
        'admin_note',
        'pending_at',
        'rejected_at',
        'editedby_id',
        'work_station_id',
        'subscriber_id',
        'user_id',
        'freelancer_job_id',
        'category_id',
        'subcategory_id',
        'title',
        'description',
        'created_at',
        'updated_at'
    ];

    public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id');
	} 

	public function fiName()
    {
        return $this->img ? $this->img : 'image.png';
    }

    public function fiName2()
    {
        return $this->img2 ? $this->img2 : 'image.png';
    }

    public function workstation()
    {
        return $this->belongsTo('App\Models\WorkStation','work_station_id');
    }

    public function earn()
    {
        return $this->belongsTo('App\Models\FreelancerJob','freelancer_job_id');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\FreelancerJob','freelancer_job_id');
    }

    public function jobcategory()
    {
        return $this->belongsTo('App\Models\JobCategory','category_id');
    }

    public function jobsubcategory()
    {
        return $this->belongsTo('App\Models\JobSubcategory','subcategory_id');
    }

    public function subscriber()
    {
        return $this->belongsTo('App\Models\Subscriber','subscriber_id');
    }
    
    public function bt(){
        return $this->hasOne('App\Models\BalanceTransaction', 'type_id','id')->where('purpose', 'work_done')->where('type', 'App\Models\FreelanceJobWork');
    }

    public function balanceTransactions(){
        return $this->hasOne('App\Models\BalanceTransaction', 'subscriber_id','subscriber_id');
    }

    /**
     * Get all of the comments for the FreelanceJobWork
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function workDonelink() 
    {
        return $this->hasOne(JobWorkLink::class, 'work_id');
    }
}
