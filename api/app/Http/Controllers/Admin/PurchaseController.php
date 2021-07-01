<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    
    function fetch($page){

        $dataAmount = 20;
        $skip = ($page - 1) * $dataAmount;
       
        $purchases = Purchase::skip($skip)->take($dataAmount)->with("purchasedVariations", "user", "purchasedVariations.variation", "purchasedVariations.variation.product", "purchasedVariations.variation.product.brand")->get();
        $purchasesCount = Purchase::with("purchasedVariations", "user", "purchasedVariations.variation", "purchasedVariations.variation.product", "purchasedVariations.variation.product.brand")->count();

        return response()->json(["purchases" => $purchases, "purchasesCount" => $purchasesCount, "dataAmount" => $dataAmount]);

    }

}
