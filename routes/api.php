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

    Route::apiResource('sorvetes',\App\Http\Controllers\Api\SorveteController::class)->only([  'index','show']);
    Route::apiResource('lojas',\App\Http\Controllers\Api\LojaController::class)->only(['index','show']);
    Route::apiResource('noticias',\App\Http\Controllers\Api\NoticiaController::class)->only([  'index','show']);
    Route::apiResource('historias',\App\Http\Controllers\Api\HistoriaController::class)->only(['index','show']);
    Route::apiResource('contatos',\App\Http\Controllers\Api\ContatoController::class)->only([  'index','show']);

    Route::apiResource('/sabores', \App\Http\Controllers\Api\SaboresController::class)->only([ 'index','show']);
    Route::apiResource('sorvetes.sabores',\App\Http\Controllers\Api\SaboresController::class)->only([  'index','show']);

// Rotas autenticadas
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('sorvetes',\App\Http\Controllers\Api\SorveteController::class)->except(['index', 'show']);;
    Route::apiResource('lojas',\App\Http\Controllers\Api\LojaController::class)->except(['index', 'show']);;
    Route::apiResource('noticias',\App\Http\Controllers\Api\NoticiaController::class)->except(['index', 'show']);;
    Route::apiResource('historias',\App\Http\Controllers\Api\HistoriaController::class)->except(['index', 'show']);;
    Route::apiResource('contatos',\App\Http\Controllers\Api\ContatoController::class)->except(['index', 'show']);;

    Route::apiResource('/sabores', \App\Http\Controllers\Api\SaboresController::class)->except(['index', 'show']);;
    Route::apiResource('sorvetes.sabores',\App\Http\Controllers\Api\SaboresController::class)->except(['index', 'show']);;
});

Route::prefix('auth')->group(function(){
    Route::post('login',[\App\Http\Controllers\Auth\Api\LoginController::class,'login']);
    Route::post('logout',[\App\Http\Controllers\Auth\Api\LoginController::class,'logout']);
    Route::post('register',[\App\Http\Controllers\Auth\Api\RegisterController::class,'register']);


});
