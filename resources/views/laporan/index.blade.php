<x-app-layout>
    <div class="container">
        <h2>Laporan Peminjaman Ruangan</h2>

        <form method="GET" action="{{ route('laporan.index') }}" class="mb-4">
            <div>
                <label>Start Date:</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}">
                <label>End Date:</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}">
                <button type="submit">Filter</button>
                <a href="{{ route('laporan.export', request()->only(['start_date', 'end_date'])) }}">Export PDF</a>
            </div>
        </form>

        <table border="1" cellpadding="8">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ruangan</th>
                    <th>Peminjam</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $booking->room->name }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                        <td>{{ ucfirst($booking->status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Tidak ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
