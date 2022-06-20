<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProfileVisitor extends Model
{
    use HasFactory;
    protected $fillable= [
        'workstation_id',
        'ws_cat_id',
        'subscriber_id',
        'user_id',
        'service_profile_id',
        'visit_count',
        'free',
        'short_paid',
        'full_paid',
        'addedby_id',
        'editedby_id'
    ];

    public function personal_profile(){
      return  $this->belongsTo(ServiceProfile::class,'ws_cat_id', 'ws_cat_id')->where('profile_type','personal');
    }

    public function subscriber()
    {
      return $this->belongsTo(Subscriber::class, 'subscriber_id');
    }
    public function serviceProfile()
    {
      return $this->belongsTo(ServiceProfile::class, 'service_profile_id');
    }
    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

}
