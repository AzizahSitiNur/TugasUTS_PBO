@extends('layouts.admin')

@section('title', 'Daftar Peminjaman')

@section('content')

<!-- Styling tambahan agar seirama -->
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

    .nav-tabs .nav-link.active {
        background-color: #ffffff;
        color: #000000;
        border-radius: 10px;
    }

    .nav-tabs .nav-link {
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

    .btn-success, .btn-danger, .btn-info {
        font-weight: bold;
        border: none;
    }

    .badge {
        font-size: 90%;
    }
</style>

<div class="card">
    <div class="card-body">
        <h1 class="mb-4">Daftar Pinjam</h1>

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link {{ $status == 'pending' ? 'active' : '' }}" href="{{ route('admin.bookings.index', ['status' => 'pending']) }}">
                    Menunggu Persetujuan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status == 'approved' ? 'active' : '' }}" href="{{ route('admin.bookings.index', ['status' => 'approved']) }}">
                    Disetujui
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status == 'rejected' ? 'active' : '' }}" href="{{ route('admin.bookings.index', ['status' => 'rejected']) }}">
                    Ditolak
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status == 'all' ? 'active' : '' }}" href="{{ route('admin.bookings.index', ['status' => 'all']) }}">
                    Semua
                </a>
            </li>
        </ul>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Peminjam</th>
                        <th>Ruangan</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Status</th>
                        <th>Dibuat Pada</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->room->name }}</td>
                            <td>{{ $booking->start_time->format('d/m/Y H:i') }}</td>
                            <td>{{ $booking->end_time->format('d/m/Y H:i') }}</td>
                            <td>
                                @if($booking->status == 'pending')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                @elseif($booking->status == 'approved')
                                    <span class="badge bg-success">Disetujui</span>
                                @else
                                    <span class="badge bg-danger">Ditolak</span>
                                @endif
                            </td>
                            <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    @if($booking->status == 'pending')
                                        <form action="{{ route('admin.bookings.approve', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-success">
                                                <i class="fas fa-check"></i> Setujui
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-times"></i> Tolak
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Detail
                                    </a>

                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data peminjaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="margin-top: 7px;">Kembali</a>
            </div>
        </div>

    </div>
</div>

@endsection
