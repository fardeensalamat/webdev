<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryMan extends Model
{
    use HasFactory;
    protected $table = 'deliverymans';

    public function pi()
    {
    	if($this->profile_image)
    	{
    		return $this->profile_image;
    	}
    	else
    	{
    		return 'pfi.png';
    	}
    }

    public function ni()
    {
    	if($this->nid_image)
    	{
    		return $this->nid_image;
    	}
    	else
    	{
    		return 'pfi.png';
    	}
    }
}
