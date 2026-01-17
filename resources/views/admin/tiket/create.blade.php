@extends('layouts.admin')

@section('header', 'Tambah Tiket untuk Event: ' . $event->judul)

@section('content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">
        <div class="mb-6">
            <a href="{{ route('admin.events.show', $event) }}" class="text-indigo-600 hover:text-indigo-900">
                ← Kembali ke Detail Event
            </a>
        </div>

        <form method="POST" action="{{ route('admin.events.tiket.store', $event->id) }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="tipe" class="block text-sm font-medium text-gray-700">Tipe Tiket</label>
                    <select name="tipe" id="tipe" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="reguler" {{ old('tipe') == 'reguler' ? 'selected' : '' }}>Reguler</option>
                        <option value="premium" {{ old('tipe') == 'premium' ? 'selected' : '' }}>Premium</option>
                    </select>
                    @error('tipe')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" value="{{ old('harga') }}" min="0" step="1000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="0">
                    @error('harga')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="stok" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                    <input type="number" name="stok" id="stok" value="{{ old('stok') }}" min="0" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="0">
                    @error('stok')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end">
                <a href="{{ route('admin.events.show', $event) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 mr-3">
                    Batal
                </a>
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                    Simpan Tiket
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
