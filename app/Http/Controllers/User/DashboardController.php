<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingBookings = Booking::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->with('room')
            ->latest()
            ->get();
            
        $upcomingBookings = Booking::where('user_id', auth()->id())
            ->where('status', 'approved')
            ->where('end_time', '>=', now())
            ->with('room')
            ->orderBy('start_time')
            ->get();
            
        $pastBookings = Booking::where('user_id', auth()->id())
            ->where(function($query) {
                $query->where('status', 'approved')
                      ->where('end_time', '<', now());
            })
            ->orWhere(function($query) {
                $query->where('user_id', auth()->id())
                      ->where('status', 'rejected');
            })
            ->with('room')
            ->latest()
            ->limit(5)
            ->get();

        return view('user.dashboard', compact('pendingBookings', 'upcomingBookings', 'pastBookings'));
    }
}