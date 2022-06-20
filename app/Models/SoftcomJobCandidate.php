<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoftcomJobCandidate extends Model
{
    use HasFactory;
	public function applicantcategory()
    {
        return $this->belongsTo(SoftcomApplicantCategory::class, 'category');
    }

	public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function pi()
    {
    	if($this->candidate_image)
    	{
    		return $this->candidate_image;
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
