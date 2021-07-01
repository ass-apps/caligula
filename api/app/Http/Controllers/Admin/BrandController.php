<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    function store(BrandStoreRequest $request){

        try{

            $brand = new Brand;
            $brand->name = $request->name;
            $brand->image = $request->image;
            $brand->save();

            return response()->json(["success" => true, "msg" => "Marca creada"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Algo salió mal", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function update(BrandUpdateRequest $request){

        try{

            $brand = Brand::find($request->id);
            $brand->name = $request->name;
            if(isset($request->image))
                $brand->image = $request->image;
            $brand->update();

            return response()->json(["success" => true, "msg" => "Marca actualizada"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Algo salió mal", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function fetch(){

        $brands = Brand::all();

        return response()->json(["brands" => $brands]);

    }

    function delete(Request $request){

        try{

            $brand = Brand::find($request->id);
            $brand->delete();

            return response()->json(["success" => true, "msg" => "Marca eliminada"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }
}
