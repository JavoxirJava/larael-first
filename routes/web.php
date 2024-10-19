<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('users.login');
});

Route::get('/signup', function () {
    return view('users.signUp');
});

Route::get('/test', function () {
    return view('test');
});

// ? -> bu belgi ixtiyoriy degani! null esa default value
Route::get('/user/{id?}', function ($id = null) {
    return "user Id $id";
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::get('users/{user}', [UserController::class, 'show']);
Route::post('/user-create', [UserController::class, 'store']);
Route::post('/users/signup', [UserController::class, 'create']);
Route::post('/users/login', [UserController::class, 'login']);
Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts/create', [PostController::class, 'create']);
Route::post('/posts/update/{id}', [PostController::class, 'update']);
Route::get('/posts/delete/{id}', [PostController::class, 'delete']);
