<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{

  public function thanas()
	{
		return $this->hasMany('App\Models\Upazila','district_id');
	}

	public function division(){
		return $this->belongsTo('App\Models\Division', 'division_id');
	}

}
