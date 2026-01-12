@extends('layouts.admin')

@section('header', 'Detail Event: ' . $event->judul)

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="flex justify-between items-start mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">{{ $event->judul }}</h2>
                <p class="text-gray-600 mt-1">{{ $event->kategori->nama }}</p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.events.edit', $event) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">
                    Edit Event
                </a>
                <a href="{{ route('admin.events.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h3 class="text-lg font-semibold mb-2">Informasi Event</h3>
                <div class="space-y-2">
                    <p><strong>Lokasi:</strong> {{ $event->lokasi }}</p>
                    <p><strong>Tanggal & Waktu:</strong> {{ $event->tanggal_waktu->format('d F Y H:i') }}</p>
                    @if($event->gambar)
                        <p><strong>Gambar:</strong></p>
                        <img src="{{ asset('storage/' . $event->gambar) }}" alt="Event Image" class="w-32 h-32 object-cover rounded">
                    @endif
                </div>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-2">Deskripsi</h3>
                <p class="text-gray-700">{{ $event->deskripsi }}</p>
            </div>
        </div>

        <h3 class="text-xl font-semibold mt-8 mb-4">Daftar Tiket</h3>

        <div class="mb-4">
            <a href="{{ route('admin.events.tiket.create', $event->id) }}"
               class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                + Tambah Tiket
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($event->tikets as $tiket)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 capitalize">
                                {{ $tiket->tipe }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                Rp {{ number_format($tiket->harga, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $tiket->stok }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.tiket.edit', $tiket->id) }}" class="text-yellow-600 hover:text-yellow-900 mr-3">Edit</a>
                                <form method="POST" action="{{ route('admin.tiket.destroy', $tiket->id) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin hapus tiket ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                Tiket belum tersedia untuk event ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
