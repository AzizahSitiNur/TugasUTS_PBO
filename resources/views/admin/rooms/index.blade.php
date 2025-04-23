<!-- resources/views/admin/rooms/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Manajemen Ruangan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Daftar Ruangan</h1>
        <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Ruangan Baru
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nama Ruangan</th>
                            <th>Lokasi</th>
                            <th>Kapasitas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                            <tr>
                                <td>{{ $room->id }}</td>
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

            <div class="mt-4">
                {{ $rooms->links() }}
            </div>
        </div>
    </div>
@endsection