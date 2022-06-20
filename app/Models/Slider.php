<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $table = 'sliders';

    public function si()
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
