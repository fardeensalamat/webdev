<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function commentable()
    {
        return $this->morphTo();
    }

 

    public function isOfPost()
    {
        if($this->commentable_type == Post::class)
        {
            return true;
        }
        return false;
    }

    public function addedBy()
    {
        return $this->belongsTo('App\Models\User', 'addedby_id')->withoutGlobalScopes();
    }


    //likes
  public function likes()
  {
    return $this->morphMany('App\Models\Like', 'likeable');
  }

  public function isLikedByMe()
    {
        $l = $this->likes()->where('user_id', Auth::id())->first();
        if($l)
        {
            return $l;
        }
        else
        {
            return false;
        }
    }

  public function getTenLikesAttribute()
  {
    return $this->likes()->take(10)->latest()->get()->reverse();
  }

  public function getAllLikesAttribute()
  {
    $likes =  $this->likes()->paginate(10);
    $likes->setPath('likes/for/comment/auto/{comment?}');
    return $likes;
  }

  public function choiceFive()
  {
    return $this->likes()->where('choice', '<=', 5)->count();
  }

  public function choiceFour()
  {
    return $this->likes()->whereBetween('choice', [6,25])->count();
  }

  public function choiceThree()
  {
    return $this->likes()->whereBetween('choice', [26,50])->count();
  }
  public function choiceTwo()
  {
    return $this->likes()->whereBetween('choice', [51,75])->count();
  }

  public function choiceOne()
  {
    return $this->likes()->where('choice', '>', 75)->count();
  }

  public function hasDeletePermission()
  {
    if(($this->addedby_id == Auth::id()) or  
              $this->commentable->addedby_id == Auth::id() or 
              Auth::user()->isAdmin())
    {
      return true;
    }
    return false;
  }


}
