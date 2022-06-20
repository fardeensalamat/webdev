<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $connection = 'softcodesms';

    protected $table = 'sms_out';

    protected $fillable = ['mobile', 'sms', 'status'];
}
