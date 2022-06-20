<?php

namespace App\Models;

use Auth;
use App\Models\User;
use App\Models\View;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $fillable = ['title', 'description', 'excerpt'];

    protected $casts = [
        'created_at' => 'datetime',
    ];
    public $translatable = ['title','description', 'excerpt'];

    // public function user()
    // {
    //     return $this->belongsTo('App\Models\User','postable_id','id');
    // }
    
    public function postable()
    {
        return $this->morphTo();
    }

    public function isUserPosted()
      {
        if($this->postable_type == User::class)
        {
          return true;
        }
      }



    //user
  public function addedBy()
  {
    return $this->belongsTo('App\Models\User', 'addedby_id');
  }
  public function editedBy()
  {
    return $this->belongsToMany('App\Model\User', 'editedby_id');
  }

  public function hasDeletePermission()
  {
    if(($this->addedby_id == Auth::id()) or  
      ($this->postable_id == Auth::id() and $this->postable_type == User::class) or (Auth::user()->isAdmin()))
    {
      return true;
    }
    return false;
  }

  public function author(User $user)
  {
    return (bool) $this->addedBy()->where('id', $user->id)->count();
  }

    public function postfiles()
    {
        return $this->hasMany('App\Models\PostFile','post_id');
    }

    public function subscriber()
    {
        return $this->belongsTo('App\Models\Subscriber');
    }

    public function workstation()
    {
        return $this->belongsTo('App\Models\WorkStation','workstation_id');
    }

    public function wscat()
    {
        return $this->belongsTo('App\Models\Category','ws_cat_id');
    }

    //view //viewed //views
  public function views()
  {
      return $this->morphMany('App\Models\View', 'viewable');
  }

  public function viewsCount()
  {
    return $this->views->sum('total_views');
  }

  public function isViewed()
  {
    return (bool) $this->views()
    ->where('user_id',Auth::id())
    ->count();
  }

  public function viewIncrease()
  {
    $v = $this->views()
    ->where('user_id', Auth::id())
    ->first();

    if($v)
    {
      $v->total_views = $v->total_views + 1;
      $v->save();
    }else
    {
      $this->views()->where('user_id', Auth::id())
      ->create(['total_views' => 1, 'user_id' => Auth::id()]);
    }
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
    $likes->setPath('likes/for/post/auto/{post?}');
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


  //comments
  public function comments()
  {
    return $this->morphMany('App\Models\Comment', 'commentable');
  }

  public function getTenCommentsAttribute()
  {
    return $this->comments()->take(10)->latest()->get()->reverse();
  }

  public function selectedComments($number)
  {
    return $this->comments()->take($number)->latest()->get()->reverse();
  }

  public function getAllCommentsAttribute()
  {
    $comments =  $this->comments()->latest()->paginate(4);
    $comments->setPath('opinion/all/for/post/{post?}');
    return $comments;

  }

  public function getAllCommentersAttribute()
  {
    $commenters =  $this->comments()->groupBy('addedby_id')->paginate(4);
    $commenters->setPath('opinion/creator/for/post/{post?}');
    return $commenters;
  }



}
