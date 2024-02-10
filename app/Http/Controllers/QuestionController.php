<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getAllQuestions()
    {
        $questions = Question::all();

        if ($questions) {
            return response()->json($questions, 200);
        } else {
            response()->json(['message' => 'Question not found'], 404);
        }
    }

    public function getQuestionById($id)
    {
        $question = Question::find($id);

        if ($question) {
            return response()->json($question, 200);
        } else {
            response()->json(['message' => 'Question not found'], 404);
        }
    }

    public function addQuestion(Request $request)
    {
        try {
            $validatedRequest = $request->validate([
                'question' => 'required',
            ]);

            Question::create([
                'question' => $validatedRequest['question'],
            ]);

            return response()->json(['success' => 'Question added successfully.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
