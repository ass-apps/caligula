<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Purchase;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Size;
use App\Models\Product;
use App\Models\Variation;
use App\Models\PurchasedVariation;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        if(env("TEST_PURCHASE") == true){

            $brand = new Brand;
            $brand->name = "Caligula";
            $brand->image = "https://cdn.cnetcontent.com/3e/52/3e529cf8-161a-43a0-b154-30d5636f70ae.jpg";
            $brand->save();

            $category = new Category;
            $category->name = "Categoria 1";
            $category->image = "https://cdn.cnetcontent.com/3e/52/3e529cf8-161a-43a0-b154-30d5636f70ae.jpg";
            $category->save();

            $size = new Size;
            $size->name = "S";
            $size->gender = "masculino";
            $size->save();

            $product = new Product;
            $product->name = "Producto 1";
            $product->mainImage = "https://cdn.cnetcontent.com/3e/52/3e529cf8-161a-43a0-b154-30d5636f70ae.jpg";
            $product->description = "<h1>dad</h1>";
            $product->brand_id = $brand->id;
            $product->category_id = $category->id;
            $product->save();

            $variation = new Variation;
            $variation->product_id = $product->id;
            $variation->size_id = $size->id;
            $variation->price = 120000;
            $variation->amount = 5;
            $variation->save();

            $purchase = new Purchase;
            $purchase->name = "Cliente 1";
            $purchase->lastname = "Cliente 1";
            $purchase->email = "cliente1@gmail.com";
            $purchase->address = "direccion cliente 1";
            $purchase->phone = "212 4512321";
            $purchase->total = "120000";
            $purchase->order_id = "1123432ewsdf";
            $purchase->status = "Enviado";
            $purchase->save(); 

            $purchaseVariation = new PurchasedVariation;
            $purchaseVariation->purchase_id = $purchase->id;
            $purchaseVariation->price = $variation->price;
            $purchaseVariation->amount = 1;
            $purchaseVariation->variation_id = $variation->id;
            $purchaseVariation->save();


        }

    }
}
