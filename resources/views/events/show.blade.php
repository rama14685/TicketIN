@extends('layouts.app')

@section('content')
<div class="min-h-screen dark-bg text-gray-100">
    <!-- Hero Section with Event Image -->
    <div class="relative h-96 overflow-hidden">
        @if($event->gambar)
            <img src="{{ asset('storage/' . $event->gambar) }}" alt="{{ $event->judul }}"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        @else
            <div class="w-full h-full bg-gradient-to-br from-gray-800 to-gray-900 flex items-center justify-center">
                <div class="text-center">
                    <div class="text-6xl mb-4">🎪</div>
                    <h2 class="text-2xl font-light text-gray-300">Event Image</h2>
                </div>
            </div>
        @endif

        <!-- Event Info Overlay -->
        <div class="absolute bottom-0 left-0 right-0 p-8">
            <div class="max-w-4xl mx-auto">
                <div class="inline-flex items-center px-4 py-2 minimal-card rounded-full text-sm font-medium text-indigo-300 mb-4">
                    {{ $event->kategori->nama }}
                </div>
                <h1 class="text-4xl md:text-5xl font-light dark-gradient-text mb-4">
                    {{ $event->judul }}
                </h1>
                <div class="flex flex-wrap items-center gap-6 text-gray-300">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span>{{ $event->lokasi }}</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($event->tanggal_waktu)->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-6 py-12">
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Event Description -->
            <div class="lg:col-span-2 space-y-8">
                <div class="minimal-card rounded-xl p-8">
                    <h2 class="text-2xl font-light dark-gradient-text mb-6">Tentang Event</h2>
                    <div class="prose prose-lg prose-invert max-w-none">
                        <p class="text-gray-300 leading-relaxed whitespace-pre-line">
                            {{ $event->deskripsi }}
                        </p>
                    </div>
                </div>

                <!-- Event Details -->
                <div class="minimal-card rounded-xl p-8">
                    <h3 class="text-xl font-light dark-gradient-text mb-6">Detail Event</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-indigo-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-400">Lokasi</div>
                                    <div class="font-medium text-gray-200">{{ $event->lokasi }}</div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-400">Tanggal & Waktu</div>
                                    <div class="font-medium text-gray-200">{{ \Carbon\Carbon::parse($event->tanggal_waktu)->translatedFormat('l, d F Y') }}</div>
                                    <div class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($event->tanggal_waktu)->format('H:i') }} WIB</div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-400">Kategori</div>
                                    <div class="font-medium text-gray-200">{{ $event->kategori->nama }}</div>
                                </div>
                            </div>

                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-400">Organizer</div>
                                    <div class="font-medium text-gray-200">{{ $event->user->name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ticket Selection Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-8">
                    <div class="minimal-card rounded-xl p-6">
                        <h3 class="text-xl font-light dark-gradient-text mb-6">Pilih Tiket</h3>

                        @if($event->tikets->count() > 0)
                            <div class="space-y-4">
                                @foreach ($event->tikets as $tiket)
<<<<<<< HEAD
                                    @php
                                        // Hitung tiket terjual dari Transaksi dan DetailOrder
                                        $transaksiTerjual = $tiket->transaksis()->sum('jumlah');
                                        $detailOrderTerjual = $tiket->detailOrders()->sum('jumlah');
                                        $totalTerjual = $transaksiTerjual + $detailOrderTerjual;
                                        $sisaTerjual = $tiket->stok + $totalTerjual; // stok awal
                                    @endphp
=======
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
                                    <div class="minimal-card rounded-lg p-4 hover:bg-white/5 transition-colors duration-300">
                                        <div class="flex justify-between items-start mb-3">
                                            <div>
                                                <h4 class="font-medium text-gray-200 capitalize">
                                                    Tiket {{ $tiket->tipe }}
                                                </h4>
                                                <p class="text-2xl font-light dark-gradient-text mt-1">
                                                    Rp {{ number_format($tiket->harga) }}
                                                </p>
                                            </div>
                                            <div class="text-right">
<<<<<<< HEAD
                                                <div class="text-sm text-gray-400">Stok Tersisa</div>
                                                <div class="font-medium {{ $tiket->available_stok > 0 ? 'text-green-400' : 'text-red-400' }}">
                                                    {{ $tiket->available_stok }}/{{ $sisaTerjual }}
=======
                                                <div class="text-sm text-gray-400">Stok</div>
                                                <div class="font-medium {{ $tiket->available_stok > 0 ? 'text-green-400' : 'text-red-400' }}">
                                                    {{ $tiket->available_stok }}
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
                                                </div>
                                            </div>
                                        </div>

<<<<<<< HEAD
                                        <!-- Progress Bar -->
                                        @if($sisaTerjual > 0)
                                            <div class="mb-3">
                                                <div class="flex justify-between items-center mb-1">
                                                    <span class="text-xs text-gray-400">Terjual</span>
                                                    <span class="text-xs font-medium text-gray-300">{{ $totalTerjual }} dari {{ $sisaTerjual }}</span>
                                                </div>
                                                <div class="w-full bg-gray-700 rounded-full h-2">
                                                    <div class="bg-gradient-to-r from-green-500 to-emerald-400 h-2 rounded-full transition-all duration-300"
                                                         style="width: {{ ($totalTerjual / $sisaTerjual) * 100 }}%"></div>
                                                </div>
                                            </div>
                                        @endif

=======
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
                                        @if($tiket->available_stok > 0)
                                            <form method="POST" action="{{ route('cart.add', $tiket->id) }}" class="space-y-3">
                                                @csrf
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex-1">
                                                        <label class="block text-sm text-gray-400 mb-1">Jumlah</label>
                                                        <input type="number" name="jumlah" value="1" min="1" max="{{ $tiket->available_stok }}"
                                                               class="w-full minimal-input rounded-lg px-3 py-2 text-center">
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                        class="w-full accent-button rounded-lg py-3 font-medium transition-all duration-300 hover:scale-105">
                                                    Tambah ke Keranjang
                                                </button>
                                            </form>
                                        @else
                                            <div class="w-full bg-gray-600/50 text-gray-400 rounded-lg py-3 text-center font-medium">
                                                Stok Habis
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <div class="text-4xl mb-4">🎫</div>
                                <p class="text-gray-400">Belum ada tiket tersedia</p>
                            </div>
                        @endif
                    </div>

                    <!-- Share Section -->
                    <div class="minimal-card rounded-xl p-6 mt-6">
                        <h4 class="font-medium text-gray-200 mb-4">Bagikan Event</h4>
                        <div class="flex space-x-3">
                            <button class="w-10 h-10 minimal-card rounded-lg flex items-center justify-center hover:bg-white/10 transition-colors">
                                <span class="text-blue-400">📘</span>
                            </button>
                            <button class="w-10 h-10 minimal-card rounded-lg flex items-center justify-center hover:bg-white/10 transition-colors">
                                <span class="text-blue-400">🐦</span>
                            </button>
                            <button class="w-10 h-10 minimal-card rounded-lg flex items-center justify-center hover:bg-white/10 transition-colors">
                                <span class="text-pink-400">📷</span>
                            </button>
                            <button class="w-10 h-10 minimal-card rounded-lg flex items-center justify-center hover:bg-white/10 transition-colors">
                                <span class="text-green-400">💬</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


