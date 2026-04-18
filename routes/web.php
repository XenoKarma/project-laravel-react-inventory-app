<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController; // <-- TAMBAHKAN INI
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

Route::middleware('auth')->group(function () {
    // read only 4 role
    Route::middleware('role:admin,warehouse,cashier,owner')->group(function () {
        Route::apiResource('products', ProductController::class)->only(['index', 'show']);
    });
    // manage admin and warehouse(create,update,delete)
    Route::middleware('role:admin,warehouse')->group(function () {
        Route::apiResource('products', ProductController::class)->except(['index', 'show']);
    });
});

require __DIR__ . '/auth.php';
