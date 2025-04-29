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
                    <h3>{{ $pendingBookings ? $pendingBookings->count() : 0 }}</h3>
                    <p>Menunggu persetujuan admin</p>
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('user.bookings.index') }}" class="btn btn-sm btn-light">Lihat Semua</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-success text-white mb-4">
                <div class="card-header">
                    <h5>Peminjaman Akan Datang</h5>
                </div>
                <div class="card-body">
                    <h3>{{ $upcomingBookings ? $upcomingBookings->count() : 0 }}</h3>
                    <p>Sudah disetujui</p>
                </div>
                <div class="card-footer text-center">
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
                    @if (!$pastBookings || $pastBookings->isEmpty())
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
                                    @foreach ($pastBookings as $booking)
                                        <tr>
                                            <td>{{ $booking->room->name }}</td>
                                            <td>{{ $booking->start_time->format('d/m/Y H:i') }} -
                                                {{ $booking->end_time->format('d/m/Y H:i') }}</td>
                                            <td>
                                                @if ($booking->status == 'approved')
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

                
                    <!-- Action buttons (if applicable) -->
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

                dateClick: function(info) {
                    const selectedDate = info.dateStr;
                    const eventsOnDate = calendar.getEvents().filter(event => {
                        return event.start.toISOString().split('T')[0] === selectedDate;
                    });

                    if (eventsOnDate.length > 0) {
                        let eventDetails = '<ul>';
                        eventsOnDate.forEach(event => {
                            eventDetails += `
                        <li>
                            <strong>Ruangan:</strong> ${event.extendedProps.room_name}<br>
                            <strong>Tujuan:</strong> ${event.extendedProps.description}<br>
                            <strong>Waktu:</strong> ${event.start.toLocaleString()} - ${event.end.toLocaleString()}
                        </li>
                    `;
                        });
                        eventDetails += '</ul>';
                        alert(`Peminjaman pada tanggal ${selectedDate}:<br>${eventDetails}`);
                    } else {
                        alert('Tidak ada peminjaman pada tanggal ini.');
                    }
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
