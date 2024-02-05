<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\InformationEbookController;
use App\Http\Controllers\UserSavedBooksController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//User :



Route::post('register', [AuthController::class, 'register']);
Route::post('login',  [AuthController::class,'login']);
// Route::post('/google-login', [AuthController::class, 'loggoogle']);



//protected token

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//like api
// Route::middleware('auth:sanctum')->group(function () {
    // Route::post('/save-book/{bookId}', [UserSavedBooksController::class, 'saveBook'])->middleware('auth:api');

 Route::post('/save-book', [UserSavedBooksController::class, 'saveBook'])->middleware('auth');
// Route::delete('/unsave-book/{bookId}', [UserSavedBooksController::class, 'unsaveBook'])->middleware('auth:api');

// });

//books :



Route::get('books', [BookController::class, 'books']);
Route::post('upload', [BookController::class, 'upload']);
Route::post('uploaddata', [BookController::class, 'uploaddata']);


////book information
Route::get('book/{title}', [InformationEbookController::class, 'information']);

//search book
Route::get('books/search', [BookController::class, 'search']);