    <x-guest-layout>
        <div class="max-w-md mx-auto bg-white p-8 rounded border-2 border-blue-900 mt-10">
            <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">Reset Kata Sandi</h2>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- Token Reset -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-blue-900">Email</label>
                    <input id="email" class="w-full border border-blue-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-800 text-blue-900"
                        type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-blue-900">Kata Sandi Baru</label>
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

                <div class="flex items-center justify-end mt-6">
                    <button type="submit"
                            class="bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-700">
                        Reset Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </x-guest-layout>
