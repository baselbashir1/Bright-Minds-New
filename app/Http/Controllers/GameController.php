<?php

namespace App\Http\Controllers;

use App\Models\Game;

class GameController extends Controller
{
    public function getAllGames()
    {
        $games = Game::all();

        if ($games) {
            return response()->json($games, 200);
        } else {
            return response()->json(['message' => 'Game not found'], 404);
        }
    }

    public function getGameById($id)
    {
        $game = Game::find($id);

        if ($game) {
            return response()->json($game, 200);
        } else {
            return response()->json(['message' => 'Game not found'], 404);
        }
    }

    public function getGameByCategoryId($categoryId)
    {
        $game = Game::where('category_id', $categoryId)->first();

        if ($game) {
            return response()->json($game, 200);
        } else {
            return response()->json(['message' => 'Game not found'], 404);
        }
    }
}
