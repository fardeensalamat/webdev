<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
	public function fi()
    {
        if($this->img_name)
        {
            return 'storage/media/brand/image/'. $this->img_name;
        }
        else
        {
            return 'img/pfi.png';
        }
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function outlets(){
		return $this->belongsToMany('App\Models\Outlet','brand_outlets','brand_id','outlet_id');
	}

	public function hasOutlet($outlet){

		$row = $this->outlets()->where('outlets.id',$outlet->id)->first();
		if($row){
			return true;
		}
		return false;
	}
}
