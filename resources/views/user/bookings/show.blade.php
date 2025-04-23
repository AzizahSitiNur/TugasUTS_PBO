<!-- resources/views/user/bookings/show.blade.php -->
@extends('layouts.user')

@section('title', 'Detail Peminjaman')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Detail Peminjaman</h1>
        <a href="{{ route('user.bookings.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    
    <div class="card">
        <div class="card-header 
            @if($booking->status == 'pending')
                bg-warning text-dark
            @elseif($booking->status == 'approved')
                bg-success text-white
            @else
                bg-danger text-white
            @endif">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    Status: 
                    @if($booking->status == 'pending')
                        Menunggu Persetujuan
                    @elseif($booking->status == 'approved')
                        Disetujui
                    @else
                        Ditolak
                    @endif
                </h5>
                <span>ID: #{{ $booking->id }}</span>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5>Informasi Ruangan</h5>
                    <table class="table">
                        <tr>
                            <th style="width: 30%">Nama Ruangan</th>
                            <td>{{ $booking->room->name }}</td>
                        </tr>
                        <tr>
                            <th>Lokasi</th>
                            <td>{{ $booking->room->location ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Kapasitas</th>
                            <td>{{ $booking->room->capacity }} orang</td>
                        </tr>
                        <tr>
                            <th>Fasilitas</th>
                            <td>{{ $booking->room->facilities ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h5>Informasi Peminjaman</h5>
                    <table class="table">
                        <tr>
                            <th style="width: 30%">Waktu Mulai</th>
                            <td>{{ $booking->start_time->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Selesai</th>
                            <td>{{ $booking->end_time->format('d/m/Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Durasi</th>
                            <td>{{ $booking->start_time->diffInHours($booking->end_time) }} jam</td>
                        </tr>
                        <tr>
                            <th>Tanggal Permintaan</th>
                            <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="mt-4">
                <h5>Tujuan Peminjaman</h5>
                <div class="card">
                    <div class="card-body bg-light">
                        {{ $booking->purpose }}
                    </div>
                </div>
            </div>
            
            @if($booking->admin_notes)
                <div class="mt-4">
                    <h5>Catatan Admin</h5>
                    <div class="card">
                        <div class="card-body bg-light">
                            {{ $booking->admin_notes }}
                        </div>
                    </div>
                </div>
            @endif
            
            <div class="mt-4">
                @if($booking->status == 'pending')
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle"></i> Permintaan peminjaman Anda sedang menunggu persetujuan admin.
                    </div>
                    
                    <form action="{{ route('user.bookings.cancel', $booking) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan peminjaman ini?')">Batalkan Peminjaman</button>
                    </form>
                @elseif($booking->status == 'approved')
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i> Permintaan peminjaman Anda telah disetujui oleh admin.
                    </div>
                @else
                    <div class="alert alert-danger">
                        <i class="bi bi-x-circle"></i> Permintaan peminjaman Anda ditolak oleh admin.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection