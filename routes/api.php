<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicationController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/', function () {
    return "funcionando";
});

Route::get('/users', function () {
    return ['users'=>User::query()->get()];
});

Route::get('/publications', [PublicationController::class,'index']);
Route::get('/publications/{publication}', [PublicationController::class,'show']);
Route::get('/comments', [CommentController::class,'index']);
Route::get('/comments/{comment}', [CommentController::class,'show']);



