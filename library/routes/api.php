<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BookLoansController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FileServeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
});

Route::get('/books', [BooksController::class, 'index']);


Route::get('/media/{file}', [FileServeController::class, 'serve']);

Route::middleware('jwt.verify')->group(function () {
    Route::middleware('admin.verify')->group(function () {
        Route::get('/loans', [BookLoansController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/books', [BooksController::class, 'store']);
    });
    // Users
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    //books
    Route::delete('/books/{id}', [BooksController::class, 'destroy']);
    Route::post('/book/{id}', [BooksController::class, 'update']);
    Route::get('/books/{id}', [BooksController::class, 'show']);

    //loans
    Route::post('/request/{bookid}', [BookLoansController::class, 'store']);
    Route::get('/requests', [BookLoansController::class, 'index_by_user']);
    Route::delete('/loans/{id}', [BookLoansController::class, 'destroy']);
    Route::put('/loans/{id}', [BookLoansController::class, 'update']);
    Route::get('/loans/{id}', [BookLoansController::class, 'show']);
});
