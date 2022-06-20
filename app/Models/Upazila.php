<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{

	public function division(){
		return $this->belongsTo('App\Models\Division', 'division_id');
	}

	public function district(){
		return $this->belongsTo('App\Models\District', 'district_id');
	}
}
