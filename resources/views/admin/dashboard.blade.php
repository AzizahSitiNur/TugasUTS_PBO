<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <h1>Dashboard Admin</h1>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Ruangan</h5>
                    <h2>{{ $totalRooms }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">Total Pengguna</h5>
                    <h2>{{ $totalUsers }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5 class="card-title">Peminjaman Tertunda</h5>
                    <h2>{{ $pendingBookings }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Peminjaman Disetujui</h5>
                    <h2>{{ $approvedBookings }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-5">
        <h3>Peminjaman yang Menunggu Persetujuan</h3>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary">Lihat Semua</a>
    </div>
@endsection