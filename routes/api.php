<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicationController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "wroking fine";
});

Route::get('/users', function (){
    return ['users'=>User::query()->get()];
});

Route::get('/users/{user}', function (User $user){
    $user->load('comments');
    return ['user'=>$user];
});

Route::get('/publications', [PublicationController::class,'index']);
Route::get('/publications/{publication}', [PublicationController::class,'show']);


Route::post('/publications', [PublicationController::class,'store'])->middleware("auth:sanctum");
Route::delete('/publications/{publication}', [PublicationController::class,'destroy'])->middleware("auth:sanctum");
Route::patch('/publications/{publication}', [PublicationController::class,'update'])->middleware("auth:sanctum");


Route::get('/comments/{comment}', [CommentController::class,'show']);


Route::post('/comments', [CommentController::class,'store'])->middleware("auth:sanctum"); //api/publications/{publication_id}/comments
Route::delete('/comments/{comment}', [CommentController::class,'destroy'])->middleware('auth:sanctum');
Route::patch('/comments/{comment}', [CommentController::class,'update'])->middleware('auth:sanctum');

Route::post('/register',[AuthController::class,'register'])->middleware('guest');
Route::post('/login',[AuthController::class,'store'])->middleware('guest')->name('login');
Route::post('/logout',[AuthController::class,'destroy'])->middleware('auth:sanctum');


