<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PoemController;
use Illuminate\Support\Facades\Route;

//  Public Routes

// Home / Welcome Pages
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return redirect()->route('poems.index');
})->name('home');

// Authentication Routes (Guest Only)
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

//  Authenticated Routes (MUST be before public poem routes for correct route matching)

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Poem Management Routes (specific routes first)
    Route::get('/poems/create', [PoemController::class, 'create'])->name('poems.create');
    Route::post('/poems', [PoemController::class, 'store'])->name('poems.store');

    Route::get('/poems/{poem:slug}/edit', [PoemController::class, 'edit'])->name('poems.edit');
    Route::put('/poems/{poem:slug}', [PoemController::class, 'update'])->name('poems.update');
    Route::delete('/poems/{poem:slug}', [PoemController::class, 'destroy'])->name('poems.destroy');

    // User Dashboard
    Route::get('/my-poems', [PoemController::class, 'myPoems'])->name('poems.my');
});

// Public Poem Routes (accessible to all - generic routes last)
Route::get('/poems', [PoemController::class, 'index'])->name('poems.index');
Route::get('/poems/{poem:slug}', [PoemController::class, 'show'])->name('poems.show');