<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'purpose'
    ];
    
    public function workStation()
    {
        return $this->belongsTo('App\Models\WorkStation');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function subscriber()
    {
        return $this->belongsTo('App\Models\Subscriber','subscriber_id','id');
    }
    public function order()
    {
        return $this->hasMany(WithdrawalList::class,'transaction_id');
    }
    
    
}
