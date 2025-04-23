<x-guest-layout>
    <div class="max-w-md mx-auto bg-white ">
        <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">Lupa Kata Sandi?</h2>

        <p class="text-sm text-blue-800 mb-4 text-center">
            Tidak masalah. Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mereset kata sandi Anda.
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 text-sm text-green-600 text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-blue-900">Email</label>
                <input id="email" class="w-full border border-blue-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-800 text-blue-900"
                       type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <!-- Link kecil ke login -->
                <a href="{{ route('login') }}" class="text-sm text-blue-800 hover:underline">
                    Kembali ke Halaman Login
                </a>

                <!-- Tombol submit -->
                <button type="submit"
                        class="bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-700">
                    Kirim Tautan Reset
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
