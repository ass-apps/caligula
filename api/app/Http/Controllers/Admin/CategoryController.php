<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    
    function store(CategoryStoreRequest $request){

        try{

            $category = new Category;
            $category->name = $request->name;
            $category->image = $request->image;
            $category->save();

            return response()->json(["success" => true, "msg" => "Categoría creada"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Algo salió mal", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function update(CategoryUpdateRequest $request){

        try{

            $category = Category::find($request->id);
            $category->name = $request->name;
            if(isset($request->image))
                $category->image = $request->image;
            $category->update();

            return response()->json(["success" => true, "msg" => "Categoría actualizada"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Algo salió mal", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function fetch(){

        $categories = Category::all();

        return response()->json(["categories" => $categories]);

    }

    function delete(Request $request){

        try{

            $size = Category::find($request->id);
            $size->delete();

            return response()->json(["success" => true, "msg" => "Categoría eliminada"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

}
