<!-- resources/views/user/bookings/_table.blade.php -->
@if($bookings->isEmpty())
    <div class="text-center py-4">
        <p class="text-muted">Tidak ada data peminjaman.</p>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th>Ruangan</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Status</th>
                    <th>Catatan Admin</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->room->name }}</td>
                        <td>{{ $booking->start_time->format('d/m/Y H:i') }}</td>
                        <td>{{ $booking->end_time->format('d/m/Y H:i') }}</td>
                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge bg-warning text-dark">Menunggu</span>
                            @elseif($booking->status == 'approved')
                                <span class="badge bg-success">Disetujui</span>
                            @else
                                <span class="badge bg-danger">Ditolak</span>
                            @endif
                        </td>
                        <td>{{ $booking->admin_notes ?? '-' }}</td>
                        <td>
                            <a href="{{ route('user.bookings.show', $booking) }}" class="btn btn-sm btn-info">Detail</a>
                            
                            @if($booking->status == 'pending')
                                <form action="{{ route('user.bookings.cancel', $booking) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin membatalkan peminjaman ini?')">Batalkan</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif