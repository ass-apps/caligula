<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic;
use Carbon\Carbon;

class ImageController extends Controller
{
    function upload(Request $request){

        $originName = $request->file('file')->getClientOriginalName();
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileName = Carbon::now()->timestamp . '_' . uniqid().'.'.$extension;
    
        $request->file('file')->move(public_path('uploads'), $fileName);
        $fileRoute = url('/').'/uploads/'.$fileName;

        $img = ImageManagerStatic::make('uploads/'.$fileName);
        $img->save('uploads/'.$fileName, 60);

        return response()->json(["fileRoute" => $fileRoute, "originalName" => $originName,"extension" => $extension]);

    }
}
