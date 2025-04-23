<!-- resources/views/user/bookings/index.blade.php -->
@extends('layouts.user')

@section('title', 'Peminjaman Saya')

@section('content')
    <h1>Peminjaman Saya</h1>
    
    <div class="mb-4">
        <a href="{{ route('user.bookings.create') }}" class="btn btn-primary">Buat Peminjaman Baru</a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all">Semua</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pending-tab" data-bs-toggle="tab" href="#pending">Menunggu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="approved-tab" data-bs-toggle="tab" href="#approved">Disetujui</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="rejected-tab" data-bs-toggle="tab" href="#rejected">Ditolak</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="all">
                    @include('user.bookings._table', ['bookings' => $bookings])
                </div>
                <div class="tab-pane fade" id="pending">
                    @include('user.bookings._table', ['bookings' => $bookings->where('status', 'pending')])
                </div>
                <div class="tab-pane fade" id="approved">
                    @include('user.bookings._table', ['bookings' => $bookings->where('status', 'approved')])
                </div>
                <div class="tab-pane fade" id="rejected">
                    @include('user.bookings._table', ['bookings' => $bookings->where('status', 'rejected')])
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        {{ $bookings->links() }}
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const triggerTabList = [].slice.call(document.querySelectorAll('#myTab a'))
        triggerTabList.forEach(function (triggerEl) {
            const tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    });
</script>
@endsection