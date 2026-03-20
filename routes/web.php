<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboard;

// ── Home ──────────────────────────────────────────────────────
Route::get('/', function () {
    if (auth()->check()) {
        if (auth()->user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/teacher/dashboard');
    }
    return redirect()->route('login');
});

// ── Admin routes ──────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
});

// ── Teacher routes ────────────────────────────────────────────
Route::middleware(['auth', 'teacher'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/dashboard', [TeacherDashboard::class, 'index'])->name('dashboard');
});

// ── Breeze auth routes ────────────────────────────────────────
require __DIR__.'/auth.php';