<!-- resources/views/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="antialiased">

    <div class="container mx-auto text-center mt-10">
        <h1 class="text-3xl font-bold mb-4">Selamat datang di Situs Peminjaman Ruangan</h1>

        @auth
            <a href="{{ route('dashboard') }}" class="bg-green-500 text-white px-4 py-2 rounded">Dashboard</a>
        @else
            <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded m-2">Login</a>
            <a href="{{ route('register') }}" class="bg-gray-500 text-white px-4 py-2 rounded m-2">Register</a>
        @endauth

    </div>
    <a href="{{ route('user.ruangan.index') }}">Lihat Ruangan</a>

</body>
</html>
