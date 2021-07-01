<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\SecondaryImage;
use App\Models\Variation;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    
    function fetch($page){

        $dataAmount = 20;
        $skip = ($page - 1) * $dataAmount;
       
        $products = Product::withTrashed()->skip($skip)->take($dataAmount)->get();
        $productsCount = Product::withTrashed()->count();

        return response()->json(["products" => $products, "productsCount" => $productsCount, "dataAmount" => $dataAmount]);

    }

    function edit($id){

        $product = Product::where("id", $id)->with("secondaryImages")->first();
        return response()->json(["product" => $product]);

    }

    function store(ProductStoreRequest $request){

        $product = new Product;
        $product->name = $request->name;
        $product->mainImage = $request->image;
        $product->category_id = $request->categoryId;
        $product->brand_id = $request->brandId;
        $product->description = $request->description ? $request->description : "Hello";
        $product->save();

        if(count($request->secondaryImages) > 0){
            $this->storeSecondaryImages($request->secondaryImages, $product->id);
        }

        if(count($request->variations) > 0){
            $this->storeVariations($request->variations, $product->id);
        }

        return response()->json(["success" => true, "msg" => "Producto creado"]);

    }

    function removeSecondaryImages($productId){

        $actualSecondaryImages = SecondaryImage::where("product_id", $productId)->get();
        
        foreach($actualSecondaryImages as $actualImage){

            $path = str_replace(url('/'), "", $actualImage->image);

            if(\File::exists(public_path($path)))
                \File::delete(public_path($path));

            $actualImage->delete();
     

        }

    }

    function storeSecondaryImages($secondaryImages, $productId){

        foreach($secondaryImages as $image){

            $secondaryImage = new SecondaryImage;
            $secondaryImage->product_id = $productId;
            $secondaryImage->image = $image["finalName"];
            $secondaryImage->save();

        }
    }

    function restore(Request $request){

        $product = Product::withTrashed()->find($request->id);
        if($product){

            $product->restore();
            return response()->json(["success" => true, "msg" => "Producto restaurado exitosamente"]);

        }

        return response()->json(["success" => false, "msg" => "Producto no encontrado"]);

    }

    function delete(Request $request){

        $product = Product::find($request->id);
        if($product){

            $secondaryImages = SecondaryImage::where("product_id", $product->id)->get();
            foreach($secondaryImages as $image){

                $path = str_replace(url('/'), "", $image->image);

                if(\File::exists(public_path($path)))
                    \File::delete(public_path($path));

                $image->delete();

            }

            $product->delete();

            return response()->json(["success" => true, "msg" => "Producto eliminado exitosamente"]);

        }

        return response()->json(["success" => false, "msg" => "Producto no encontrado"]);

    }

    function update(ProductUpdateRequest $request){

        $product = Product::find($request->id);
        $product->name = $request->name;

        if($request->image){
            $product->mainImage = $request->image;
        }
        
        $product->category_id = $request->categoryId;
        $product->brand_id = $request->brandId;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->update();

        if(count($request->secondaryImages) > 0){
            $this->removeSecondaryImages($product->id);
            $this->storeSecondaryImages($request->secondaryImages, $product->id);
        }
        

        return response()->json(["success" => true, "msg" => "Producto actualizado"]);

    }

    function storeVariations($variations, $productId){

        foreach($variations as $variation){

            $variationModel = new Variation;
            $variationModel->product_id = $productId;
            $variationModel->price = $variation["price"];
            $variationModel->size_id = $variation["sizeId"];
            $variationModel->amount = $variation["amount"];
            $variationModel->save();

        }

    }

}
