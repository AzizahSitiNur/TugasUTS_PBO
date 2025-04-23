<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with('room')
            ->latest()
            ->paginate(10);
            
        return view('user.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::where('is_active', true)->get();
        return view('user.bookings.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_time' => 'required|date|after:now',
            'end_time' => 'required|date|after:start_time',
            'purpose' => 'required|string|max:1000',
        ]);

        $room = Room::findOrFail($request->room_id);
        
        // Cek ketersediaan ruangan
        if (!$room->isAvailable($request->start_time, $request->end_time)) {
            return back()->withInput()->with('error', 'Ruangan sudah diboking untuk waktu yang sama.');
        }

        Booking::create([
            'user_id' => auth()->id(),
            'room_id' => $request->room_id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        return redirect()->route('user.bookings.index')->with('success', 'Permintaan peminjaman ruangan berhasil dikirim dan menunggu persetujuan admin.');
    }

    public function show(Booking $booking)
    {
        // Pastikan user hanya dapat melihat booking miliknya sendiri
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        return view('user.bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        // Pastikan user hanya dapat membatalkan booking miliknya sendiri
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke data ini.');
        }

        // Hanya booking dengan status pending yang dapat dibatalkan
        if (!$booking->isPending()) {
            return back()->with('error', 'Hanya peminjaman dengan status pending yang dapat dibatalkan.');
        }

        $booking->delete();
        return redirect()->route('user.bookings.index')->with('success', 'Permintaan peminjaman ruangan berhasil dibatalkan.');
    }
}