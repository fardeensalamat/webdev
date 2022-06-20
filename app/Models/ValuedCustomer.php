<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValuedCustomer extends Model
{
    use HasFactory;
	public function added_by()
    {
        return $this->belongsTo(User::class, 'addedby_id');
    }
    public function vc()
    {
    	if($this->image)
    	{
    		return $this->image;
    	}
    	else
    	{
    		return 'pfi.png';
    	}
    }
}
