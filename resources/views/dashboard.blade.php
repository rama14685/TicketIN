@extends('layouts.app')

@section('content')
<div class="min-h-screen dark-bg text-gray-100">
    <!-- Hero Section -->
    <div class="relative h-64 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-purple-900 to-pink-900"></div>
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="relative z-10 flex items-center justify-center h-full">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-light dark-gradient-text mb-4">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Temukan dan pesan tiket event favorit Anda dengan mudah
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Quick Stats -->
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <div class="minimal-card rounded-xl p-6 text-center">
                <div class="text-3xl mb-2">🎫</div>
                <div class="text-2xl font-light dark-gradient-text">{{ $events->count() }}</div>
                <div class="text-gray-400">Event Tersedia</div>
            </div>
            <div class="minimal-card rounded-xl p-6 text-center">
                <div class="text-3xl mb-2">🛒</div>
                <div class="text-2xl font-light dark-gradient-text">{{ count(session('cart', [])) }}</div>
                <div class="text-gray-400">Item di Keranjang</div>
            </div>
            <div class="minimal-card rounded-xl p-6 text-center">
                <div class="text-3xl mb-2">⭐</div>
                <div class="text-2xl font-light dark-gradient-text">{{ \App\Models\Transaksi::where('user_id', Auth::id())->count() }}</div>
                <div class="text-gray-400">Tiket Dibeli</div>
            </div>
        </div>

        <!-- Recent Events -->
        <div class="mb-8">
            <h2 class="text-3xl font-light dark-gradient-text mb-6">Event Terbaru</h2>
            @if($events->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($events as $event)
                        <div class="minimal-card rounded-xl overflow-hidden hover:scale-105 transition-transform duration-300">
                            <div class="aspect-video bg-gradient-to-br from-gray-700 to-gray-800 flex items-center justify-center">
                                @if($event->gambar)
                                    <img src="{{ asset('storage/' . $event->gambar) }}" alt="{{ $event->judul }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="text-4xl">🎪</div>
                                @endif
                            </div>
                            <div class="p-6">
                                <div class="inline-flex items-center px-3 py-1 minimal-card rounded-full text-sm font-medium text-indigo-300 mb-3">
                                    {{ $event->kategori->nama }}
                                </div>
                                <h3 class="text-xl font-medium text-gray-200 mb-2">{{ $event->judul }}</h3>
                                <div class="flex items-center text-gray-400 text-sm mb-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $event->lokasi }}
                                </div>
                                <div class="flex items-center text-gray-400 text-sm mb-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($event->tanggal_waktu)->translatedFormat('d M Y, H:i') }}
                                </div>
                                <div class="flex justify-between items-center">
                                    <div class="text-sm text-gray-400">
                                        {{ $event->tikets->count() }} jenis tiket
                                    </div>
                                    <a href="{{ route('events.show', $event) }}"
                                       class="accent-button rounded-lg px-4 py-2 text-sm font-medium transition-all duration-300 hover:scale-105">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16">
                    <div class="text-6xl mb-6">🎪</div>
                    <h3 class="text-2xl font-light text-gray-300 mb-4">Belum Ada Event</h3>
                    <p class="text-gray-400 mb-8">Event akan segera hadir. Tetap pantau terus!</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="minimal-card rounded-xl p-8">
            <h3 class="text-2xl font-light dark-gradient-text mb-6 text-center">Aksi Cepat</h3>
            <div class="grid md:grid-cols-2 gap-6">
                <a href="{{ route('events.index') }}"
                   class="flex items-center p-4 minimal-card rounded-lg hover:bg-white/5 transition-colors">
                    <div class="w-12 h-12 bg-indigo-500/20 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-gray-200">Jelajahi Semua Event</div>
                        <div class="text-sm text-gray-400">Temukan event menarik lainnya</div>
                    </div>
                </a>

                <a href="{{ route('history') }}"
                   class="flex items-center p-4 minimal-card rounded-lg hover:bg-white/5 transition-colors">
                    <div class="w-12 h-12 bg-orange-500/20 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <div>
                        <div class="font-medium text-gray-200">Riwayat Pembelian</div>
                        <div class="text-sm text-gray-400">Lihat tiket yang telah dibeli</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
