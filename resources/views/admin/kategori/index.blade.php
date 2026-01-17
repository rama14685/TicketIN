@extends('layouts.admin')

@section('title', 'Kategori')
@section('header', 'Manajemen Kategori')

@section('content')

{{-- NOTIFIKASI --}}
@if (session('success'))
    <div class="mb-6 bg-green-100 border border-green-300 text-green-700 p-4 rounded">
        {{ session('success') }}
    </div>
@endif

{{-- TOMBOL TAMBAH --}}
<a href="{{ route('admin.kategori.create') }}"
   class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    + Tambah Kategori
</a>

{{-- TABEL --}}
<table class="w-full border mt-4">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3 border w-16">No</th>
            <th class="p-3 border text-left">Nama Kategori</th>
            <th class="p-3 border w-48">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($kategoris as $index => $kategori)
            <tr class="hover:bg-gray-50">
                <td class="p-3 border text-center">{{ $index + 1 }}</td>
                <td class="p-3 border">{{ $kategori->nama }}</td>
                <td class="p-3 border text-center space-x-2">
                    <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                       class="bg-yellow-400 px-3 py-1 rounded text-sm">
                        Edit
                    </a>

                    <form action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                          method="POST"
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')"
                                class="bg-red-500 text-white px-3 py-1 rounded text-sm">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="p-4 text-center text-gray-500">
                    Data belum tersedia
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection
