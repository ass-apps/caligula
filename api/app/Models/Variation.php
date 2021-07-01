<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variation extends Model
{
    use HasFactory;
    use SoftDeletes;

    function product(){
        return $this->belongsTo(Product::class);
    }

    function size(){
        return $this->belongsTo(Size::class);
    }
}
