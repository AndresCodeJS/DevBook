<?php

use App\Http\Controllers\ComentarioController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/* Route::get('/', function () {
    return view('home');
}); */

//Pagina Principal

Route::get('/', HomeController::class)->name('home');

//Followers Routes

//Follow
Route::post('/{user:username}/follow', [FollowerController::class,'store'])->name('users.follow');
//Unfollow
Route::delete('/{user:username}/unfollow', [FollowerController::class,'destroy'])->name('users.unfollow');

//Perfil Route
Route::get('/editar-perfil', [PerfilController::class,'index'])->name('perfil.index');
Route::post('/editar-perfil', [PerfilController::class,'store'])->name('perfil.store');

Route::get('/register', [RegisterController::class,'index'])->name("register");
Route::post('/register', [RegisterController::class,'store'])->name("register");

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store'])->name('login');

Route::post('/logout', [LogoutController::class,'store'])->name('logout');

Route::post('/imagen', [ImagenController::class,'store'])->name('imagen.store');

Route::get('/{user:username}/posts/{post}', [PostController::class,'show'])->name('posts.show');
Route::get('/posts/create', [PostController::class,'create'])->name('posts.create');
Route::post('/posts/store', [PostController::class,'store'])->name('posts.store');
Route::get('/{user:username}', [PostController::class,'index'])->name('posts.index');
//Borrar Post
Route::delete('/posts/{post}}', [PostController::class,'destroy'])->name('posts.destroy');

//COmentarios Route
Route::post('/{user:username}/posts/{post}', [ComentarioController::class,'store'])->name('comentarios.store');

//Likes Route
Route::post('/posts/{post}/likes', [LikeController::class,'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class,'destroy'])->name('posts.likes.destroy');







