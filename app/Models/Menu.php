<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function pages(){
		return $this->belongsToMany('App\Models\Page', 'menu_pages', 'menu_id', 'page_id')->where('pages.active', true);
	}

	public function hasPage($page){
		$row = $this->pages()->where('pages.id',$page->id)->first();
		if($row){
			return true;
		}
		return false;
	}

	public function addedBy()
	{
		return $this->belongsTo('App\Models\User', 'addedby_id');
	}
    public function subMenus()
    {
        return $this->hasMany('App\Models\Menu', 'parent_id');
    }
    public function parentMenu()
    {
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }
}
