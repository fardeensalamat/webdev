<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProductVariation extends Model
{
    use HasFactory;
    protected $table = 'service_product_variations';
    public function color()
    {
        return $this->belongsTo(Color::class,'colid');
    }
    public function size()
    {
        return $this->belongsTo(Size::class,'sizid');
    }
}
