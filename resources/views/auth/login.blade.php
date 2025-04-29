<x-guest-layout>
    <div class="max-w-md mx-auto bg-white ">
        <div class="flex flex-col items-center mb-6">
            <img src="/logo.png" alt="Logo" class="w-24 h-24 mb-2">
            <h1 class="text-3xl font-bold text-center animate-text-slide-up">SIRUNTIR</h1>
        </div>
       

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-blue-900">Email</label>
                <input id="email" class="w-full border border-blue-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-800"
                       type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-blue-900">Kata Sandi</label>
                <input id="password" class="w-full border border-blue-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-800"
                       type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center mb-4">
                <input id="remember_me" type="checkbox" class="h-4 w-4 text-blue-800 border-gray-300 rounded" name="remember">
                <label for="remember_me" class="ml-2 text-sm text-blue-900">Ingat saya</label>
            </div>

            <div class="flex flex-col gap-4">
                <button type="submit"
                        class="w-full bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-700">
                    Masuk
                </button>

                <div class="text-center">
                    <a href="{{ route('register') }}" class="text-blue-800 hover:underline text-sm">
                        Belum punya akun? Daftar sekarang
                    </a>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-center mt-2">
                        <a class="text-sm text-gray-500 hover:text-blue-800 hover:underline"
                           href="{{ route('password.request') }}">
                            Lupa kata sandi?
                        </a>
                    </div>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>
