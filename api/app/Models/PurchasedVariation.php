<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedVariation extends Model
{
    use HasFactory;

    function purchase(){
        return $this->belongsTo(Purchase::class);
    }

    function variation(){
        return $this->belongsTo(Variation::class);
    }
}
