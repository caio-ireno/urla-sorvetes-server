<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('sorvetes',\App\Http\Controllers\Api\SorveteController::class);
Route::apiResource('lojas',\App\Http\Controllers\Api\LojaController::class);
Route::apiResource('noticias',\App\Http\Controllers\Api\NoticiaController::class);
Route::apiResource('historias',\App\Http\Controllers\Api\HistoriaController::class);

Route::apiResource('/sabores', \App\Http\Controllers\Api\SaboresController::class);
Route::apiResource('sorvetes.sabores',\App\Http\Controllers\Api\SaboresController::class);


