<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;

// ---------------------------
// Authentication
// ---------------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ---------------------------
// Authenticated routes
// ---------------------------
        Route::middleware('auth')->group(function () {
            Route::get('/', function () {
            return redirect()->route('login');
        });

    // Redirect based on role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'admin') return redirect()->route('admin.dashboard');
        if ($user->role === 'it') return redirect()->route('it.dashboard');
        return redirect()->route('ticket.create');
    })->name('dashboard');

    // Admin dashboard
    Route::get('/admin/dashboard', [TicketController::class, 'allTickets'])
        ->name('admin.dashboard');

    // ⭐ UPDATED IT DASHBOARD (this line replaces the old one)
    Route::get('/it/dashboard', [TicketController::class, 'itTickets'])
        ->name('it.dashboard');

    // General user ticket pages
    Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket/store', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/ticket/list', [TicketController::class, 'index'])->name('ticket.list');

});
