<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; }
    </style>
</head>
<body>
    <h2>Laporan Peminjaman Ruangan</h2>

    <table>
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
            @foreach($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->room->name }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->start_time }}</td>
                    <td>{{ $booking->end_time }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
