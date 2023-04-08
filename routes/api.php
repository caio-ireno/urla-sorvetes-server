<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SorveteController;
use App\Http\Controllers\Api\LojaController;
use App\Http\Controllers\Api\NoticiaController;
use App\Http\Controllers\Api\HistoriaController;
use App\Http\Controllers\Api\ContatoController;
use App\Http\Controllers\Api\SaboresController;


Route::middleware('auth:sanctum')->get('user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function(){
    Route::post('login',[\App\Http\Controllers\Auth\Api\LoginController::class,'login']);
    Route::post('logout',[\App\Http\Controllers\Auth\Api\LoginController::class,'logout']);
    Route::post('register',[\App\Http\Controllers\Auth\Api\RegisterController::class,'register']);
});

Route::prefix('/')->group(function(){
    Route::get('sorvetes/{sorvete}', [SorveteController::class, 'show']);
    Route::get('lojas/{loja}', [LojaController::class, 'show']);
    Route::get('noticias/{noticia}', [NoticiaController::class, 'show']);
    Route::get('historias/{historia}', [HistoriaController::class, 'show']);
    Route::get('contatos/{contato}', [ContatoController::class, 'show']);
    Route::get('sabores/{sabor}', [SaboresController::class, 'show']);
});

Route::prefix('/')->group(function(){
    Route::get('sorvetes', [SorveteController::class, 'index']);
    Route::get('lojas', [LojaController::class, 'index']);
    Route::get('noticias', [NoticiaController::class, 'index']);
    Route::get('historias', [HistoriaController::class, 'index']);
    Route::get('contatos', [ContatoController::class, 'index']);
    Route::get('sabores', [SaboresController::class, 'index']);
});

Route::middleware('auth:sanctum')->prefix('/')->group(function(){
    Route::post('sorvetes', [SorveteController::class, 'store']);
    Route::post('lojas', [LojaController::class, 'store']);
    Route::post('noticias', [NoticiaController::class, 'store']);
    Route::post('historias', [HistoriaController::class, 'store']);
    Route::post('contatos', [ContatoController::class, 'store']);
    Route::post('sabores', [SaboresController::class, 'store']);
});

Route::middleware('auth:sanctum')->prefix('/')->group(function(){
    Route::put('sorvetes/{sorvete}', [SorveteController::class, 'update']);
    Route::put('lojas/{loja}', [LojaController::class, 'update']);
    Route::put('noticias/{noticia}', [NoticiaController::class, 'update']);
    Route::put('historias/{historia}', [HistoriaController::class, 'update']);
    Route::put('contatos/{contato}', [ContatoController::class, 'update']);
    Route::put('sabores/{sabor}', [SaboresController::class, 'update']);
});

Route::middleware('auth:sanctum')->prefix('/')->group(function(){
    Route::delete('sorvetes/{sorvete}', [SorveteController::class, 'destroy']);
    Route::delete('lojas/{loja}', [LojaController::class, 'destroy']);
    Route::delete('noticias/{noticia}', [NoticiaController::class, 'destroy']);
    Route::delete('historias/{historia}', [HistoriaController::class, 'destroy']);
    Route::delete('contatos/{contato}', [ContatoController::class, 'destroy']);
    Route::delete('sabores/{sabor}', [SaboresController::class, 'destroy']);
});

