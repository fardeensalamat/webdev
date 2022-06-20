<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function items()
    {
    	return $this->hasMany('App\Models\PageItem', 'page_id');
    }

    public function menus()
	{
		return $this->belongsToMany('App\Models\Menu', 'menu_pages', 'page_id', 'menu_id');
	}
}
