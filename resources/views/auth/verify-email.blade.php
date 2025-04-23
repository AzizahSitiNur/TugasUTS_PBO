<x-guest-layout>
    <div class="max-w-md mx-auto bg-white">
        <h2 class="text-2xl font-bold text-center text-blue-900 mb-6">Verifikasi Email</h2>

        <p class="mb-4 text-sm text-blue-900 text-center">
            Terima kasih telah mendaftar! Silakan verifikasi email Anda dengan mengklik tautan yang kami kirimkan.
            Jika belum menerima email, kami akan kirimkan ulang.
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm text-green-600 text-center">
                Tautan verifikasi baru telah dikirim ke alamat email Anda.
            </div>
        @endif

        <div class="mt-6 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button class="text-sm text-blue-800 hover:underline">
                    Kirim Ulang Email Verifikasi
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="text-sm text-blue-800 hover:underline">
                    Log out
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
