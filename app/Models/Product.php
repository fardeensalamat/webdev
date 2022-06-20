<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function fi()
    {
    	if($this->feature_img)
    	{
    		return 'storage/product/fi/'.$this->feature_img;
    	}
    	else
    	{
    		return 'img/pfi.png';
    	}
    }

    public function usliveFi()
    {
        if($this->feature_img)
        {
            return $this->feature_img;
        }
        else
        {
            return 'pfi.png';
        }
    }

    public function imageFirst()
    {
        return (bool) $this->media()
        ->where('file_type', 'image')
        ->first();
    }

    public function images()
    {
        return $this->media()->where('file_type','image')->where('collection_name','product_extra_image')->get();
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\ProductBrand');
    }
}
