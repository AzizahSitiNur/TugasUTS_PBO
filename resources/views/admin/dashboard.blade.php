<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')

<!-- Background Gradient + Pola Bintik -->
<style>
    body {
        background: linear-gradient(135deg, #2c3e50, #34495e) !important;
        min-height: 100vh;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
    }

    .card-custom {
        border-radius: 15px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card-custom:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
    }

    .progress-container {
        margin-top: 30px;
    }

    .progress-bar {
        height: 20px;
        border-radius: 9999px;
        background: linear-gradient(90deg, #4ade80 0%, #22c55e 100%);
        animation: progressBar 2s ease-out forwards;
    }

    @keyframes progressBar {
        from {
            width: 0;
        }
        to {
            width: {{ $progress }}%;
        }
    }
</style>

<!-- Welcome Message -->
<div class="text-white text-3xl font-bold mb-8 animate-fade-slide-up">
    Selamat Datang, {{ Auth::user()->name }} 
</div>

<h1 class="text-white text-4xl font-extrabold mb-6">Dashboard Admin</h1>

<!-- Cards Section -->
<div class="row mt-4">

    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white card-custom">
            <div class="card-body">
                <h5 class="card-title">🏢 Total Ruangan</h5>
                <h2>{{ $totalRooms }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white card-custom">
            <div class="card-body">
                <h5 class="card-title">👤 Total Pengguna</h5>
                <h2>{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-dark card-custom">
            <div class="card-body">
                <h5 class="card-title">⏳ Peminjaman Tertunda</h5>
                <h2>{{ $pendingBookings }}</h2>
            </div>
        </div>
    </div>

    <div class="col-md-3 mb-4">
        <div class="card bg-info text-white card-custom">
            <div class="card-body">
                <h5 class="card-title">✅ Peminjaman Disetujui</h5>
                <h2>{{ $approvedBookings }}</h2>
            </div>
        </div>
    </div>

</div>

<!-- Progress Bar -->
<div class="progress-container">
    <h3 class="text-white mb-2">Progress Peminjaman Tahun Ini</h3>
    <p class="text-white mt-1">{{ $totalPeminjaman }} dari {{ $targetPeminjaman }} peminjaman</p>
    <div class="w-100 bg-gray-300 rounded-full">
        <div class="progress-bar" style="width: {{ $progress }}%;"></div>
    </div>
</div>

<!-- Buttons Section -->
<div class="mt-5">
    <h3 class="text-white text-2xl font-semibold mb-4">Laporan Peminjaman</h3>
    <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary mr-2">Lihat Semua</a>
    <a href="{{ route('admin.laporan.index') }}" class="btn btn-secondary">Lihat Laporan Peminjaman</a>
</div>

@endsection
