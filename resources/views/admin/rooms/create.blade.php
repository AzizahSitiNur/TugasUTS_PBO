<!-- resources/views/admin/rooms/create.blade.php -->
@extends('layouts.admin')

@section('title', 'Tambah Ruangan')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Tambah Ruangan Baru</h1>
        <a href="{{ route('admin.rooms.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.rooms.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Ruangan <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="location" class="form-label">Lokasi</label>
                    <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}">
                    @error('location')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="capacity" class="form-label">Kapasitas <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('capacity') is-invalid @enderror" id="capacity" name="capacity" value="{{ old('capacity') }}" min="1" required>
                    @error('capacity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="facilities" class="form-label">Fasilitas</label>
                    <textarea class="form-control @error('facilities') is-invalid @enderror" id="facilities" name="facilities" rows="3">{{ old('facilities') }}</textarea>
                    <small class="form-text text-muted">Pisahkan dengan koma untuk setiap fasilitas</small>
                    @error('facilities')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Aktif</label>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection