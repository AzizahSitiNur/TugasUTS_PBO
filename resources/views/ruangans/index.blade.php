<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ruangan</title>
</head>
<body>

    <h1>Daftar Ruangan</h1>

    <a href="{{ route('ruangans.create') }}">Tambah Ruangan</a>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Ruangan</th>
                <th>Kapasitas</th>
                <th>Deskripsi</th>
                <th>Lokasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ruangans as $ruangan)
                <tr>
                    <td>{{ $ruangan->id }}</td>
                    <td>{{ $ruangan->nama_ruangan }}</td>
                    <td>{{ $ruangan->kapasitas }}</td>
                    <td>{{ $ruangan->deskripsi }}</td>
                    <td>{{ $ruangan->lokasi }}</td>
                    <td>
                       <a href="{{ route('ruangans.edit', $ruangan->id) }}">Edit</a>
                        <form action="{{ route('ruangans.destroy', $ruangan->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('admin.home') }}">Kembali ke beranda</a>
</body>
</html>
