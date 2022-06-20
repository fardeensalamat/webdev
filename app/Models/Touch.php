<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Touch extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'notify_type',  //shop,main,message,frtm
        'notify_value'
    ];
    public $timestamps = false;
}
