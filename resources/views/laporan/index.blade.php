@extends('layouts.admin')

@section('title', 'Laporan Peminjaman Ruangan')

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

    table {
        background-color: rgba(255, 255, 255, 0.05);
    }

    th {
        background-color: #2c3e50;
        color: white;
    }

    td {
        background-color: rgba(255, 255, 255, 0.1);
        color: white;
    }

    .btn {
        font-weight: bold;
        border: none;
    }

    label, input, button, a {
        color: white;
    }

    .form-inline input, .form-inline button {
        margin-right: 10px;
    }

    .form-inline a {
        text-decoration: none;
    }
</style>

<div class="card">
    <div class="card-body">
        <h1 class="mb-4">Laporan Peminjaman Ruangan</h1>

        <form method="GET" action="{{ route('admin.laporan.index') }}" class="form-inline mb-4 d-flex align-items-end gap-2 flex-wrap">
            <div>
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" name="start_date" id="start_date" value="{{ request('start_date') }}">
            </div>
            <div>
                <label for="end_date">End Date:</label>
                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ request('end_date') }}">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.laporan.export', request()->only(['start_date', 'end_date'])) }}" class="btn btn-danger">Export PDF</a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                   
                        <th>Ruangan</th>
                        <th>Peminjam</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Selesai</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                       
                            <td>{{ $booking->room->name }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->start_time)->format('d/m/Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->end_time)->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($booking->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-2">Kembali</a>
        </div>
    </div>
</div>

@endsection
