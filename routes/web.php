<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SppController;

Route::get('/', function () {
    return view('register');
});

Route::get('/test', function () {
    return view('test');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/create', function () {
    return view('Users/create');
})->name('create');

// Users Routes
Route::resource('users', UsersController::class);
Route::resource('students', StudentsController::class);
Route::resource('payments', PaymentController::class);
Route::resource('spp', SppController::class);

Route::prefix('admin')->name('admin.')->group(function () {
    // Students
    Route::get('students', [AdminController::class, 'studentIndex'])->name('students.index');
    Route::get('students/create', [AdminController::class, 'studentCreate'])->name('students.create');
    Route::get('students/{id}/edit', [AdminController::class, 'studentEdit'])->name('students.edit');

    // SPP
    Route::get('spp', [AdminController::class, 'sppIndex'])->name('spp.index');
    Route::get('spp/create', [AdminController::class, 'sppCreate'])->name('spp.create');
    Route::get('spp/{id}/edit', [AdminController::class, 'sppEdit'])->name('spp.edit');

    // Payments
    Route::get('payments', [AdminController::class, 'paymentIndex'])->name('payments.index');
    Route::get('payments/create', [AdminController::class, 'paymentCreate'])->name('payments.create');
    Route::get('payments/{id}/edit', [AdminController::class, 'paymentEdit'])->name('payments.edit');

    // Classes
    Route::get('classes', [AdminController::class, 'classIndex'])->name('classes.index');
});

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', action: [LoginController::class, 'login']);