<!-- resources/views/admin/rooms/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Ruangan')

@section('content')

<!-- Styling khusus (Tetap jaga nuansa Untirta style) -->
<style>
    body {
        background: linear-gradient(135deg, #2c3e50, #34495e) !important;
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(8px);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
    }

    label {
        color: white;
    }

    .form-control, .form-check-input, textarea {
        background-color: rgba(255, 255, 255, 0.8);
        color: black;
        border: 1px solid #ccc;
    }

    .form-check-label {
        color: white;
    }

    .btn-primary {
        background-color: #3490dc;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
    }

</style>

<div class="d-flex justify-content-between align-items-center mb-4 text-white">
    <h1>Edit Ruangan</h1>
    <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.rooms.update', $room->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama Ruangan <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name" value="{{ old('name', $room->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Lokasi</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror"
                    id="location" name="location" value="{{ old('location', $room->location) }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="capacity" class="form-label">Kapasitas <span class="text-danger">*</span></label>
                <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                    id="capacity" name="capacity" value="{{ old('capacity', $room->capacity) }}" min="1" required>
                @error('capacity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="facilities" class="form-label">Fasilitas</label>
                <textarea class="form-control @error('facilities') is-invalid @enderror"
                    id="facilities" name="facilities" rows="3">{{ old('facilities', $room->facilities) }}</textarea>
                <small class="form-text text-muted">Pisahkan dengan koma untuk setiap fasilitas</small>
                @error('facilities')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Checkbox Aktif/Tidak Aktif -->
            <div class="mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1"
                        {{ old('is_active', $room->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Perbarui</button>
        </form>
    </div>
</div>

@endsection
