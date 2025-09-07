<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});


Route::resource('users', UsersController::class);