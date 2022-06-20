<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminBalance extends Model
{
    use HasFactory;
    protected $fillable = [
        'work_station_id',
        'previous_balance',
        'transfer_balance',
        'new_balance',
        'type',
        'last'
    ];
}
