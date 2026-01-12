<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-light dark-gradient-text mb-2">Selamat Datang Kembali</h2>
        <p class="text-gray-400">Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="minimal-label block text-sm mb-2">
                Email
            </label>
            <input id="email" class="minimal-input block w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-0 transition-all duration-300"
                   type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Masukkan email Anda">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="minimal-label block text-sm mb-2">
                Password
            </label>
            <input id="password" class="minimal-input block w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-0 transition-all duration-300"
                   type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password Anda">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300 text-sm" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-600 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-offset-0 bg-gray-700">
                <span class="minimal-label ml-2 text-sm">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="minimal-label text-sm hover:text-white transition-colors duration-300 underline" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <div>
            <button type="submit" class="accent-button w-full py-3 px-4 rounded-lg font-semibold text-center transition-all duration-300 hover:scale-105">
                Masuk
            </button>
        </div>

        <div class="text-center">
            <p class="text-gray-400 text-sm">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-white hover:text-indigo-300 font-semibold transition-colors duration-300 underline">
                    Daftar sekarang
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
