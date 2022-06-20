<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    	public function blogCategories()
	{
		return $this->belongsToMany(BlogCategory::class, 'post_categories', 'post_id', 'category_id');
	}
	public function fi()
	{
		if ($this->feature_img_name) {
			return $this->feature_img_name;
		}else {
			return 'ppm.jpg';
		}
	}
	public function cats(){
		$cats = '';
		if($this->blogCategories->count())
		{			
			foreach($this->blogCategories as $cat){
				$cats .= $cat->name . ', ';
			}
		}
		return $cats;
	}
	// public function badgeCats(){
	// 	$cats = '';
	// 	if($this->blogCategories->count())
	// 	{			
	// 		foreach($this->blogCategories as $cat){
	// 			$cats .= '<span class="badge badge-info">'.$cat->name.'<span>';
	// 		}
	// 	}
	// 	return $cats;
	// }
	public function user()
	{
		return $this->belongsTo(User::class,'addedby_id');
	}
}
