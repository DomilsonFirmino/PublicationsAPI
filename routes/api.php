<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicationController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "working fine";
});

Route::get('/users', function (Request $request){
    $page_size = $request->size ?? 10;
    $users = User::latest()->paginate($page_size);
    return ['users'=> $users];
});

Route::get('/users/{user}', function (User $user){
    return ['user'=>$user];
});

Route::get('/users/{user}/comments', function (User $user, Request $request){
    // $comments = Comment::where('user_id','=',$user->id)->paginate(2);
    $page_size = $request->size ?? 10;
    $comments = $user->comments()->paginate($page_size);
    return ['user'=>$user,'comments'=>$comments];
});

Route::get('/users/{user}/publications', function (User $user, Request $request){
    $page_size = $request->size ?? 10;
    $publications = $user->publications()->paginate($page_size);
    $user->load('publications');
    return ['user'=>$user, 'publications' =>$publications];
});

Route::get('/publications', [PublicationController::class,'index']);
Route::get('/publications/{publication}', [PublicationController::class,'show']);
Route::get('/publications/{publication}/comments', [PublicationController::class,'showComments']);


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


