@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <!-- Header -->
    <div class="bg-black/20 backdrop-blur-sm border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold dark-gradient-text">Dashboard Admin</h1>
                    <p class="text-slate-400 mt-1">Selamat datang di panel administrasi TicketIN</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-slate-400">Terakhir diperbarui</p>
                        <p class="text-white font-medium">{{ now()->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Events -->
            <div class="minimal-card group hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-400 text-sm font-medium">Total Event</p>
                        <p class="text-3xl font-bold dark-gradient-text">{{ $totalEvent }}</p>
                    </div>
                    <div class="p-3 bg-purple-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="minimal-card group hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-400 text-sm font-medium">Total Kategori</p>
                        <p class="text-3xl font-bold dark-gradient-text">{{ $totalKategori }}</p>
                    </div>
                    <div class="p-3 bg-blue-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Tickets -->
            <div class="minimal-card group hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-400 text-sm font-medium">Total Tiket</p>
                        <p class="text-3xl font-bold dark-gradient-text">{{ $totalTiket }}</p>
                    </div>
                    <div class="p-3 bg-green-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Revenue -->
            <div class="minimal-card group hover:scale-105 transition-transform duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-400 text-sm font-medium">Total Pendapatan</p>
                        <p class="text-3xl font-bold dark-gradient-text">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                    </div>
                    <div class="p-3 bg-yellow-500/20 rounded-lg">
                        <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Transactions & Orders -->
            <div class="lg:col-span-2">
                <div class="space-y-6">
                    <!-- Recent Orders dari Checkout -->
                    <div class="minimal-card">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold dark-gradient-text">Orders Checkout Terbaru</h2>
                            <a href="{{ route('admin.orders.index') }}" class="accent-button text-sm">
                                Lihat Semua
                            </a>
                        </div>

                        @if($recentOrders->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentOrders as $order)
                                <div class="flex items-center justify-between p-4 bg-white/5 rounded-lg hover:bg-white/10 transition-colors border-l-2 border-blue-500">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-blue-500/20 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-white">{{ $order->user->name }}</p>
                                            <p class="text-sm text-slate-400">Order #{{ $order->id }} - {{ $order->details->count() }} item</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-white">Rp {{ number_format($order->total_harga) }}</p>
                                        <p class="text-sm text-slate-400">{{ $order->order_date->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-slate-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-slate-400">Belum ada orders</p>
                            </div>
                        @endif
                    </div>

                    <!-- Recent Transactions -->
                    <div class="minimal-card">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold dark-gradient-text">Transaksi Langsung Terbaru</h2>
                            <a href="{{ route('admin.transaksi.index') }}" class="accent-button text-sm">
                                Lihat Semua
                            </a>
                        </div>

                        @if($recentTransactions->count() > 0)
                            <div class="space-y-4">
                                @foreach($recentTransactions as $transaction)
                                <div class="flex items-center justify-between p-4 bg-white/5 rounded-lg hover:bg-white/10 transition-colors">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 bg-purple-500/20 rounded-full flex items-center justify-center">
                                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-medium text-white">{{ $transaction->user->name }}</p>
                                            <p class="text-sm text-slate-400">{{ $transaction->tiket->event->judul }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="font-medium text-white">{{ $transaction->jumlah }} tiket</p>
                                        <p class="text-sm text-slate-400">{{ $transaction->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <svg class="w-12 h-12 text-slate-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-slate-400">Belum ada transaksi</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions & Popular Events -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="minimal-card">
                    <h3 class="text-lg font-bold dark-gradient-text mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('admin.events.create') }}" class="w-full accent-button flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <span>Tambah Event</span>
                        </a>
                        <a href="{{ route('admin.kategori.create') }}" class="w-full bg-white/10 hover:bg-white/20 text-white px-4 py-3 rounded-lg transition-colors flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            <span>Tambah Kategori</span>
                        </a>
                        <a href="{{ route('admin.events.index') }}" class="w-full bg-white/10 hover:bg-white/20 text-white px-4 py-3 rounded-lg transition-colors flex items-center justify-center space-x-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                            </svg>
                            <span>Kelola Event & Tiket</span>
                        </a>
                    </div>
                </div>

                <!-- Popular Events -->
                <div class="minimal-card">
                    <h3 class="text-lg font-bold dark-gradient-text mb-4">Event Populer</h3>
                    @if($popularEvents->count() > 0)
                        <div class="space-y-3">
                            @foreach($popularEvents as $event)
                            <div class="flex items-center space-x-3 p-3 bg-white/5 rounded-lg">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
                                    <span class="text-white font-bold text-sm">{{ substr($event->judul, 0, 1) }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-white font-medium truncate">{{ $event->judul }}</p>
                                    <p class="text-slate-400 text-sm">{{ $event->tickets_sold }} tiket terjual</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <p class="text-slate-400 text-sm">Belum ada event</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
