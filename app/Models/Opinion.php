<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function visitIncrement(){
        $this->visit_count = $this->visit_count + 1;
        $this->save();
    }
}
