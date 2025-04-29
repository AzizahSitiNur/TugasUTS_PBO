@extends('layouts.admin')

@section('title', 'Tambah Ruangan Baru')

@section('content')

<!-- Styling -->
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

    label {
        font-weight: 600;
        color: white;
    }

    input.form-control, select.form-control, textarea.form-control {
        background-color: white;
        color: black;
        border-radius: 10px;
    }

    .btn-primary {
        background-color: #3490dc;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

    .form-check-input {
        width: 20px;
        height: 20px;
    }
</style>

<!-- Form -->
<div class="card">
    <div class="card-body">
        <h1 class="mb-4">Tambah Ruang Baru</h1>

        <form action="{{ route('admin.rooms.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name">Nama Ruang <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="location">Lokasi</label>
                <input type="text" name="location" class="form-control" value="{{ old('location') }}">
            </div>

            <div class="mb-3">
                <label for="capacity">Kapasitas (jumlah orang) <span class="text-danger">*</span></label>
                <input type="number" name="capacity" class="form-control" required value="{{ old('capacity') }}">
            </div>

            <div class="mb-3">
                <label for="facilities">Fasilitas</label>
                <textarea name="facilities" class="form-control" rows="3" placeholder="Pisahkan dengan koma">{{ old('facilities') }}</textarea>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" name="is_active" class="form-check-input" id="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">Aktif</label>
            </div>

            <div class="mt-4 d-flex justify-content-between">
                <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
