@extends('layouts.app')

@section('content')
<div class="min-h-screen dark-bg text-gray-100 py-12">
    <div class="max-w-4xl mx-auto px-6">
        <div class="mb-8">
            <h1 class="text-3xl font-light dark-gradient-text mb-2">Keranjang Belanja</h1>
            <p class="text-gray-400">Kelola tiket yang ingin Anda beli</p>
        </div>

        @if(session('success'))
            <div class="mb-6 bg-green-500/20 border border-green-500/30 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-green-400">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 bg-red-500/20 border border-red-500/30 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-red-400">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        @if(count($cart) > 0)
            <div class="space-y-6">
                @foreach($cart as $index => $item)
                    <div class="minimal-card rounded-xl p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-medium text-gray-200 mb-2">{{ $item['event'] }}</h3>
                                <div class="space-y-1 text-sm text-gray-400">
                                    <p>Tiket: {{ $item['nama'] }}</p>
                                    <p>Lokasi: {{ $item['lokasi'] }}</p>
                                    <p>Tanggal: {{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y, H:i') }}</p>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('cart.remove', $index) }}" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="flex items-center space-x-4">
                                <span class="text-gray-400">Jumlah:</span>
                                <span class="font-medium text-gray-200">{{ $item['jumlah'] }}</span>
                            </div>
                            <div class="text-right">
                                <div class="text-sm text-gray-400">Harga per tiket</div>
                                <div class="text-lg font-medium dark-gradient-text">Rp {{ number_format($item['harga']) }}</div>
                                <div class="text-sm text-gray-400">Total: Rp {{ number_format($item['harga'] * $item['jumlah']) }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Total dan Checkout -->
                <div class="minimal-card rounded-xl p-6">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-xl font-medium text-gray-200">Total Pembayaran</span>
                        <span class="text-2xl font-light dark-gradient-text">
                            Rp {{ number_format(collect($cart)->sum(function($item) { return $item['harga'] * $item['jumlah']; })) }}
                        </span>
                    </div>

                    <div class="flex space-x-4">
                        <form method="POST" action="{{ route('cart.clear') }}" class="flex-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full minimal-button rounded-lg py-3 font-medium hover:bg-red-500/20 hover:border-red-500/30 transition-colors">
                                Kosongkan Keranjang
                            </button>
                        </form>

<<<<<<< HEAD
                        <!-- Dummy Checkout Button -->
                        <form method="POST" action="{{ route('checkout.store') }}" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full accent-button rounded-lg py-3 font-medium transition-all duration-300 hover:scale-105">
                                Lanjutkan ke Pembayaran
                            </button>
                        </form>
=======
                        <button class="flex-1 accent-button rounded-lg py-3 font-medium transition-all duration-300 hover:scale-105">
                            Lanjutkan ke Pembayaran
                        </button>
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-6">🛒</div>
                <h2 class="text-2xl font-light text-gray-300 mb-4">Keranjang Kosong</h2>
                <p class="text-gray-400 mb-8">Belum ada tiket yang ditambahkan ke keranjang</p>
                <a href="{{ route('events.index') }}" class="accent-button rounded-lg px-8 py-3 font-medium inline-block transition-all duration-300 hover:scale-105">
                    Jelajahi Event
                </a>
            </div>
        @endif
    </div>
</div>
@endsection