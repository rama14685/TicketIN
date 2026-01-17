@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('header', 'Edit Kategori')

@section('content')

<div class="max-w-xl bg-white p-6 rounded shadow">

    <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- INPUT --}}
        <div class="mb-4">
            <label class="block mb-1 font-semibold">
                Nama Kategori
            </label>
            <input type="text"
                   name="nama"
                   value="{{ old('nama', $kategori->nama) }}"
                   class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300">

            @error('nama')
                <small class="text-red-500">{{ $message }}</small>
            @enderror
        </div>

        {{-- ACTION --}}
        <div class="flex gap-2">
            <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Simpan Perubahan
            </button>

            <a href="{{ route('admin.kategori.index') }}"
               class="bg-gray-300 px-4 py-2 rounded hover:bg-gray-400">
                Batal
            </a>
        </div>

    </form>

</div>

@endsection
