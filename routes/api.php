<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PokemonController; // aide le transfert du namespace
use App\Http\Controllers\Auth\OAuthController;

Route::prefix('auth')->group(function () {
    Route::get('/redirect', [OAuthController::class, 'redirect']);
    Route::get('/callback', [OAuthController::class, 'callback']);
    Route::middleware('auth:sanctum')->post('/logout', [OAuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
      return $request->user();
    });


    Route::group(['prefix' => 'interactions'], function () {
        Route::get('/', [PokemonController::class, 'typeInteractions']); // Retourne toutes les interactions
        Route::get('/{id}', [PokemonController::class, 'typeInterraction']); // Retourne une interaction spécifique
    });
    
    Route::get('/pokemon/{id}/type-interactions', [PokemonController::class, 'getTypeInteractionsByPokemon']);


Route::group(['prefix' => 'interaction-states'], function () {
    Route::get('/', [PokemonController::class, 'typeInterractionStates']); // Retourne tous les états
    Route::get('/{id}', [PokemonController::class, 'typeInterractionState']); // Retourne un état spécifique
});

Route::get('/pokemon/{id}/type-interactions', [PokemonController::class, 'getTypeInteractionsByPokemon']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'pokemon'], function () {
    Route::get('/', [PokemonController::class, 'index']);
    Route::get('/search', [PokemonController::class, 'search']); // Déclaration correcte
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


Route::get('/pokemon/{id}/abilities', [PokemonController::class, 'abilitiesByPokemon']);


Route::get('/pokemon/{id}/learn-moves', [PokemonController::class, 'learnMoves']);

Route::get('/pokemon/{id}/weaknesses', [PokemonController::class, 'getTypeWeaknesses']);



Route::group(['prefix' => 'game-versions'], function () {
    Route::get('/', [PokemonController::class, 'GameVersions']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pokemon/{id}/favorite', [PokemonController::class, 'addFavorite']); // Ajouter aux favoris
    Route::get('/users/{userId}/favorites', [PokemonController::class, 'getUserFavorites']); // Favoris d'un utilisateur spécifique
    Route::middleware('auth:sanctum')->get('/pokemon/{id}/is-favorite', [PokemonController::class, 'isFavorite']);
    Route::delete('/pokemon/{id}/favorite', [PokemonController::class, 'removeFavorite']);

});

});
