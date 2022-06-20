<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model
{

	public function districts()
	{
		return $this->hasMany('App\Model\Districts','division_id');
	}

	public function thanas()
	{
		return $this->hasMany('App\Model\Upazilas','division_id');
	}
}
