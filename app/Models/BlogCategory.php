<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    public function posts(){
		return $this->belongsToMany(Blog::class, 'post_categories', 'category_id', 'post_id');
	}

	public function hasPost($post){
		$row = $this->posts()->where('blogs.id',$post->id)->first();
		if($row){
			return true;
		}
		return false;
	}
	public function postCount(){
		return $this->posts()->where('type','news')->count();
	}
	public function count($type){
		return $this->posts()->where('type',$type)->count();
	}
	public function catwisePost($type){
		return $this->posts()->where('type',$type)->get();
	}


	
	public function haveNews()
	{
		$this->posts()->where('type','news');
	}

	
}
