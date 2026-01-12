@extends('admin.layouts.app')

@section('title', 'Kelola Transaksi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900">
    <!-- Header -->
    <div class="bg-black/20 backdrop-blur-sm border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold dark-gradient-text">Kelola Transaksi</h1>
                    <p class="text-slate-400 mt-1">Pantau semua transaksi tiket</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Transactions Table -->
        <div class="minimal-card">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-white/10">
                            <th class="text-left py-4 px-4 text-slate-400 font-medium">ID</th>
                            <th class="text-left py-4 px-4 text-slate-400 font-medium">User</th>
                            <th class="text-left py-4 px-4 text-slate-400 font-medium">Event</th>
                            <th class="text-left py-4 px-4 text-slate-400 font-medium">Jumlah</th>
                            <th class="text-left py-4 px-4 text-slate-400 font-medium">Total</th>
                            <th class="text-left py-4 px-4 text-slate-400 font-medium">Tanggal</th>
                            <th class="text-left py-4 px-4 text-slate-400 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @forelse($transaksis as $transaksi)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="py-4 px-4 text-white font-medium">#{{ $transaksi->id }}</td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-purple-500/20 rounded-full flex items-center justify-center">
                                        <span class="text-purple-400 font-medium text-sm">
                                            {{ substr($transaksi->user->name, 0, 1) }}
                                        </span>
                                    </div>
                                    <span class="text-white">{{ $transaksi->user->name }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="text-white">{{ $transaksi->tiket->event->nama_event }}</span>
                                <p class="text-slate-400 text-sm">{{ $transaksi->tiket->nama_tiket }}</p>
                            </td>
                            <td class="py-4 px-4 text-white">{{ $transaksi->jumlah }} tiket</td>
                            <td class="py-4 px-4 text-white font-medium">
                                Rp {{ number_format($transaksi->jumlah * $transaksi->tiket->harga, 0, ',', '.') }}
                            </td>
                            <td class="py-4 px-4 text-slate-400">
                                {{ $transaksi->created_at->format('d M Y') }}
                                <p class="text-xs">{{ $transaksi->created_at->format('H:i') }}</p>
                            </td>
                            <td class="py-4 px-4">
                                <a href="{{ route('admin.transaksi.show', $transaksi) }}"
                                   class="text-purple-400 hover:text-purple-300 transition-colors">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center">
                                <svg class="w-12 h-12 text-slate-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-slate-400">Belum ada transaksi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($transaksis->hasPages())
            <div class="mt-6 px-4">
                {{ $transaksis->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection