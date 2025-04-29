<!-- resources/views/user/dashboard.blade.php -->
@extends('layouts.user')

@section('title', 'Dashboard User')

@section('content')
    <h1>Dashboard Peminjaman Ruangan</h1>
    <p class="text-muted">Selamat datang, {{ Auth::user()->name }}!</p>

    <div class="row mt-4">
        
        <div class="col-md-4">
            <div class="card bg-warning text-dark mb-4 rounded-4 shadow-sm border-0">
                <a href="{{route('user.bookings.index')}}">
                <div class="card-body d-flex align-items-center gap-4">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="fas fa-clock text-warning fa-3x"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start ">
                        <h3 class="fw-bold mb-1">{{ $pendingBookings ? $pendingBookings->count() : 0 }}</h3>
                        <p class="text-dark">Menunggu Persetujuan</p>
                    </div>
                </div>
                </a>
            </div>
        </div>
        

        <div class="col-md-4">
            <div class="card bg-success text-dark mb-4 rounded-4 shadow-sm border-0">
                <a href="{{route('user.bookings.index')}}">
                <div class="card-body d-flex align-items-center gap-4">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="fas fa-check-circle text-success fa-3x"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start text-white">
                        <h3>{{ $upcomingBookings ? $upcomingBookings->count() : 0 }}</h3>
                        <p>Sudah disetujui</p>
                    </div>
                </div>
                </a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-primary text-dark mb-4 rounded-4 shadow-sm border-0">
                <a href="{{ route('user.bookings.create') }}">
                <div class="card-body d-flex align-items-center gap-4">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                        <i class="fas fa-plus-circle text-primary fa-3x"></i>
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <h3 class="text-white">+</h3>
                        <p class="text-white">Buat Peminjaman</p>
                    </div>
                </div>
                </a>
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
                    @if (!$pendingBookings || $pendingBookings->isEmpty())
                        <p class="text-muted">Tidak ada peminjaman tertunda.</p>
                    @else
                        <div class="list-group">
                            @foreach ($pendingBookings as $booking)
                                <a href="{{ route('user.bookings.show', $booking) }}"
                                    class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $booking->room->name }}</h5>
                                        <small>{{ $booking->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $booking->start_time->format('d/m/Y H:i') }} -
                                        {{ $booking->end_time->format('d/m/Y H:i') }}</p>
                                
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
                    @if (!$upcomingBookings || $upcomingBookings->isEmpty())
                        <p class="text-muted">Tidak ada peminjaman yang akan datang.</p>
                    @else
                        <div class="list-group">
                            @foreach ($upcomingBookings as $booking)
                                <a href="{{ route('user.bookings.show', $booking) }}"
                                    class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $booking->room->name }}</h5>
                                        <small>{{ $booking->start_time->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $booking->start_time->format('d/m/Y H:i') }} -
                                        {{ $booking->end_time->format('d/m/Y H:i') }}</p>
                                   
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
                    @if (!$pastBookings || $pastBookings->isEmpty())
                        <p class="text-muted">Tidak ada riwayat peminjaman.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th>Ruang</th>
                                        <th>Waktu</th>
                                        <th>Status</th>
                        
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @foreach ($pastBookings as $booking)
                                        <tr>
                                            <td >{{ $booking->room->name }}</td>
                                            <td>{{ $booking->start_time->format('d/m/Y H:i') }} -
                                                {{ $booking->end_time->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if ($booking->status == 'approved')
                                                    <span class="badge bg-success">Disetujui</span>
                                                @elseif($booking->status == 'rejected')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                      
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
    <div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5>Kalender Peminjaman Ruangan</h5>
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="eventDetailModal" tabindex="-1" aria-labelledby="eventDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="eventDetailModalLabel">Detail Peminjaman</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                      
                        <div class="col-md-8">
                            <p><strong>Ruang  :</strong> <span id="modalRoomName"></span></p>
                            <p><strong>Durasi :</strong> <span id="modalTime"></span></p>
                            <p><strong>Status :</strong> <span id="modalStatus"></span></p>
                        </div>
                    </div>

                
                    
                    <div id="actionButtons" class="text-end">
                        <button type="button" class="btn btn-success" id="approveButton">Setujui</button>
                        <button type="button" class="btn btn-danger" id="rejectButton">Tolak</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'local',
                initialView: 'dayGridMonth',
                height: 500,
                events: '{{ route('user.calendar.events') }}',
                eventClick: function(info) {
           
                    document.getElementById('modalRoomName').textContent = info.event.extendedProps
                        .room_name;
                 
                    document.getElementById('modalTime').textContent =
                        `${info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' })} - ${info.event.end.toLocaleTimeString([], {
                            hour: '2-digit',
                            minute: '2-digit'
                        })}`;
                   
                    document.getElementById('modalStatus').textContent = info.event.extendedProps
                        .status || 'Menunggu'; 

                    const actionButtons = document.getElementById('actionButtons');
                    if (info.event.extendedProps.status === 'approved' || info.event.extendedProps
                        .status === 'rejected') {
                        actionButtons.style.display = 'none';
                    } else {
                        actionButtons.style.display = 'block';
                    }

          
                    const eventModal = new bootstrap.Modal(document.getElementById('eventDetailModal'));
                    eventModal.show();
                },

                

                eventTimeFormat: {
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: false
                },

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
            });

            calendar.render();
        });
    </script>
@endpush
