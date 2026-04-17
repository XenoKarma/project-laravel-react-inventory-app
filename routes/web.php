<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Hanya admin yang bisa akses ini
Route::middleware(['auth', 'role:admin'])->group(function () {

});

// hanya cashier yang bisa akses
Route::middleware(['auth', 'role:cashier'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return "kamu login sebagai role : " . $user->role;
    });
});

// hanya warehouse yang bisa akses
Route::middleware(['auth', 'role:warehouse'])->group(function () {

});

// hanya owner yang bisa akses


require __DIR__ . '/auth.php';
