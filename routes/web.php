<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\TaxController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes (login, registration, logout)
Auth::routes();

// Route for home/dashboard (after login)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Protected routes that require authentication
Route::middleware(['auth'])->group(function () {

    // Shared dashboard route (decides based on user role)
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    // Client-specific routes (middleware ensures only clients can access)
    Route::middleware('role:client')->group(function () {
        Route::get('/tax/form', [TaxController::class, 'create'])->name('tax.form');
        Route::post('/tax/submit', [TaxController::class, 'submit'])->name('tax.submit');
        Route::get('/tax/status', [ClientController::class, 'status'])->name('tax.status');
    });

    // Admin-specific routes (middleware ensures only admins can access)
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/admin/tax/{id}', [AdminController::class, 'show'])->name('admin.tax.show');
        Route::post('/admin/tax/complete/{id}', [AdminController::class, 'complete'])->name('admin.tax.complete');
        Route::get('/admin/tax/print/{id}', [AdminController::class, 'print'])->name('admin.tax.print');
    });

    // Route to list all clients (common for both admin and client)
    Route::get('/clients', [ClientController::class, 'index'])->name('client.index');
    Route::get('/tax/download_pdf', [TaxController::class, 'downloadPdf'])->name('tax.download_pdf');

    // Route to show specific client details (accessible for both roles)
    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('client.show');
});
