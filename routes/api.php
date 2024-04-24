<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;
use App\Http\Controllers\AuthController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login',[AuthController::class,'login'])->name('login');

Route::controller(NewController::class)->middleware('auth:sanctum')->prefix('new')->group(function () {
    Route::get('list', 'newsList');
    Route::get('recursive-search', 'recursiveSearch');
    Route::get('category-search/{category_name}', 'searchByCategory');
    Route::get('{newModel}', 'show');
    Route::post('', 'store');
    Route::put('{newModel}', 'update');
    Route::delete('{newModel}', 'destroy');
});