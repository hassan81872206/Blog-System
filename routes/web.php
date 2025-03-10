<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name("about");

// Routes for guest
Route::middleware(['guest'])->group(function () {
    Route::get("/login" , [AuthController::class , "loginPage"])->name("login");
    Route::post("/login" , [AuthController::class , "login"])->name("login");
    Route::get('/register' , [AuthController::class , 'registerPage'])->name('register');
    Route::post('/register' , [AuthController::class , 'register'])->name('register');
});

// Routes for auth
Route::middleware(['auth'])->group(function(){
    Route::get('/logout' , [AuthController::class , 'logout'])->name("logout");
    Route::resource("posts" , PostController::class);
    Route::get('/', [MainController::class , "home"]);
    Route::resource("/comments" , CommentController::class) ;
    Route::post('/comments/{post}/{user}' , [CommentController::class , 'save']);
    Route::post('/comments/{post}/{user}/{comment}' , [CommentController::class , 'save1']);
    Route::post('/like/{post}/{user}' , [LikeController::class , 'like']);
    Route::get("/other/{user}" , [PostController::class ,"other"])->name("other");
});