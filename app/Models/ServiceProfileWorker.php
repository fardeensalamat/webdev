<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProfileWorker extends Model
{
    use HasFactory;
    public function serviceProfile()
    {
        return $this->belongsTo(ServiceProfile::class, 'profile_id');
    }
    public function profileowner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function worker()
    {
        return $this->belongsTo(SoftcomJobCandidate::class, 'worker_id');
    }
    public function workerprofile()
    {
        return $this->belongsTo(User::class, 'worker_user_id');
    }
    public function applicantcategory()
    {
        return $this->belongsTo(SoftcomApplicantCategory::class, 'category');
    }

}
