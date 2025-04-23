<?php

namespace App\Jobs;

use App\Models\Booking;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GeneratePdfReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $startDate;
    protected $endDate;

    /**
     * Create a new job instance.
     *
     * @param  string  $startDate
     * @param  string  $endDate
     * @return void
     */
    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Ambil data yang diperlukan untuk laporan
        $bookings = Booking::whereBetween('start_time', [$this->startDate, $this->endDate])->get();

        // Set opsi untuk Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        // Buat HTML untuk PDF
        $html = view('reports.pdf', compact('bookings'))->render(); // pastikan membuat view 'reports.pdf'

        // Load HTML ke dalam Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas
        $dompdf->setPaper('A4', 'landscape');

        // Render PDF (menunggu proses selesai)
        $dompdf->render();

        // Output PDF ke file atau simpan di disk
        $output = $dompdf->output();
        file_put_contents(public_path('reports/laporan_' . now()->timestamp . '.pdf'), $output);
    }
}
