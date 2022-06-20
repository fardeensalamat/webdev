<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    public function likeable()
    {
        return $this->morphTo();
    }

    public function isOfPost()
    {
        if($this->likeable_type == Post::class)
        {
            return true;
        }
        return false;
    }

    public function isOfComment()
    {
    	if($this->likeable_type == Comment::class)
        {
            return true;
        }
        return false;
    }

    public function likedBy()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->withoutGlobalScopes();
    }
}
