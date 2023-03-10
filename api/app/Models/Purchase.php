<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    function purchasedVariations(){
        return $this->hasMany(PurchasedVariation::class);
    }

    function user(){
        return $this->belongsTo(User::class);
    }
}
