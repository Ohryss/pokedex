<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Move;
use App\Models\User;
use App\Models\Type;
use App\Models\Ability;
use App\Models\Item;
use App\Models\PokemonEvolution;
use App\Models\PokemonLearnMove;
use App\Models\GameVersion;
use App\Models\TypeInteraction;
use App\Models\TypeInteractionState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PokemonController extends Controller
{

    public function index(Request $request)
{
    $query = Pokemon::with(['defaultVariety', 'defaultVariety.types', 'defaultVariety.sprites']);


    // Récupère le type à filtrer
    if ($request->has('type')) {
        $typeId = $request->input('type');

        $query->whereHas('defaultVariety.types', function ($q) use ($typeId) {
            $q->where('types.id', $typeId);
        });
    }

    return $query->paginate(30);
}

    public function show(Pokemon $pokemon)
    {
        return $pokemon->load(['defaultVariety', 'defaultVariety.sprites', 'defaultVariety.types']);
    }
    public function showVarieties(Pokemon $pokemon)
    {
        return $pokemon->varieties()->with(['sprites', 'types'])->get();
    }

    public function moves()
    {
        return Move::get();
    }
    public function move($id)
    {
        $move = Move::findOrFail($id, ['id', 'power', 'accuracy', 'pp', 'move_damage_class_id', 'priority', 'type_id']);
        return response()->json($move);
    }

    public function types()
    {
        return Type::get(['id', 'sprite_url']);
    }
    public function type($id)
    {
        return Type::findOrFail($id, ['id', 'sprite_url']);
    }

    public function typeInterraction($id)
    {
        return TypeInteraction::findOrFail($id, ['id', 'from_type_id', 'to_type_id', 'type_interaction_state_id']);
    }
    public function typeInteractions()
    {
        return TypeInteraction::all(['id', 'from_type_id', 'to_type_id', 'type_interaction_state_id']);
    }


    public function typeInterractionState($id)
    {
        return TypeInteractionState::findOrFail($id, ['id', 'name', 'multiplier']);
    }
    public function typeInterractionStates()
    {
        return TypeInteractionState::all(['id', 'name', 'multiplier']);
    }

    public function getTypeWeaknesses($id)
    {
        $pokemon = Pokemon::with(['varieties.types'])->findOrFail($id);

        // Récupérer les types du Pokémon
        $types = $pokemon->varieties->flatMap(function ($variety) {
            return $variety->types;
        });

        // Initialiser le tableau pour les interactions groupées
        $groupedInteractions = [
            'immune' => [],
            'double_resistances' => [],
            'resistances' => [],
            'weaknesses' => [],
        ];

        // Récupérer les interactions des types
        $typeInteractions = TypeInteraction::whereIn('from_type_id', $types->pluck('id'))
            ->with(['state'])
            ->get();

        foreach ($typeInteractions as $interaction) {
            $multiplier = $interaction->state->multiplier;
            $typeName = Type::find($interaction->to_type_id)->name ?? 'Unknown';

            if ($multiplier == 0) {
                $groupedInteractions['immune'][] = $typeName;
            } elseif ($multiplier == 0.25) {
                $groupedInteractions['double_resistances'][] = $typeName;
            } elseif ($multiplier == 0.5) {
                $groupedInteractions['resistances'][] = $typeName;
            } elseif ($multiplier == 2) {
                $groupedInteractions['weaknesses'][] = $typeName;
            }
        }

        return response()->json($groupedInteractions);
    }





    public function abilities()
    {
        return Ability::get(['id', 'name', 'description', 'effect']);
    }
    public function ability($id)
    {
        return Ability::findOrFail($id, ['id', 'name', 'description', 'effect']);
    }

    public function abilitiesByPokemon($id)
    {
        $pokemonVariety = \App\Models\PokemonVariety::with([
            'abilities' => function ($query) {
                $query->withPivot('is_hidden');
                $query->with('translations'); // Inclut les traductions
            }
        ])->findOrFail($id);

        $abilities = $pokemonVariety->abilities->map(function ($ability) {
            return [
                'id' => $ability->id,
                'name' => $ability->name,
                'description' => $ability->description,
                'effect' => $ability->effect ?? '',
                'is_hidden' => $ability->pivot->is_hidden,
                'translations' => $ability->translations ?? [] // Retourne les traductions
            ];
        });

        return response()->json($abilities);
    }

    public function search(Request $request)
{
    $query = $request->input('query'); // Le texte recherché
    $typeId = $request->input('type'); // Le type de Pokémon filtré

    // Initialiser la requête avec les relations nécessaires
    $pokemonQuery = Pokemon::with(['defaultVariety', 'defaultVariety.sprites', 'defaultVariety.types']);

    // Filtrer par nom ou ID partiel
    if (!empty($query)) {
        $query = trim($query); // Nettoyer l'entrée
        $pokemonQuery->where(function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%') // Recherche insensible à la casse partielle
              ->orWhereHas('translations', function ($t) use ($query) {
                  $t->where('name', 'like', '%' . $query . '%'); // Prend en compte les traductions
              })
              ->orWhereRaw('CAST(id AS CHAR) LIKE ?', ['%' . $query . '%']); // Recherche par ID
        });
    }

    // Filtrer par type
    if (!empty($typeId)) {
        $pokemonQuery->whereHas('defaultVariety.types', function ($q) use ($typeId) {
            $q->where('types.id', $typeId);
        });
    }

    // Paginer les résultats
    $pokemons = $pokemonQuery->paginate(30)->appends([
        'query' => $query,
        'type' => $typeId,
    ]);

    return response()->json($pokemons);
}


    public function items()
    {
        return Item::get(['id', 'sprite_url']);
    }
    public function item($id)
    {
        return Item::findOrFail($id, ['id', 'sprite_url']);
    }

    public function evolutions()
    {
        return PokemonEvolution::with([])
            ->get();
    }

    public function evolution($id)
    {
        $evolution = PokemonEvolution::with([
            'pokemonVariety' => function ($query) {
                $query->select('id', 'name');
            },
            'evolvesTo' => function ($query) {
                $query->select('id', 'name', 'sprite_url');
            }
        ])->findOrFail($id);

        return response()->json($evolution);
    }

    public function learnMoves($id)
    {
        $pokemonLearnMoves = PokemonLearnMove::where('pokemon_variety_id', $id)
            ->with(['move', 'learnMethod', 'versionGroup'])
            ->get();

        return $pokemonLearnMoves;
    }

    public function gameVersions()
    {
        return GameVersion::with('translations')->get(['id', 'identifier', 'generic_name', 'generation']);
    }


    public function addFavorite(Request $request, $id)
    {
        $user = $request->user(); // Récupération de l'utilisateur connecté
    
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        $pokemon = Pokemon::findOrFail($id);
    
        // Vérifie si le Pokémon est déjà favori
        if ($user->favorites()->where('pokemon_id', $pokemon->id)->exists()) {
            return response()->json(['message' => 'Pokémon already in favorites'], 200);
        }
    
        // Ajout du Pokémon aux favoris
        $user->favorites()->attach($pokemon);
    
        return response()->json(['message' => 'Pokémon ajouté aux favoris'], 201);
    }
    

    public function getUserFavorites($userId)
{
    $user = User::findOrFail($userId);
    
    $favorites = $user->favorites()
        ->with(['defaultVariety.sprites', 'defaultVariety.types'])
        ->get();
    
    return response()->json($favorites);
}
public function isFavorite(Request $request, $pokemonId)
{
    $user = $request->user(); // Récupérer l'utilisateur connecté
    
    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Vérifie si le Pokémon est dans les favoris de l'utilisateur
    $isFavorite = $user->favorites()->where('pokemon_id', $pokemonId)->exists();

    return response()->json([
        'pokemon_id' => $pokemonId,
        'is_favorite' => $isFavorite
    ]);
}
public function removeFavorite(Request $request, $id)
{
    $user = $request->user();

    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $pokemon = Pokemon::findOrFail($id);

    // Vérifie si le Pokémon est favori
    if (!$user->favorites()->where('pokemon_id', $pokemon->id)->exists()) {
        return response()->json(['message' => 'Pokémon non présent dans les favoris'], 404);
    }

    // Supprimer le favori
    $user->favorites()->detach($pokemon);

    return response()->json(['message' => 'Pokémon retiré des favoris'], 200);
}


}
