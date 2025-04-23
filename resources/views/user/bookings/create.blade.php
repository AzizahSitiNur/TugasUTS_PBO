<!-- resources/views/user/bookings/create.blade.php -->
@extends('layouts.user')

@section('title', 'Buat Peminjaman Ruangan')

@section('content')
    <h1>Buat Peminjaman Ruangan</h1>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Peminjaman</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.bookings.store') }}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="room_id" class="form-label">Pilih Ruangan</label>
                    <select class="form-select @error('room_id') is-invalid @enderror" id="room_id" name="room_id" required>
                        <option value="">-- Pilih Ruangan --</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->name }} (Kapasitas: {{ $room->capacity }} orang)
                            </option>
                        @endforeach
                    </select>
                    @error('room_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Waktu Mulai</label>
                            <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" value="{{ old('start_time') }}" required>
                            @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_time" class="form-label">Waktu Selesai</label>
                            <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" value="{{ old('end_time') }}" required>
                            @error('end_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="purpose" class="form-label">Tujuan Peminjaman</label>
                    <textarea class="form-control @error('purpose') is-invalid @enderror" id="purpose" name="purpose" rows="4" required>{{ old('purpose') }}</textarea>
                    @error('purpose')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Jelaskan tujuan dan kegiatan yang akan dilakukan.</div>
                </div>
                
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Permintaan peminjaman Anda akan ditinjau oleh admin. Status peminjaman akan diperbarui setelah admin memberikan persetujuan.
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Kirim Permintaan Peminjaman</button>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-light">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection