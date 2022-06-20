<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProfileInfo extends Model
{
    use HasFactory;


        /**
         * Get all of the comments for the ServiceProfileInfo
         *
         * @return \Illuminate\Database\Eloquent\Relations\HasMany
         */
        public function infoValues()
        {
            return $this->hasMany(ServiceProfileInfoValue::class, 'service_profile_info_id');
        }

        public function values($profile)
        {
            return $this->infoValues()->where('service_profile_id',$profile)->first();
        }
        // public function category()
        // {
        //     return $this->belongsTo(Category::class,'category_id');
        // }

}
