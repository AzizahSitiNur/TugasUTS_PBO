<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ruangan</title>
</head>
<body>

    <h1>Edit Ruangan</h1>

    <form action="{{ route('ruangans.update', $ruangan->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <label>Nama Ruangan:</label>
        <input type="text" name="nama_ruangan" value="{{ $ruangan->nama_ruangan }}" required>

        <label>Kapasitas:</label>
        <input type="number" name="kapasitas" value="{{ $ruangan->kapasitas }}" required>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi">{{ $ruangan->deskripsi }}</textarea><br><br>

        <label>Lokasi:</label>
        <input type="text" name="lokasi" value="{{ $ruangan->lokasi }}">

        <button type="submit">Simpan</button>
    </form>

    <a href="{{ route('ruangans.index') }}">Kembali ke Daftar Ruangan</a>
</body>
</html>
