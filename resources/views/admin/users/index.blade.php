@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #2c3e50, #34495e) !important;
        background-image: radial-gradient(rgba(255, 255, 255, 0.07) 1px, transparent 1px);
        background-size: 20px 20px;
        font-family: 'Poppins', sans-serif;
        min-height: 100vh;
    }

    .card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(8px);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .btn-primary {
        background-color: #3490dc;
        border: none;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-warning {
        border-radius: 8px;
        font-weight: 500;
    }

    .btn-danger {
        border-radius: 8px;
        font-weight: 500;
    }

    .table {
        color: white;
    }

    .table th,
    .table td {
        vertical-align: middle;
    }

    .table thead {
        background-color: rgba(0, 0, 0, 0.6);
    }

    .badge {
        padding: 0.5em 0.75em;
        font-size: 0.9em;
        border-radius: 8px;
    }

</style>

<div class="d-flex justify-content-between align-items-center mb-4 text-white">
    <h1>Daftar User</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah User Baru
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                @if($user->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
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
                            <td colspan="6" class="text-center text-light">Tidak ada data user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</div>

<div class="d-flex justify-content-between align-items-center mt-4">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

@endsection
