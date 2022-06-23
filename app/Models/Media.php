<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    
    use HasFactory;
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category');
    }
    public function workstations()
    {
        return $this->belongsTo(WorkStation::class, 'workstation');
    }
    public function model()
    {
        return $this->morphTo();
    }
}


// public function user()
// {
//     return $this->belongsTo(User::class, 'user_id');
// }