<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-8 rounded border-2 border-blue-900 mt-10">
        <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">Konfirmasi Kata Sandi</h2>

        <p class="mb-4 text-sm text-blue-900 text-center">
            Silakan masukkan kata sandi Anda untuk melanjutkan.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-blue-900">Kata Sandi</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="w-full border border-blue-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-blue-800 text-blue-900" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit"
                        class="bg-blue-900 hover:bg-blue-800 text-white font-semibold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-blue-700">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
