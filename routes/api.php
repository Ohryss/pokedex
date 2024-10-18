<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController; // aide le transfert du namespace

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'pokemon'], function (){
    Route::get('/', [PokemonController::class, 'index']);
    Route::get('/{pokemon}', [PokemonController::class, 'show']);
    Route::get('/{pokemon}/varieties', [PokemonController::class, 'showVarieties']);
});

Route::group(['prefix' => 'moves'], function (){
    Route::get('/', [PokemonController::class, 'moves']);
    Route::get('/{id}', [PokemonController::class, 'move']);
});

Route::group(['prefix' => 'types'], function (){
    Route::get('/', [PokemonController::class, 'types']);
    Route::get('/{id}', [PokemonController::class, 'type']);
});

Route::group(['prefix' => 'abilities'], function () {
    Route::get('/', [PokemonController::class, 'abilities']);   
    Route::get('/{id}', [PokemonController::class, 'ability']); 
});

Route::group(['prefix' => 'items'], function () {
    Route::get('/', [PokemonController::class, 'items']);
    Route::get('/{id}', [PokemonController::class, 'item']);
});

Route::group(['prefix' => 'evolutions'], function () {
    Route::get('/', [PokemonController::class, 'evolutions']);
    Route::get('/{id}', [PokemonController::class, 'evolution']);
});


Route::get('/pokemon/{id}/learn-moves', [PokemonController::class, 'learnMoves']);