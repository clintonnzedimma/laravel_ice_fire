<?php
use App\Http\Controllers\BookController;
use App\Http\Controllers\ExternalBookController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/external-books', [ExternalBookController::class , "find"]);

//books
Route::post('/v1/books', [BookController::class , "create"]);
Route::get('/v1/books', [BookController::class , "read"]);
Route::patch('/v1/books/{id}', [BookController::class , "update"]);
Route::delete('/v1/books/{id}', [BookController::class , "delete"]);
Route::post('/v1/books/{id}/delete', [BookController::class , "delete"]);
Route::get('/v1/books/search', [BookController::class , "search"]);
Route::get('/v1/books/{id}', [BookController::class , "findOne"]);