<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseOrder extends Model
{
    use HasFactory;
    protected $table = 'courseorders';

    public function course()
    {
        return $this->belongsTo(Courseitem::class, 'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function serviceProfile()
    {
        return $this->belongsTo(ServiceProfile::class, 'service_profile_id');
    }
}
