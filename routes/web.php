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

Route::get('/register', function () {
    return view('register');
})->name('register');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

// Route::get('/create', function () {
//     return view('Users/create');
// })->name('create');

// ----------------------
// Authentication Routes
// ----------------------
Route::post('/users', [UsersController::class, 'store'])->name('users.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ----------------------
// Admin Routes
// ----------------------
Route::middleware('role:admin')->group(function () {
    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
    Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
});


Route::prefix('admin')
    ->name('admin.')
    ->middleware('role:admin')
    ->group(function () {

        // Jaga2
        Route::resource('students', StudentsController::class);
        Route::resource('payments', PaymentController::class);
        Route::resource('spp', SppController::class);

        Route::get('students', [AdminController::class, 'studentIndex'])->name('students.index');
        Route::get('students/create', [AdminController::class, 'studentCreate'])->name('students.create');
        Route::get('students/{id}/edit', [AdminController::class, 'studentEdit'])->name('students.edit');

        Route::get('spp', [AdminController::class, 'sppIndex'])->name('spp.index');
        Route::get('spp/create', [AdminController::class, 'sppCreate'])->name('spp.create');
        Route::get('spp/{id}/edit', [AdminController::class, 'sppEdit'])->name('spp.edit');

        Route::get('payments', [AdminController::class, 'paymentIndex'])->name('payments.index');
        Route::get('payments/create', [AdminController::class, 'paymentCreate'])->name('payments.create');
        Route::get('payments/{id}/edit', [AdminController::class, 'paymentEdit'])->name('payments.edit');

        Route::get('classes', [AdminController::class, 'classIndex'])->name('classes.index');
    });

// ----------------------
// Student Routes
// ----------------------
Route::middleware('role:student')->group(function () {
    Route::resource('students', StudentsController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('spp', SppController::class);
});