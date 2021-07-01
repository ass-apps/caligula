<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PurchaseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, "login"]);
    Route::post('logout', [AuthController::class, "logout"]);
    Route::post('refresh', [AuthController::class, "refresh"]);
    Route::get('user', [AuthController::class, "me"]);

});

Route::prefix('admin')->group(function () {
    
    Route::post("/image/store", [ImageController::class, "upload"]);
    
    Route::post("/sizes/store", [SizeController::class, "store"]);
    Route::post("/sizes/delete", [SizeController::class, "delete"]);
    Route::post("/sizes/update", [SizeController::class, "update"]);
    Route::get("/sizes/fetch", [SizeController::class, "fetch"]);

    Route::post("/categories/store", [CategoryController::class, "store"]);
    Route::post("/categories/delete", [CategoryController::class, "delete"]);
    Route::post("/categories/update", [CategoryController::class, "update"]);
    Route::get("/categories/fetch", [CategoryController::class, "fetch"]);

    Route::post("/brands/store", [BrandController::class, "store"]);
    Route::post("/brands/delete", [BrandController::class, "delete"]);
    Route::post("/brands/update", [BrandController::class, "update"]);
    Route::get("/brands/fetch", [BrandController::class, "fetch"]);

    Route::get("/products/fetch/{page}", [ProductController::class, "fetch"]);
    Route::get("/products/edit/{id}", [ProductController::class, "edit"]);
    Route::post("/products/store", [ProductController::class, "store"]);
    Route::post("/products/update", [ProductController::class, "update"]);
    Route::post("/products/delete", [ProductController::class, "delete"]);
    Route::post("/products/restore", [ProductController::class, "restore"]);

    Route::get("/purchases/fetch/{page}", [PurchaseController::class, "fetch"]);

});

