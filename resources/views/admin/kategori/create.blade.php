@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('header', 'Tambah Kategori')

@section('content')

@if ($errors->any())
    <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.kategori.store') }}" method="POST">
    @csrf

    <div class="mb-4">
        <label class="block mb-2 font-medium">Nama Kategori</label>
        <input type="text"
               name="nama"
               value="{{ old('nama') }}"
               class="w-full border rounded px-4 py-2 focus:outline-none focus:ring"
               placeholder="Contoh: Konser Musik">
    </div>

    <div class="flex gap-2">
        <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>

        <a href="{{ route('admin.kategori.index') }}"
           class="bg-gray-300 px-6 py-2 rounded">
            Kembali
        </a>
    </div>
</form>

@endsection
