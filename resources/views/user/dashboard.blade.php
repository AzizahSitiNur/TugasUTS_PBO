<!-- resources/views/user/dashboard.blade.php -->
@extends('layouts.user')

@section('title', 'Dashboard User')

@section('content')
    <h1>Dashboard Peminjaman Ruangan</h1>
    <p class="text-muted">Selamat datang, {{ Auth::user()->name }}!</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-warning text-dark mb-4">
                <div class="card-header">
                    <h5>Peminjaman Tertunda</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $pendingBookings->count() }}</h3>
                    <p>Menunggu persetujuan admin</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('user.bookings.index') }}" class="btn btn-sm btn-dark">Lihat Semua</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-header">
                    <h5>Peminjaman Akan Datang</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $upcomingBookings->count() }}</h3>
                    <p>Sudah disetujui</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('user.bookings.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card bg-primary text-white mb-4">
                <div class="card-header">
                    <h5>Buat Peminjaman Baru</h5>
                </div>
                <div class="card-body">
                    <p>Pinjam ruangan untuk kegiatan Anda</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('user.bookings.create') }}" class="btn btn-sm btn-light">Buat Peminjaman</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-dark">
                    <h5>Peminjaman Tertunda</h5>
                </div>
                <div class="card-body">
                    @if($pendingBookings->isEmpty())
                        <p class="text-muted">Tidak ada peminjaman tertunda.</p>
                    @else
                        <div class="list-group">
                            @foreach($pendingBookings as $booking)
                                <a href="{{ route('user.bookings.show', $booking) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $booking->room->name }}</h5>
                                        <small>{{ $booking->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $booking->start_time->format('d/m/Y H:i') }} - {{ $booking->end_time->format('d/m/Y H:i') }}</p>
                                    <small class="text-muted">{{ Str::limit($booking->purpose, 50) }}</small>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>Peminjaman Akan Datang</h5>
                </div>
                <div class="card-body">
                    @if($upcomingBookings->isEmpty())
                        <p class="text-muted">Tidak ada peminjaman yang akan datang.</p>
                    @else
                        <div class="list-group">
                            @foreach($upcomingBookings as $booking)
                                <a href="{{ route('user.bookings.show', $booking) }}" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $booking->room->name }}</h5>
                                        <small>{{ $booking->start_time->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $booking->start_time->format('d/m/Y H:i') }} - {{ $booking->end_time->format('d/m/Y H:i') }}</p>
                                    <small class="text-muted">{{ Str::limit($booking->purpose, 50) }}</small>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5>Riwayat Peminjaman</h5>
                </div>
                <div class="card-body">
                    @if($pastBookings->isEmpty())
                        <p class="text-muted">Tidak ada riwayat peminjaman.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Ruangan</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                                        <th>Catatan Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pastBookings as $booking)
                                        <tr>
                                            <td>{{ $booking->room->name }}</td>
                                            <td>{{ $booking->start_time->format('d/m/Y H:i') }} - {{ $booking->end_time->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if($booking->status == 'approved')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif($booking->status == 'rejected')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $booking->admin_notes ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection