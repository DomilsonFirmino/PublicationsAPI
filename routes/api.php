<?php

use App\Http\Controllers\AuthController;
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

Route::get('/users', function (){
    return ['users'=>User::query()->get()];
});

Route::get('/publications', [PublicationController::class,'index']);
Route::post('/publications', [PublicationController::class,'store'])->middleware("auth:sanctum");
Route::get('/publications/{publication}', [PublicationController::class,'show']);
Route::get('/comments', [CommentController::class,'index']);
Route::get('/comments/{comment}', [CommentController::class,'show']);
Route::post('/comments', [CommentController::class,'store'])->middleware("auth:sanctum");


Route::post('/register',[AuthController::class,'register'])->middleware('guest');
Route::post('/login',[AuthController::class,'store'])->middleware('guest')->name('login');
Route::post('/logout',[AuthController::class,'destroy'])->middleware('auth:sanctum');


