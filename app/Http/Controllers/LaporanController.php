<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Models\Booking;
use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'room'])->orderBy('start_time', 'desc');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('start_time', [$request->start_date, $request->end_date]);
        }

        $bookings = $query->get();

        return view('laporan.index', compact('bookings'));
    }

    public function exportPdf(Request $request)
    {
        $query = Booking::with(['user', 'room'])->orderBy('start_time', 'desc');

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('start_time', [$request->start_date, $request->end_date]);
        }

        $bookings = $query->get();
        $pdf = PDF::loadView('laporan.pdf', compact('bookings'));

        return $pdf->download('laporan_peminjaman.pdf');
    }
}
