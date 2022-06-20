<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProfileInfoValue extends Model
{
    use HasFactory;
    protected $fillable=['profile_info_value'];
    public function serviceInfo()
    {
        return $this->belongsto('App\Models\ServiceProfileInfo','service_profile_info_id');
    }
}
