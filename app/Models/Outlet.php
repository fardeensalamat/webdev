<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    public function district()
    {
       return $this->belongsTo('App\Models\District', 'district_id');
    }

    public function thana()
    {
       return $this->belongsTo('App\Models\Upazila', 'thana_id');
    }

    public function division()
    {
       return $this->belongsTo('App\Models\Division', 'division_id');
    }

    public function items()
    {
    	return $this->hasMany('App\Models\BrandOutlet', 'outlet_id');
    }

   public function brands()
	{
		return $this->belongsToMany('App\Models\ProductBrand', 'brand_outlets', 'outlet_id', 'brand_id' );
	}
}
