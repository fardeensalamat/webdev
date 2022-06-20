<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;
    public function fi()
    {
        return $this->image ? $this->image : 'ppm.jpg';
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function admin()
    {
        return $this->belongsTo(User::class,'admin_id');
    }
    function hasUserParentOpen($user)
    {
       return $this->where('user_id',$user)->where('parent_id',null)->where('closed',false)->first();
    }
    public function suggessionDiscuss($parent)
    {
        return $this->where('parent_id',$parent)->get();
    }
    function hasParentOpend($suggession)
    {
       return  $this->where('id',$suggession)->first()->closed;
    }
    function hasParentCLosed()
    {
       return (bool) $this->where('closed',true)->first();
    }

}
