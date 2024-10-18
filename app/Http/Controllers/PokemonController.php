<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Move;
use App\Models\Type;
use App\Models\Ability;
use App\Models\Item;
use App\Models\PokemonEvolution;
use App\Models\PokemonLearnMove;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    public function index()
    {
        return Pokemon::with(['defaultVariety', 'defaultVariety.sprites'])
            ->paginate(30);
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
        $move = Move::findOrFail($id, ['id','power', 'accuracy', 'pp', 'move_damage_class_id', 'priority', 'type_id']);
        return response()->json($move);
    }

    public function types()     
    {
        return Type::get(['id','sprite_url']);
    }
    public function type($id)
    {
        return Type::findOrFail($id, ['id','sprite_url']);
    }

    public function abilities()
    {
        return Ability::get(['id', 'name', 'description', 'effect']);
    }
    public function ability($id)
    {
        return Ability::findOrFail($id, ['id', 'name', 'description', 'effect']);
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
        return PokemonEvolution::with([])
                               ->findOrFail($id);
    }
    public function learnMoves($id)
    {
        $pokemonLearnMoves = PokemonLearnMove::where('pokemon_variety_id', $id)
            ->with(['move', 'learnMethod', 'versionGroup' ])
            ->get();

            return $pokemonLearnMoves;
    }

}
