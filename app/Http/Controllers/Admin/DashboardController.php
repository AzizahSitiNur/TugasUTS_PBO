<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRooms = Room::count();
        $totalUsers = User::where('role', 'user')->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $approvedBookings = Booking::where('status', 'approved')->count();

        $totalPeminjaman = Booking::where('status', 'approved')->whereYear('created_at', now()->year)->count();
        $targetPeminjaman = Booking::whereYear('created_at', now()->year)->count();
        $progress = $targetPeminjaman > 0 ? min(($totalPeminjaman / $targetPeminjaman) * 100, 100) : 0;

        return view('admin.dashboard', compact('totalRooms', 'totalUsers', 'pendingBookings', 'approvedBookings', 'totalPeminjaman', 'targetPeminjaman', 'progress'));
    }
}
