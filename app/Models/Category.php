<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory;
    
    use HasTranslations;
    protected $fillable = [
        'parent_id','sp_short_p_view_btn_txt','sp_full_p_view_btn_txt'
 
        
    ];
    public $translatable = ['name','description'];


    public function children(){
        return $this->hasMany('App\Models\Category', 'parent_id');
    }
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function imageName()
    {
        return $this->img_name ?: 'wsfi.jpg';
    }


    public function subcategories()
    {
   	 return $this->hasMany('App\Models\Subcategory','category_id');
    }

    public function workstation()
    {
        return $this->belongsTo('App\Models\WorkStation', 'work_station_id');
    }

    public function subscription()
    {
        return $this->hasMany(Subscriber::class, 'category_id');
    }
    public function products(){
        return $this->hasMany(ServiceProfileProduct::class,'ws_cat_id')->where('status','approved');
    }
    public function cai()
    {
        if ($this->banner_name) {
           return $this->banner_name;
        }else {
            return 'sc.png';
        }
    }
    public function ci()
    {
        if ($this->img_name) {
           return $this->img_name;
        }else {
            return 'sc.png';
        }
    }
    public function favourite()
    {
        return $this->morphMany(Favourite::class,'favourable');
    }
    public function isMyFavourite()
    {
        return $this->favourite()->where('user_id',\Auth::id())->count();
    }

    // public function serviceItems()
    // {
    //    return $this->hasMany(Serviceitem::class,'category_id');
    // }

}
