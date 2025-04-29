@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #2c3e50, #34495e) !important;
        background-image: radial-gradient(rgba(255, 255, 255, 0.06) 1px, transparent 1px);
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

    label, .form-check-label {
        color: white;
    }

    .form-control, .form-select, .form-check-input {
        background-color: rgba(255, 255, 255, 0.8);
        color: black;
        border: 1px solid #ccc;
        border-radius: 8px;
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
</style>

<div class="d-flex justify-content-between align-items-center mb-4 text-white">
    <h1>Tambah User Baru</h1>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                    {{ old('is_active') ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

@endsection
