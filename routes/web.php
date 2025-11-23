<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;

// ===========================
// AUTH ROUTES (NO LOGIN NEEDED)
// ===========================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ===========================
// AUTHENTICATED ROUTES
// ===========================
Route::middleware('auth')->group(function () {

    // Home redirects to dashboard
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    // Redirect based on user role
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'admin') return redirect()->route('admin.dashboard');
        if ($user->role === 'it') return redirect()->route('it.dashboard');
        return redirect()->route('user.dashboard'); // default user
    })->name('dashboard');

    // Normal User Dashboard
    Route::get('/user/dashboard', [TicketController::class, 'userDashboard'])
        ->name('user.dashboard');

    // Admin Dashboard (sees all tickets)
    Route::get('/admin/dashboard', [TicketController::class, 'allTickets'])
        ->name('admin.dashboard');

    // IT Dashboard (IT tickets only)
    Route::get('/it/dashboard', [TicketController::class, 'itTickets'])
        ->name('it.dashboard');

    // Ticket Routes
    Route::get('/ticket/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('/ticket/store', [TicketController::class, 'store'])->name('ticket.store');
    Route::get('/ticket/list', [TicketController::class, 'index'])->name('ticket.list');

    Route::get('/ticket/takeover/{id}', [TicketController::class, 'takeover'])->name('ticket.takeover');


    Route::get('/ticket/takeover/{id}', [TicketController::class, 'takeover'])->name('ticket.takeover');
    Route::get('/ticket/close/{id}', [TicketController::class, 'closeTicket'])->name('ticket.close');

    //----------------------------
    // Admin Routes
    Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Reports
    Route::get('/reports', [\App\Http\Controllers\ReportController::class, 'index'])->name('admin.reports');
    Route::post('/reports/search', [\App\Http\Controllers\ReportController::class, 'search'])->name('admin.reports.search');

    // Tickets
    Route::get('/tickets', [\App\Http\Controllers\AdminTicketController::class, 'index'])->name('admin.tickets');
    Route::post('/tickets/assign', [\App\Http\Controllers\AdminTicketController::class, 'assign'])->name('admin.tickets.assign');

});



});
