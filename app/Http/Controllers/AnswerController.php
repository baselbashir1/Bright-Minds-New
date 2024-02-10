<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function getAnswerById($id)
    {
        $answer = Answer::find($id);

        if ($answer) {
            return response()->json($answer, 200);
        } else {
            return response()->json(['message' => 'Answer not found'], 404);
        }
    }

    public function getAnswerByUserId($userId)
    {
        $answer = Answer::where('user_id', $userId)->first();

        if ($answer) {
            return response()->json($answer, 200);
        } else {
            return response()->json(['message' => 'Answer not found'], 404);
        }
    }

    public function getAnswerByUserIdAndQuestionId($userId, $questionId)
    {
        $answer = Answer::where(['user_id' => $userId, 'question_id' => $questionId])->first();

        if ($answer) {
            return response()->json($answer, 200);
        } else {
            return response()->json(['message' => 'Answer not found'], 404);
        }
    }

    public function addSingleAnswer(Request $request)
    {
        try {
            $validatedRequest = $request->validate([
                'user_id' => ['required', 'numeric'],
                'question_id' => ['required', 'numeric'],
                'answer' => 'required',
            ]);

            Answer::create([
                'user_id' => $validatedRequest['user_id'],
                'question_id' => $validatedRequest['question_id'],
                'answer' => $validatedRequest['answer'],
            ]);

            return response()->json(['success' => 'Answer added successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addMultiAnswer(Request $request)
    {
        try {
            $validatedRequests = $request->validate([
                '*.user_id' => ['required', 'numeric'],
                '*.question_id' => ['required', 'numeric'],
                '*.answer' => 'required',
            ]);

            foreach ($validatedRequests as $validatedRequest) {
                Answer::create([
                    'user_id' => $validatedRequest['user_id'],
                    'question_id' => $validatedRequest['question_id'],
                    'answer' => $validatedRequest['answer'],
                ]);
            }

            return response()->json(['success' => 'Answers added successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
