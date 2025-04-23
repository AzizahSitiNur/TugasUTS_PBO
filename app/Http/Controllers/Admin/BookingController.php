<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status ?? 'pending';
        
        $bookings = Booking::with(['user', 'room'])
            ->when($status !== 'all', function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        return view('admin.bookings.index', compact('bookings', 'status'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'room']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Booking $booking)
    {
        // Cek ketersediaan ruangan terlebih dahulu
        if (!$booking->room->isAvailable($booking->start_time, $booking->end_time, $booking->id)) {
            return back()->with('error', 'Ruangan sudah diboking untuk waktu yang sama.');
        }

        $booking->update([
            'status' => 'approved',
            'admin_notes' => request('admin_notes'),
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Peminjaman ruangan berhasil disetujui.');
    }

    public function reject(Booking $booking)
    {
        $booking->update([
            'status' => 'rejected',
            'admin_notes' => request('admin_notes'),
        ]);

        return redirect()->route('admin.bookings.index')->with('success', 'Peminjaman ruangan ditolak.');
    }
}