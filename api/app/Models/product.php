<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    use SoftDeletes;

    function secondaryImages(){
        return $this->hasMany(SecondaryImage::class);
    }

    function variations(){
        return $this->hasMany(Variation::class);
    }

    function brand(){
        return $this->belongsTo(Brand::class);
    }

}
