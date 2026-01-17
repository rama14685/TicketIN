@extends('layouts.app')

@section('content')
@php
    $fullScreen = true;
@endphp


{{-- HERO --}}
<section class="min-h-screen flex items-center dark-bg text-gray-100">
    <div class="max-w-7xl mx-auto px-6 w-full">
        <div class="grid md:grid-cols-2 gap-12 items-center">

            {{-- TEXT --}}
            <div>
                <span class="inline-block mb-4 px-4 py-2 text-sm bg-indigo-500/20 text-indigo-300 rounded-full font-medium">
                    🎉 Temukan Event Terbaik
                </span>

                <h1 class="text-4xl md:text-5xl font-light leading-tight">
                    Jelajahi Event <br>
                    <span class="dark-gradient-text">Paling Seru</span> Minggu Ini
                </h1>

                <p class="mt-6 text-gray-300 max-w-lg text-lg">
                    Konser, festival, dan event komunitas terbaik.
                    Pesan tiket dengan cepat dan aman.
                </p>

                <a href="#event-list"
                   class="inline-block mt-8 accent-button px-8 py-4 rounded-xl font-semibold text-lg transition-all duration-300 hover:scale-105">
                    Lihat Event 🔥
                </a>
            </div>

            {{-- IMAGE --}}
            <div class="hidden md:block">
                <div class="minimal-card rounded-2xl p-8 shadow-2xl">
                    <img src="{{ asset('media/konser.jpg') }}"
                         class="rounded-xl shadow-xl max-h-[420px] object-cover w-full"
                         alt="Event">
                </div>
            </div>

        </div>
    </div>
</section>

{{-- EVENT LIST --}}
<section id="event-list" class="dark-bg text-gray-100">
    <div class="max-w-7xl mx-auto px-6 py-20">

        {{-- FILTERS --}}
        <div class="mb-12">
            <div class="minimal-card rounded-xl p-6">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    <h3 class="text-xl font-medium text-gray-200">Filter Event</h3>

                    <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                        {{-- Search --}}
                        <form method="GET" action="{{ route('events.index') }}" class="flex-1 md:w-80">
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}"
                                       placeholder="Cari event..."
                                       class="w-full minimal-input rounded-lg px-4 py-3 pl-10 focus:outline-none focus:ring-0">
                                <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </form>

                        {{-- Category Filter --}}
                        <form method="GET" action="{{ route('events.index') }}" class="flex gap-2">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <select name="kategori" onchange="this.form.submit()"
                                    class="minimal-input rounded-lg px-4 py-3 focus:outline-none focus:ring-0 min-w-[150px]">
                                <option value="">Semua Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>

                            @if(request('kategori') || request('search'))
                                <a href="{{ route('events.index') }}"
                                   class="minimal-button px-4 py-3 rounded-lg hover:bg-white/10 transition-colors">
                                    Reset
                                </a>
                            @endif
                        </form>
                    </div>
                </div>

                {{-- Active Filters --}}
                @if(request('kategori') || request('search'))
                    <div class="mt-4 flex flex-wrap gap-2">
                        @if(request('search'))
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-500/20 text-indigo-300">
                                Search: "{{ request('search') }}"
                                <a href="{{ route('events.index', ['kategori' => request('kategori')]) }}" class="ml-2 text-indigo-400 hover:text-indigo-200">×</a>
                            </span>
                        @endif
                        @if(request('kategori'))
                            @php
                                $selectedKategori = $kategoris->find(request('kategori'));
                            @endphp
                            @if($selectedKategori)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-500/20 text-purple-300">
                                    Kategori: {{ $selectedKategori->nama }}
                                    <a href="{{ route('events.index', ['search' => request('search')]) }}" class="ml-2 text-purple-400 hover:text-purple-200">×</a>
                                </span>
                            @endif
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-light dark-gradient-text mb-4">
                🎫 Event Tersedia
            </h2>
            <p class="text-gray-400 max-w-2xl mx-auto">
                Temukan berbagai event menarik dan pesan tiket Anda sekarang juga
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse ($events as $event)
                <div class="minimal-card rounded-2xl overflow-hidden hover:scale-[1.02] transition-all duration-300 shadow-xl group">

                    {{-- IMAGE --}}
                    <div class="h-48 bg-slate-800 overflow-hidden">
                        @if($event->gambar)
                            <img src="{{ asset('storage/' . $event->gambar) }}"
                                 alt="{{ $event->judul }}"
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <div class="text-center">
                                    <div class="text-4xl mb-2">🎪</div>
                                    <span class="text-gray-500 text-sm">Event Image</span>
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- CONTENT --}}
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs px-3 py-1 bg-indigo-500/20 text-indigo-300 rounded-full font-medium">
                                {{ $event->kategori->nama ?? 'Event' }}
                            </span>

                            <span class="text-xs text-gray-400">
                                {{ \Carbon\Carbon::parse($event->tanggal_waktu)->format('d M Y') }}
                            </span>
                        </div>

                        <h3 class="text-lg font-semibold text-gray-100 mb-2 line-clamp-2">
                            {{ $event->judul }}
                        </h3>

                        <p class="text-sm text-gray-400 line-clamp-2 mb-4">
                            {{ Str::limit($event->deskripsi ?? 'Event seru yang wajib kamu datangi.', 80) }}
                        </p>

                        <div class="flex items-center justify-between">
                            <div class="flex flex-col">
                                <span class="text-xs text-gray-500">Mulai dari</span>
                                <span class="text-indigo-400 font-semibold">
                                    Rp {{ number_format($event->tikets->min('harga') ?? 0) }}
                                </span>
                            </div>

                            <a href="{{ route('events.show', $event->id) }}"
                               class="accent-button px-4 py-2 rounded-lg text-sm font-medium transition-all duration-300 hover:scale-105">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16">
                    <div class="text-6xl mb-4">🎭</div>
                    <h3 class="text-xl font-light text-gray-400 mb-2">Belum ada event tersedia</h3>
                    <p class="text-gray-500">Event menarik akan segera hadir. Stay tuned!</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection
