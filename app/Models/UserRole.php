<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
        protected $fillable = [
		'user_id',
		'role_name',
		'role_value',
		'addedby_id',
		'editedby_id',
    ];

  	public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function addedBy()
	{
      	return $this->belongsTo('App\Models\User', 'addedby_id');
	}

	public function editedBy()
	{
		return $this->belongsTo('App\Models\User', 'editedby_id');
	}

	public function roleItems()
	{
		return $this->hasMany('App\Models\UserRoleItem','role_id');
	}
}
