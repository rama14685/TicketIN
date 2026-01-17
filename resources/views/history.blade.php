@extends('layouts.app')

@section('content')
<div class="min-h-screen dark-bg text-gray-100 py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="mb-8">
            <h1 class="text-3xl font-light dark-gradient-text mb-2">Riwayat Pembelian</h1>
            <p class="text-gray-400">Lihat semua tiket yang telah Anda beli</p>
        </div>

<<<<<<< HEAD
        @if($transaksis->count() > 0 || $orders->count() > 0)
            <div class="space-y-6">
                <!-- Orders dari Checkout Cart -->
                @foreach($orders as $order)
                    <div class="minimal-card rounded-xl p-6 border-l-4 border-blue-500">
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-medium text-gray-200 mb-2">
                                    Order Checkout - {{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d M Y') }}
                                </h3>
                                <div class="space-y-2 text-sm text-gray-400">
                                    @foreach($order->details as $detail)
                                        <p>
                                            <span class="text-gray-500">Tiket:</span> 
                                            {{ $detail->tiket->tipe }} ({{ $detail->jumlah }}x) - 
                                            <strong class="text-gray-300">{{ $detail->tiket->event->judul }}</strong>
                                        </p>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 md:text-right">
                                <div class="text-2xl font-light dark-gradient-text mb-2">
                                    Total: Rp {{ number_format($order->total_harga) }}
                                </div>
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-500/20 text-blue-400">
                                    Checkout - #{{ $order->id }}
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-700 pt-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 15h4.01M12 21h4.01M12 3h4.01M6 3h4.01M6 6h4.01M6 9h4.01M6 12h4.01M6 15h4.01M6 18h4.01M6 21h4.01"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-200">E-Ticket</div>
                                        <div class="text-xs text-gray-400">Order ID: #{{ $order->id }}</div>
                                    </div>
                                </div>
                                <button class="accent-button px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:scale-105">
                                    Download E-Ticket
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

                <!-- Transaksi dari Beli Langsung -->
=======
        @if($transaksis->count() > 0)
            <div class="space-y-6">
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
                @foreach($transaksis as $transaksi)
                    <div class="minimal-card rounded-xl p-6">
                        <div class="flex flex-col md:flex-row md:items-center justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-xl font-medium text-gray-200 mb-2">
                                    {{ $transaksi->tiket->event->judul }}
                                </h3>
                                <div class="grid md:grid-cols-2 gap-4 text-sm text-gray-400">
                                    <div class="space-y-1">
                                        <p><span class="text-gray-500">Tiket:</span> {{ $transaksi->tiket->tipe }}</p>
                                        <p><span class="text-gray-500">Jumlah:</span> {{ $transaksi->jumlah }} tiket</p>
                                        <p><span class="text-gray-500">Harga per tiket:</span> Rp {{ number_format($transaksi->tiket->harga) }}</p>
                                    </div>
                                    <div class="space-y-1">
                                        <p><span class="text-gray-500">Lokasi:</span> {{ $transaksi->tiket->event->lokasi }}</p>
                                        <p><span class="text-gray-500">Tanggal Event:</span> {{ \Carbon\Carbon::parse($transaksi->tiket->event->tanggal_waktu)->translatedFormat('l, d F Y H:i') }}</p>
                                        <p><span class="text-gray-500">Dibeli pada:</span> {{ $transaksi->created_at->translatedFormat('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 md:text-right">
                                <div class="text-2xl font-light dark-gradient-text mb-2">
                                    Total: Rp {{ number_format($transaksi->total_harga) }}
                                </div>
                                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                    {{ $transaksi->tiket->event->tanggal_waktu > now() ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                                    {{ $transaksi->tiket->event->tanggal_waktu > now() ? 'Event Mendatang' : 'Event Selesai' }}
                                </div>
                            </div>
                        </div>

                        {{-- QR Code Placeholder --}}
                        <div class="border-t border-gray-700 pt-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M12 15h4.01M12 21h4.01M12 3h4.01M6 3h4.01M6 6h4.01M6 9h4.01M6 12h4.01M6 15h4.01M6 18h4.01M6 21h4.01"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-200">E-Ticket</div>
                                        <div class="text-xs text-gray-400">ID Transaksi: #{{ $transaksi->id }}</div>
                                    </div>
                                </div>
                                <button class="accent-button px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:scale-105">
                                    Download E-Ticket
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Pagination --}}
                <div class="mt-8">
<<<<<<< HEAD
                    @if($orders->count() > 0)
                        {{ $orders->links() }}
                    @elseif($transaksis->count() > 0)
                        {{ $transaksis->links() }}
                    @endif
=======
                    {{ $transaksis->links() }}
>>>>>>> 3595ef552b03d60e44f8a3ee4acdc271d27a8810
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <div class="text-6xl mb-6">🎫</div>
                <h2 class="text-2xl font-light text-gray-300 mb-4">Belum Ada Riwayat Pembelian</h2>
                <p class="text-gray-400 mb-8">Anda belum membeli tiket apapun. Mulai jelajahi event menarik!</p>
                <a href="{{ route('events.index') }}" class="accent-button rounded-lg px-8 py-3 font-medium inline-block transition-all duration-300 hover:scale-105">
                    Jelajahi Event
                </a>
            </div>
        @endif
    </div>
</div>
@endsection