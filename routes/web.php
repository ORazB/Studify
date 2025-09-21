<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SppController;

// ----------------------
// Public Routes
// ----------------------
Route::get('/', function () {
    return view('register');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

// ----------------------
// Authentication Routes
// ----------------------
Route::post('/users', [UsersController::class, 'store'])->name('users.store');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// ----------------------
// Admin Routes (Users CRUD) - names unchanged
// ----------------------
Route::middleware('role:admin')->group(function () {
    Route::get('users', [UsersController::class, 'index'])->name('users.index');
    Route::get('users/create', [UsersController::class, 'create'])->name('users.create');
    Route::get('users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
});

// ----------------------
// Admin Display Routes (GET pages only)
// ----------------------
Route::prefix('admin')->name('admin.')->middleware('role:admin')->group(function () {
    // Students Display
    Route::get('students', [AdminController::class, 'studentIndex'])->name('students.index');
    Route::get('students/create', [AdminController::class, 'studentCreate'])->name('students.create');
    Route::get('students/{id}/edit', [AdminController::class, 'studentEdit'])->name('students.edit');

    // SPP Display
    Route::get('spp', [AdminController::class, 'sppIndex'])->name('spp.index');
    Route::get('spp/create', [AdminController::class, 'sppCreate'])->name('spp.create');
    Route::get('spp/{id}/edit', [AdminController::class, 'sppEdit'])->name('spp.edit');

    // Payments Display
    Route::get('payments', [AdminController::class, 'paymentIndex'])->name('payments.index');
    Route::get('payments/create', [AdminController::class, 'paymentCreate'])->name('payments.create');
    Route::get('payments/{id}/edit', [AdminController::class, 'paymentEdit'])->name('payments.edit');

    // Classes
    Route::get('classes', [AdminController::class, 'classIndex'])->name('classes.index');
});

// ----------------------
// CRUD Resource Routes
// ----------------------
Route::resource('students', StudentsController::class);
Route::resource('payments', PaymentController::class);
Route::resource('spp', SppController::class);

// ----------------------
// Student Role Routes
// ----------------------
Route::middleware('role:student')->group(function () {
    Route::get('students', [StudentsController::class, 'index'])->name('students.index');
});