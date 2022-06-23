<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeReport extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function er()
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


    public function erl()
    {
        if($this->last_image)
        {
            return $this->last_image;
        }
        else
        {
            return 'pfi.png';
        }
    }





}
