<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-3xl font-light dark-gradient-text mb-2">Bergabunglah dengan Kami</h2>
        <p class="text-gray-400">Buat akun baru dan mulai petualangan event Anda</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="minimal-label block text-sm mb-2">
                Nama Lengkap
            </label>
            <input id="name" class="minimal-input block w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-0 transition-all duration-300"
                   type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Masukkan nama lengkap Anda">
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-300 text-sm" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="minimal-label block text-sm mb-2">
                Email
            </label>
            <input id="email" class="minimal-input block w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-0 transition-all duration-300"
                   type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Masukkan email Anda">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300 text-sm" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="minimal-label block text-sm mb-2">
                Password
            </label>
            <input id="password" class="minimal-input block w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-0 transition-all duration-300"
                   type="password" name="password" required autocomplete="new-password" placeholder="Buat password yang kuat">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="minimal-label block text-sm mb-2">
                Konfirmasi Password
            </label>
            <input id="password_confirmation" class="minimal-input block w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-0 transition-all duration-300"
                   type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password Anda">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-300 text-sm" />
        </div>

        <div class="flex items-center justify-between">
            <a class="minimal-label text-sm hover:text-white transition-colors duration-300 underline" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit" class="accent-button py-3 px-6 rounded-lg font-semibold text-center transition-all duration-300 hover:scale-105">
                Daftar Sekarang
            </button>
        </div>
    </form>
</x-guest-layout>
