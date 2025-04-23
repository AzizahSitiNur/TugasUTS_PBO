<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BookingController as UserBookingController;

// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute untuk admin
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Manajemen Ruangan
    Route::resource('rooms', AdminRoomController::class);

    // Manajemen Peminjaman - Perbaikan disini
    Route::prefix('bookings')->name('bookings.')->group(function () {
        Route::get('/', [AdminBookingController::class, 'index'])->name('index');
        Route::get('/{booking}', [AdminBookingController::class, 'show'])->name('show');
        Route::patch('/{booking}', [AdminBookingController::class, 'update'])->name('update');
        Route::delete('/{booking}', [AdminBookingController::class, 'destroy'])->name('destroy');
        Route::patch('/{booking}/approve', [AdminBookingController::class, 'approve'])->name('approve');
        Route::patch('/{booking}/reject', [AdminBookingController::class, 'reject'])->name('reject');
    });
});

// Rute untuk user
Route::prefix('user')->middleware(['auth', 'user'])->name('user.')->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // Peminjaman
    Route::resource('bookings', UserBookingController::class)->except(['edit', 'update']);
    Route::patch('bookings/{booking}/cancel', [UserBookingController::class, 'cancel'])->name('bookings.cancel');
});

require __DIR__.'/auth.php';