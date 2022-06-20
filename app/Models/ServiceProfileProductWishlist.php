<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProfileProductWishlist extends Model
{
    use HasFactory;
    function product()
    {
      return  $this->belongsTo(ServiceProfileProduct::class,'service_product_id');
    }
}
