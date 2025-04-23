<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Ruangan</title>
</head>
<body>

    <h1>Tambah Ruangan</h1>

    <form action="{{ route('ruangans.store') }}" method="POST">
        @csrf
        <label>Nama Ruangan:</label>
        <input type="text" name="nama_ruangan" required>

        <label>Kapasitas:</label>
        <input type="number" name="kapasitas" required>

        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi" id="deskripsi"></textarea><br><br>

        <label>Lokasi:</label>
        <input type="text" name="lokasi">

        <button type="submit">Simpan</button>
    </form>
    
        <a href="{{ route('ruangans.index') }}">Kembali ke Daftar Ruangan</a>   

</body>
</html>
