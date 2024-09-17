<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController; // aide le transfert du namespace

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/pokemon', [PokemonController::class, 'index']); //affiche les pokémons sur index

Route::get('/pokemon/{pokemon}', [PokemonController::class, 'show']); //permet d'afficher un pokémon

Route::get('/pokemon/{pokemon}}/varieties', [PokemonController::class, 'showVarieties']); // permet d'afficher les détails d'un pokémon