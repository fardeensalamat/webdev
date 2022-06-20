<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProductImage extends Model
{
    use HasFactory;
public function galary_image()
{
  return $this->belongsTo(ServiceProfileProduct::class,'product_id');
}
}
