<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AdminTicketController;
use App\Http\Controllers\ReportController;

// ===========================
// AUTH ROUTES (NO LOGIN REQUIRED)
// ===========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ===========================
// AUTHENTICATED ROUTES
// ===========================
Route::middleware('auth')->group(function () {

    // Root redirect
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    // Main dashboard deciding by role
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->role === 'admin') return redirect()->route('admin.tickets');
        if ($user->role === 'it') return redirect()->route('it.dashboard');

        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // ==============================
    // NORMAL USER ROUTES
    // ==============================
    Route::get('/user/dashboard', [TicketController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket/store', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/ticket/list', [TicketController::class, 'index'])->name('ticket.list');
    Route::get('/ticket/takeover/{id}', [TicketController::class, 'takeover'])->name('ticket.takeover');
    Route::get('/ticket/close/{id}', [TicketController::class, 'closeTicket'])->name('ticket.close');

    // ==============================
    // IT USER ROUTES
    // ==============================
    Route::get('/it/dashboard', [TicketController::class, 'itTickets'])->name('it.dashboard');

    // ==============================
    // ADMIN ROUTES
    // ==============================
    Route::prefix('admin')->group(function () {

        // Redirect any dashboard call to tickets
        Route::get('/dashboard', function () {
            return redirect()->route('admin.tickets');
        })->name('admin.dashboard');

        // Admin Tickets
        Route::get('/tickets', [AdminTicketController::class, 'index'])->name('admin.tickets');
        Route::post('/tickets/assign', [AdminTicketController::class, 'assign'])->name('admin.tickets.assign');

        // Admin Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports');
        Route::post('/reports/search', [ReportController::class, 'search'])->name('admin.reports.search');
    });
});
