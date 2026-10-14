<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InventoryTransactionController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});

// Authenticated & Protected Routes
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products Resource Routes
    Route::resource('products', ProductController::class);

    // Transactions Resource Routes
    Route::resource('transactions', InventoryTransactionController::class);

    // Reports Route (Dito naka-fix ang [reports.index] error)
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';