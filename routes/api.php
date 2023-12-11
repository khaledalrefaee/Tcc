<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CatController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProducrController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::controller(CatController::class)->group( function(){
    
    Route::get('get/pro/{id}','get_product');

    Route::get('get/all/cat','index');
    Route::post('create/cat','store');
    Route::put('updat/cat/{id}','update');
    Route::get('delete/{id}','destroy');
});
Route::controller(ProducrController::class)->group( function(){

    Route::get('get/all/product','index');
    Route::post('create/product','store');
    Route::put('updat/product/{id}','update');
    Route::get('delete/product/{id}','destroy');
});


Route::controller(UserController::class)->group( function(){

    Route::get('get/all/user','index');
    Route::post('create/user','store');
    Route::put('updat/user/{id}','update');
    Route::get('delete/user/{id}','destroy');
});

Route::post('/login',[AuthController::class,'login']);