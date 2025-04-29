@extends('layouts.admin')

@section('title', 'Detail Peminjaman')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #2c3e50, #34495e) !important;
        min-height: 100vh;
        background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px);
        background-size: 20px 20px;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(8px);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .table th, .table td {
        background-color: rgba(255, 255, 255, 0.08) !important;
        color: white;
    }

    .card-header {
        border-radius: 15px 15px 0 0;
        font-weight: bold;
    }

    .btn {
        font-weight: bold;
        border: none;
    }

    .bg-light {
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: white;
    }

    .alert {
        border-radius: 10px;
    }

    .alert-warning {
        background-color: #f1c40f;
        color: black;
    }

    .alert-success {
        background-color: #27ae60;
        color: white;
    }

    .alert-danger {
        background-color: #e74c3c;
        color: white;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-white">Detail Peminjaman</h1>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-header 
        @if($booking->status == 'pending')
            bg-warning text-dark
        @elseif($booking->status == 'approved')
            bg-success text-white
        @else
            bg-danger text-white
        @endif">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                Status:
                @if($booking->status == 'pending')
                    Menunggu Persetujuan
                @elseif($booking->status == 'approved')
                    Disetujui
                @else
                    Ditolak
                @endif
            </h5>
            <span>ID: #{{ $booking->id }}</span>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <h5 class="text-white">Informasi Ruangan</h5>
                <table class="table">
                    <tr>
                        <th style="width: 30%">Nama Ruangan</th>
                        <td>{{ $booking->room->name }}</td>
                    </tr>
                    <tr>
                        <th>Lokasi</th>
                        <td>{{ $booking->room->location ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kapasitas</th>
                        <td>{{ $booking->room->capacity }} orang</td>
                    </tr>
                    <tr>
                        <th>Fasilitas</th>
                        <td>{{ $booking->room->facilities ?? '-' }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h5 class="text-white">Informasi Peminjaman</h5>
                <table class="table">
                    <tr>
                        <th style="width: 30%">Waktu Mulai</th>
                        <td>{{ $booking->start_time->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Waktu Selesai</th>
                        <td>{{ $booking->end_time->format('d/m/Y H:i') }}</td>
                    </tr>
                    <tr>
                        <th>Durasi</th>
                        <td>{{ $booking->start_time->diffInHours($booking->end_time) }} jam</td>
                    </tr>
                    <tr>
                        <th>Tanggal Permintaan</th>
                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <h5 class="text-white">Tujuan Peminjaman</h5>
            <div class="card">
                <div class="card-body bg-light">
                    {{ $booking->purpose }}
                </div>
            </div>
        </div>

        @if($booking->admin_notes)
            <div class="mt-4">
                <h5 class="text-white">Catatan Admin</h5>
                <div class="card">
                    <div class="card-body bg-light">
                        {{ $booking->admin_notes }}
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-4">
            @if($booking->status == 'pending')
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle"></i> Permintaan peminjaman sedang menunggu persetujuan admin.
                </div>
            @elseif($booking->status == 'approved')
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> Permintaan peminjaman telah disetujui.
                </div>
            @else
                <div class="alert alert-danger">
                    <i class="bi bi-x-circle"></i> Permintaan peminjaman ditolak.
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
