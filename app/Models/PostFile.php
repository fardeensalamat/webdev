<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostFile extends Model
{
    use HasFactory;

    public function fimage()
    {
        return $this->file_name ? : 'ppm.jpg';
    }
}
