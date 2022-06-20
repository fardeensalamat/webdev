<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUpdateInformation extends Model
{
    use HasFactory;
    public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id');
	}
	public function updatedBy()
	{
	    return $this->belongsTo('App\Models\User', 'addedby_id');
	}
	
}
