<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/getAnswerById/{id}', [AnswerController::class, 'getAnswerById']);
Route::get('/getAnswerByUserId/{userId}', [AnswerController::class, 'getAnswerByUserId']);
Route::get('/getAnswerByUserIdAndQuestionId/{userId}/{questionId}', [AnswerController::class, 'getAnswerByUserIdAndQuestionId']);
Route::post('/addSingleAnswer', [AnswerController::class, 'addSingleAnswer']);
Route::post('/addMultiAnswer', [AnswerController::class, 'addMultiAnswer']);

Route::get('/getAllCategories', [CategoryController::class, 'getAllCategories']);
Route::get('/getCategoryById/{id}', [CategoryController::class, 'getCategoryById']);
Route::post('/addCategory', [CategoryController::class, 'addCategory']);

Route::get('/getAllGames', [GameController::class, 'getAllGames']);
Route::get('/getGameById/{id}', [GameController::class, 'getGameById']);
Route::get('/getGameByCategoryId/{categoryId}', [GameController::class, 'getGameByCategoryId']);

Route::get('/getProgressById/{id}', [ProgressController::class, 'getProgressById']);
Route::get('/getProgressByUserId/{userId}', [ProgressController::class, 'getProgressByUserId']);
Route::get('/getProgressByGameId/{gameId}', [ProgressController::class, 'getProgressByGameId']);
Route::get('/getProgressByUserIdAndGameId/{userId}/{gameId}', [ProgressController::class, 'getProgressByUserIdAndGameId']);
Route::post('/addProgress', [ProgressController::class, 'addProgress']);

Route::get('/getAllQuestions', [QuestionController::class, 'getAllQuestions']);
Route::get('/getQuestionById/{id}', [QuestionController::class, 'getQuestionById']);
Route::post('/addQuestion', [QuestionController::class, 'addQuestion']);

