<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SizeStoreRequest;
use App\Models\Size;

class SizeController extends Controller
{
    
    function store(SizeStoreRequest $request){

        try{

            $size = new Size;
            $size->name = $request->name;
            $size->gender = $request->gender;
            $size->save();

            return response()->json(["success" => true, "msg" => "Tamaño creado"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function update(SizeStoreRequest $request){

        try{

            $size = Size::find($request->id);
            $size->name = $request->name;
            $size->gender = $request->gender;
            $size->update();

            return response()->json(["success" => true, "msg" => "Tamaño actualizado"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function delete(Request $request){

        try{

            $size = Size::find($request->id);
            $size->delete();

            return response()->json(["success" => true, "msg" => "Tamaño eliminado"]);

        }catch(\Exception $e){

            return response()->json(["success" => false, "msg" => "Hubo un problema", "err" => $e->getMessage(), "ln" => $e->getLine()]);

        }

    }

    function fetch(){

        $sizes = Size::all();
        return response()->json(["sizes" => $sizes]);

    }

}
