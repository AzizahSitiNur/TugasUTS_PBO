<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; margin: 20px; }
        .kop {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .logo {
            position: absolute;
            left: 0;
            top: 0;
            width: 80px;
        }
        .kop-content {
            margin: 0 auto;
        }
        .kop h3, .kop p {
            margin: 0;
            padding: 2px 0;
        }
        .garis-horizontal {
            border: none;
            border-top: 1px solid #000;
            height: 1px;
            margin-top: 10px;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        .ttd {
            text-align: right;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="kop">
        <img class="logo" src="{{ public_path('logo.png') }}" alt="Logo">
        <div class="kop-content">
            <h3>UNIVERSITAS SULTAN AGENG TIRTAYASA</h3>
            <p>FAKULTAS TEKNIK</p>
            <p>Jl. Jenderal Sudirman Km 3, Kotabumi, Kec. Purwakarta, Kota Cilegon, Banten 42435</p>
        </div>
    </div>
    
    <hr class="garis-horizontal">

    <h3 style="text-align: center; margin-top: 30px;">Laporan Peminjaman Ruangan</h3>

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

    <div class="ttd">
        <p>Mengetahui,</p>
        <p>Wakil Dekan Fakultas Teknik</p>
        <br><br><br>
        <p><strong>Dr. Ir. Contoh Nama, M.T.</strong></p>
        <p>NIP: 1234567890123456</p>
    </div>
</body>
</html>