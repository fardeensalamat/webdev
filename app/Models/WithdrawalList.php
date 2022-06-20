<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawalList extends Model
{
    use HasFactory;
    protected $fillable=[
        'paid_type','paid_from_number','status','editedby_id'
    ];
    public function user()
	{
	    return $this->belongsTo('App\Models\User', 'user_id');
	}
}
