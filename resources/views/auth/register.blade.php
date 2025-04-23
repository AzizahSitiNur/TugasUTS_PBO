<x-guest-layout>
    <div class="max-w-md mx-auto bg-white">
        <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">Daftar Akun Baru</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-blue-900">Nama</label>
                <input id="name" class="w-full border border-blue-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-800 text-blue-900"
                       type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-blue-900">Email</label>
                <input id="email" class="w-full border border-blue-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-800 text-blue-900"
                       type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-blue-900">Kata Sandi</label>
                <input id="password" class="w-full border border-blue-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-800 text-blue-900"
                       type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-blue-900">Konfirmasi Kata Sandi</label>
                <input id="password_confirmation" class="w-full border border-blue-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-800 text-blue-900"
                       type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a class="text-sm text-blue-800 hover:underline" href="{{ route('login') }}">
                    Sudah punya akun?
                </a>

                <button type="submit"
                        class="bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-700">
                    Daftar
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
