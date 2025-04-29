<!-- resources/views/admin/rooms/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Manajemen Ruangan')

@section('content')

<!-- Tambahan Styling untuk Background -->
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
    }

    .table thead th {
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        text-align: center;
    }

    .table tbody td {
        background-color: white; /* <-- BARU supaya isi putih */
        color: black; /* <-- teks jadi hitam */
        vertical-align: middle;
        text-align: center;
    }

    .btn-primary {
        background-color: #3490dc;
        border: none;
    }

    .btn-warning {
        background-color: #facc15;
        border: none;
    }

    .btn-danger {
        background-color: #ef4444;
        border: none;
    }

    .badge.bg-success {
        background-color: #22c55e !important;
    }

    .badge.bg-danger {
        background-color: #ef4444 !important;
    }
</style>

<!-- Konten -->
<div class="d-flex justify-content-between align-items-center mb-4 text-white">
    <h1>Daftar Ruang</h1>
    <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Ruang Baru
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        
                        <th>Nama Ruang</th>
                        <th>Lokasi</th>
                        <th>Kapasitas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rooms as $room)
                        <tr>
                         
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->location ?? '-' }}</td>
                            <td>{{ $room->capacity }} orang</td>
                            <td>
                                @if($room->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.rooms.edit', $room->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data ruangan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary" style="margin-top: 7px;">Kembali</a>
        </div>
    </div>
</div>

@endsection
