<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\GeneratePdfLaporan;
use Carbon\Carbon;
use App\Models\Booking;
use PDF;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Membuat query untuk mendapatkan data peminjaman
        $query = Booking::with(['user', 'room'])->orderBy('start_time', 'desc');

        // Mengecek apakah ada filter tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = $request->start_date . ' 00:00:00';
            $end = $request->end_date . ' 23:59:59';
            $query->whereBetween('start_time', [$start, $end]);
        }

        // Mengambil data peminjaman
        $bookings = $query->get();

        // Memformat waktu start_time dan end_time
        foreach ($bookings as $booking) {
            $booking->start_time = Carbon::parse($booking->start_time)->format('d-m-Y H:i:s');
            $booking->end_time = Carbon::parse($booking->end_time)->format('d-m-Y H:i:s');
        }

        // Mengecek apakah ada permintaan untuk mengunduh PDF
        if ($request->has('download_pdf') && $request->download_pdf == 'true') {
            // Dispatch job untuk membuat PDF secara asinkron
            GeneratePdfLaporan::dispatch($request->start_date, $request->end_date);

            // Memberi feedback ke user bahwa PDF sedang diproses
            return redirect()->back()->with('message', 'Laporan PDF sedang diproses, coba lagi nanti.');
        }

        // Menampilkan data di view jika tidak ada permintaan untuk download PDF
        return view('laporan.index', compact('bookings'));
    }

    public function exportPdf(Request $request)
    {
        // Membuat query untuk mendapatkan data peminjaman
        $query = Booking::with(['user', 'room'])->orderBy('start_time', 'desc');

        // Mengecek apakah ada filter tanggal
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = $request->start_date . ' 00:00:00';
            $end = $request->end_date . ' 23:59:59';
            $query->whereBetween('start_time', [$start, $end]);
        }

        // Mengambil data peminjaman
        $bookings = $query->get();

        // Memformat waktu start_time dan end_time
        foreach ($bookings as $booking) {
            $booking->start_time = Carbon::parse($booking->start_time)->format('d-m-Y H:i:s');
            $booking->end_time = Carbon::parse($booking->end_time)->format('d-m-Y H:i:s');
        }

        // Generate PDF
        $pdf = PDF::loadView('laporan.pdf', compact('bookings'));

        // Mendownload PDF
        return $pdf->download('laporan_peminjaman.pdf');
    }
}
