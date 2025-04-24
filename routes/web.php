<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\RoomController as AdminRoomController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BookingController as UserBookingController;
use App\Http\Controllers\LaporanController as LaporanController;



// Halaman utama
Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');

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
    // Manajemen User
    Route::resource('users', AdminUserController::class)->except(['show']);
    Route::get('users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::delete('users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    
    // laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/export', [LaporanController::class, 'exportPdf'])->name('export');
    });
    
});

// Rute untuk user
Route::prefix('user')->middleware(['auth', 'user'])->name('user.')->group(function () {
    Route::get('dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/user/calendar/events', [UserBookingController::class, 'calendarEvents'])->name('calendar.events');

    // Peminjaman
    Route::resource('bookings', UserBookingController::class)->except(['edit', 'update']);
    Route::patch('bookings/{booking}/cancel', [UserBookingController::class, 'cancel'])->name('bookings.cancel');
});
Route::get('/profile/edit', function () {
    return 'Edit Profile Page'; // atau bisa arahkan ke view tertentu
})->middleware('auth')->name('profile.edit');


require __DIR__.'/auth.php';