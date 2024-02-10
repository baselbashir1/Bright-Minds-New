<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function getProgressById($id)
    {
        $progress = Progress::find($id);

        if ($progress) {
            return response()->json($progress, 200);
        } else {
            response()->json(['message' => 'Progress not found'], 404);
        }
    }

    public function getProgressByUserId($userId)
    {
        $progress = Progress::where('user_id', $userId)->first();

        if ($progress) {
            return response()->json($progress, 200);
        } else {
            response()->json(['message' => 'Progress not found'], 404);
        }
    }

    public function getProgressByGameId($gameId)
    {
        $progress = Progress::where('game_id', $gameId)->first();

        if ($progress) {
            return response()->json($progress, 200);
        } else {
            response()->json(['message' => 'Progress not found'], 404);
        }
    }

    public function getProgressByUserIdAndGameId($userId, $gameId)
    {
        $progress = Progress::where(['user_id' => $userId, 'game_id' => $gameId])->first();

        if ($progress) {
            return response()->json($progress, 200);
        } else {
            response()->json(['message' => 'Progress not found'], 404);
        }
    }

    public function addProgress(Request $request)
    {
        try {
            $validatedRequest = $request->validate([
                'user_id' => ['required', 'numeric'],
                'game_id' => ['required', 'numeric'],
                'level' => ['required', 'numeric'],
                'level_content' => 'required',
                'fails' => ['required', 'numeric'],
            ]);

            Progress::create([
                'user_id' => $validatedRequest['user_id'],
                'game_id' => $validatedRequest['game_id'],
                'level' => $validatedRequest['level'],
                'level_content' => $validatedRequest['level_content'],
                'fails' => $validatedRequest['fails'],
            ]);

            return response()->json(['success' => 'Progress added successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
