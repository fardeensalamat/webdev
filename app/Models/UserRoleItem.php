<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRoleItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'role_id',
        'user_id',
        'addedby_id'
    ];
}
