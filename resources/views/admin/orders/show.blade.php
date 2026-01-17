@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="mb-8">
        <a href="{{ route('admin.orders.index') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 font-medium mb-4 inline-block">
            ← Kembali ke Daftar Orders
        </a>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-2">Detail Order #{{ $order->id }}</h1>
        <p class="text-gray-600 dark:text-gray-400">Informasi lengkap pesanan</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Order Info -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Informasi Pesanan</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">ID Order</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">#{{ $order->id }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal Order</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $order->order_date->translatedFormat('d F Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Harga</p>
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">Rp {{ number_format($order->total_harga) }}</p>
                </div>
            </div>
        </div>

        <!-- Buyer Info -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Informasi Pembeli</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Nama</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $order->user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $order->user->email }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">Item Pesanan</h2>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tiket</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Event</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Subtotal</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($order->details as $detail)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $detail->tiket->tipe }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $detail->tiket->event->judul }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $detail->jumlah }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm text-gray-900 dark:text-gray-100">Rp {{ number_format($detail->tiket->harga) }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-semibold text-gray-900 dark:text-gray-100">Rp {{ number_format($detail->subtotal) }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Total Summary -->
        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
            <div class="flex justify-end">
                <div class="w-full md:w-1/3">
                    <div class="flex justify-between items-center text-lg font-bold">
                        <span class="text-gray-800 dark:text-gray-100">Total:</span>
                        <span class="text-blue-600 dark:text-blue-400">Rp {{ number_format($order->total_harga) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
