@extends('admin.layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <!-- Header -->
    <div class="bg-black/20 backdrop-blur-sm border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold dark-gradient-text">Detail Transaksi</h1>
                    <p class="text-slate-400 mt-1">#{{ $transaksi->id }}</p>
                </div>
                <a href="{{ route('admin.transaksi.index') }}" class="accent-button">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Transaction Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Transaction Info -->
                <div class="minimal-card">
                    <h2 class="text-xl font-bold dark-gradient-text mb-6">Informasi Transaksi</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">ID Transaksi</label>
                            <p class="text-white font-medium">#{{ $transaksi->id }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Tanggal Transaksi</label>
                            <p class="text-white font-medium">{{ $transaksi->created_at->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Jumlah Tiket</label>
                            <p class="text-white font-medium">{{ $transaksi->jumlah }} tiket</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Total Pembayaran</label>
                            <p class="text-2xl font-bold dark-gradient-text">
                                Rp {{ number_format($transaksi->jumlah * $transaksi->tiket->harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Ticket Details -->
                <div class="minimal-card">
                    <h2 class="text-xl font-bold dark-gradient-text mb-6">Detail Tiket</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Nama Tiket</label>
                            <p class="text-white font-medium">{{ $transaksi->tiket->nama_tiket }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Harga per Tiket</label>
                            <p class="text-white font-medium">Rp {{ number_format($transaksi->tiket->harga, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Event</label>
                            <p class="text-white font-medium">{{ $transaksi->tiket->event->nama_event }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Tanggal Event</label>
                            <p class="text-white font-medium">{{ $transaksi->tiket->event->tanggal_waktu->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="space-y-6">
                <!-- Customer Details -->
                <div class="minimal-card">
                    <h2 class="text-xl font-bold dark-gradient-text mb-6">Informasi Pembeli</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Nama</label>
                            <p class="text-white font-medium">{{ $transaksi->user->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Email</label>
                            <p class="text-white font-medium">{{ $transaksi->user->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Role</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-500/20 text-purple-400">
                                {{ $transaksi->user->role ?? 'User' }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Bergabung Sejak</label>
                            <p class="text-white font-medium">{{ $transaksi->user->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Event Info -->
                <div class="minimal-card">
                    <h2 class="text-xl font-bold dark-gradient-text mb-6">Informasi Event</h2>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Nama Event</label>
                            <p class="text-white font-medium">{{ $transaksi->tiket->event->nama_event }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Lokasi</label>
                            <p class="text-white font-medium">{{ $transaksi->tiket->event->lokasi }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Kategori</label>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/20 text-blue-400">
                                {{ $transaksi->tiket->event->kategori->nama }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-400 mb-2">Deskripsi</label>
                            <p class="text-slate-300 text-sm">{{ Str::limit($transaksi->tiket->event->deskripsi, 150) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection