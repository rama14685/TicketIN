<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TicketIN — Platform Tiket Event Modern</title>
    @vite('resources/css/app.css')
    <style>
        .dark-bg {
            background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
        }

        .dark-gradient-text {
            background: linear-gradient(135deg, #e5e7eb 0%, #9ca3af 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .minimal-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .minimal-button {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #e5e7eb;
            transition: all 0.3s ease;
        }

        .minimal-button:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.2);
            transform: translateY(-1px);
        }

        .accent-button {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            color: white;
            transition: all 0.3s ease;
        }

        .accent-button:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(99, 102, 241, 0.3);
        }

        /* Slideshow Styles - Minimal Version */
        .slideshow-container {
            position: relative;
            width: 100%;
            height: 400px;
            background: rgba(255, 255, 255, 0.02);
            border-radius: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.6s ease;
        }

        .slide.active {
            opacity: 1;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 1rem;
        }

        .dot {
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .dot.active {
            background-color: #e5e7eb !important;
            transform: scale(1.1);
        }

        .prev, .next {
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .prev:hover, .next:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
        }

        /* Subtle animations */
        .fade-in {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stats-number {
            color: #9ca3af;
            font-weight: 300;
        }
    </style>
</head>

<body class="bg-black text-gray-100 overflow-x-hidden">

<!-- ================= MINIMAL DARK NAVBAR ================= -->
<nav class="bg-black/80 backdrop-blur-xl border-b border-white/10 fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">🎟</span>
            </div>
            <h1 class="text-2xl font-light dark-gradient-text">
                TicketIN
            </h1>
        </div>

        <div class="flex items-center space-x-6">
            @auth
                <a href="{{ route('admin.dashboard') }}"
                   class="px-6 py-2.5 accent-button rounded-lg font-medium">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="text-gray-400 hover:text-white font-medium transition-colors duration-300">
                    Masuk
                </a>
                <a href="{{ route('register') }}"
                   class="px-6 py-2.5 accent-button rounded-lg font-medium">
                    Daftar
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- ================= HERO SECTION ================= -->
<section class="relative min-h-screen flex items-center dark-bg">
    <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-black opacity-90"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-32">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- TEXT CONTENT -->
            <div class="text-white space-y-8 fade-in">
                <div class="space-y-4">
                    <div class="inline-flex items-center px-4 py-2 minimal-card rounded-full text-sm font-medium">
                        Platform Tiket Event Modern
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-light leading-tight">
                        Temukan Event
                        <br>
                        <span class="dark-gradient-text">Terbaik</span> Anda
                    </h1>
                </div>

                <p class="text-lg text-gray-400 max-w-lg leading-relaxed">
                    Platform modern untuk menemukan dan membeli tiket event impian Anda. Dari konser hingga festival, semua dalam satu tempat.
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('events.index') }}"
                       class="group px-8 py-4 accent-button rounded-lg font-medium flex items-center justify-center space-x-2">
                        <span>Lihat Event</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </a>
                    <a href="#features"
                       class="px-8 py-4 minimal-button rounded-lg font-medium">
                        Pelajari Lebih Lanjut
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 pt-8 border-t border-white/10">
                    <div class="text-center">
                        <div class="stats-number text-2xl font-light">500+</div>
                        <div class="text-sm text-gray-500">Event Berhasil</div>
                    </div>
                    <div class="text-center">
                        <div class="stats-number text-2xl font-light">50K+</div>
                        <div class="text-sm text-gray-500">Tiket Terjual</div>
                    </div>
                    <div class="text-center">
                        <div class="stats-number text-2xl font-light">10K+</div>
                        <div class="text-sm text-gray-500">User Aktif</div>
                    </div>
                </div>
            </div>

            <!-- HERO IMAGE SLIDESHOW -->
            <div class="relative fade-in">
                <div class="relative z-10">
                    <!-- Slideshow Container -->
                    <div class="slideshow-container relative overflow-hidden rounded-xl shadow-2xl">
                        <div class="slide active">
                            <img src="{{ asset('media/konser.jpg') }}"
                                 alt="Live Concert Experience"
                                 class="w-full h-auto object-cover transition-opacity duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-xl"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-xl font-light mb-1">Konser Musik</h3>
                                <p class="text-sm text-gray-300">Rasakan energi live music</p>
                            </div>
                        </div>
                        <div class="slide">
                            <img src="{{ asset('media/lari.jpg') }}"
                                 alt="Running Event Experience"
                                 class="w-full h-auto object-cover transition-opacity duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent rounded-xl"></div>
                            <div class="absolute bottom-6 left-6 text-white">
                                <h3 class="text-xl font-light mb-1">Event Lari</h3>
                                <p class="text-sm text-gray-300">Tantang batas dirimu</p>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Dots -->
                    <div class="flex justify-center space-x-3 mt-6">
                        <button class="dot active w-2.5 h-2.5 bg-gray-600 rounded-full hover:bg-gray-400 transition-colors duration-300" data-slide="0"></button>
                        <button class="dot w-2.5 h-2.5 bg-gray-600 rounded-full hover:bg-gray-400 transition-colors duration-300" data-slide="1"></button>
                    </div>

                    <!-- Navigation Arrows -->
                    <button class="prev absolute left-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-black/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-black/40 transition-colors duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button class="next absolute right-4 top-1/2 transform -translate-y-1/2 w-10 h-10 bg-black/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-black/40 transition-colors duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

                <!-- Floating Cards - Minimal Version -->
                <div class="absolute -top-8 -left-8 minimal-card rounded-xl p-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-green-500/20 rounded-lg flex items-center justify-center">
                            <span class="text-green-400 text-sm">✓</span>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-300">Tiket Aman</div>
                            <div class="text-xs text-gray-500">100% Secure</div>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-8 -left-8 minimal-card rounded-xl p-4">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-500/20 rounded-lg flex items-center justify-center">
                            <span class="text-blue-400 text-sm">⚡</span>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-300">Instant Booking</div>
                            <div class="text-xs text-gray-500">Dalam Detik</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ================= FEATURES ================= -->
<section id="features" class="py-32 bg-gray-900 relative">
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 to-black"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center mb-20">
            <div class="inline-flex items-center px-4 py-2 minimal-card rounded-full text-sm font-medium text-gray-300 mb-4">
                Kenapa Pilih TicketIN?
            </div>
            <h2 class="text-4xl font-light mb-6 dark-gradient-text">
                Lebih Dari Sekadar Beli Tiket
            </h2>
            <p class="text-lg text-gray-400 max-w-3xl mx-auto">
                Kami membuat pengalaman mendapatkan tiket event menjadi sederhana, cepat, dan aman.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-20">
            <!-- Feature 1 -->
            <div class="group minimal-card rounded-xl p-8 hover:bg-white/5 transition-all duration-500">
                <div class="w-16 h-16 bg-gradient-to-r from-indigo-500/20 to-purple-500/20 rounded-lg flex items-center justify-center mb-6 group-hover:scale-105 transition-transform duration-300">
                    <span class="text-2xl text-indigo-400">⚡</span>
                </div>
                <h3 class="text-xl font-light mb-4 text-gray-200">Booking Kilat</h3>
                <p class="text-gray-400 leading-relaxed">
                    Dapatkan tiket dalam hitungan detik dengan proses yang super cepat dan efisien.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="group minimal-card rounded-xl p-8 hover:bg-white/5 transition-all duration-500">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500/20 to-teal-500/20 rounded-lg flex items-center justify-center mb-6 group-hover:scale-105 transition-transform duration-300">
                    <span class="text-2xl text-green-400">🔐</span>
                </div>
                <h3 class="text-xl font-light mb-4 text-gray-200">100% Aman</h3>
                <p class="text-gray-400 leading-relaxed">
                    Sistem keamanan tingkat enterprise dengan enkripsi end-to-end dan tiket digital anti-palsu.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="group minimal-card rounded-xl p-8 hover:bg-white/5 transition-all duration-500">
                <div class="w-16 h-16 bg-gradient-to-r from-orange-500/20 to-red-500/20 rounded-lg flex items-center justify-center mb-6 group-hover:scale-105 transition-transform duration-300">
                    <span class="text-2xl text-orange-400">🎪</span>
                </div>
                <h3 class="text-xl font-light mb-4 text-gray-200">Event Terbaik</h3>
                <p class="text-gray-400 leading-relaxed">
                    Koleksi event dari artis top, festival musik, hingga pertunjukan spektakuler dalam satu platform.
                </p>
            </div>
        </div>

        <!-- Additional Features Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="text-center p-6 minimal-card rounded-xl">
                <div class="text-3xl mb-2 text-blue-400">📱</div>
                <div class="font-medium text-gray-200">Mobile First</div>
                <div class="text-sm text-gray-500">Beli dari HP kapan saja</div>
            </div>
            <div class="text-center p-6 minimal-card rounded-xl">
                <div class="text-3xl mb-2">🎫</div>
                <div class="font-semibold text-gray-900">E-Ticket</div>
                <div class="text-sm text-gray-600">Tiket digital instan</div>
            </div>
            <div class="text-center p-6 minimal-card rounded-xl">
                <div class="text-3xl mb-2 text-purple-400">💳</div>
                <div class="font-medium text-gray-200">Multi Payment</div>
                <div class="text-sm text-gray-500">Beragam metode bayar</div>
            </div>
            <div class="text-center p-6 minimal-card rounded-xl">
                <div class="text-3xl mb-2 text-green-400">🎉</div>
                <div class="font-medium text-gray-200">24/7 Support</div>
                <div class="text-sm text-gray-500">Bantuan kapan saja</div>
            </div>
        </div>
    </div>
</section>

<!-- ================= SOCIAL PROOF ================= -->
<section class="py-32 bg-black text-gray-100 relative">
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-light mb-4 dark-gradient-text">
                Apa Kata Mereka?
            </h2>
            <p class="text-lg text-gray-400">
                Ribuan orang sudah merasakan pengalaman bersama TicketIN
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Testimonial 1 -->
            <div class="minimal-card rounded-xl p-8 hover:bg-white/5 transition-all duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500/20 to-purple-500/20 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-indigo-400 font-medium">A</span>
                    </div>
                    <div>
                        <div class="font-medium text-gray-200">Ahmad Rahman</div>
                        <div class="text-sm text-gray-500">Music Lover</div>
                    </div>
                </div>
                <div class="flex text-yellow-400 mb-4">
                    ★★★★★
                </div>
                <p class="text-gray-400">
                    "Beli tiket Coldplay concert cuma 2 menit. Gak ribet dan langsung dapat e-ticket. TicketIN emang top banget!"
                </p>
            </div>

            <!-- Testimonial 2 -->
            <div class="minimal-card rounded-xl p-8 hover:bg-white/5 transition-all duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-500/20 to-pink-500/20 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-purple-400 font-medium">S</span>
                    </div>
                    <div>
                        <div class="font-medium text-gray-200">Sari Dewi</div>
                        <div class="text-sm text-gray-500">Festival Enthusiast</div>
                    </div>
                </div>
                <div class="flex text-yellow-400 mb-4">
                    ★★★★★
                </div>
                <p class="text-gray-400">
                    "Festival Jazz gunung hampir kehabisan, untung TicketIN ada! Booking dari rumah langsung dapat. Love it!"
                </p>
            </div>

            <!-- Testimonial 3 -->
            <div class="minimal-card rounded-xl p-8 hover:bg-white/5 transition-all duration-300">
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-500/20 to-blue-500/20 rounded-lg flex items-center justify-center mr-4">
                        <span class="text-green-400 font-medium">R</span>
                    </div>
                    <div>
                        <div class="font-medium text-gray-200">Rizky Pratama</div>
                        <div class="text-sm text-gray-500">Event Organizer</div>
                    </div>
                </div>
                <div class="flex text-yellow-400 mb-4">
                    ★★★★★
                </div>
                <p class="text-gray-400">
                    "Sebagai EO, TicketIN bantu banget manage penjualan tiket. Dashboard-nya user friendly dan laporan lengkap!"
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ================= CTA SECTION ================= -->
<section class="py-32 bg-gradient-to-br from-gray-900 to-black text-gray-100 relative">
    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center">
        <div class="mb-8">
            <h2 class="text-4xl font-light mb-6 leading-tight dark-gradient-text">
                Siap Mulai Petualangan Event Anda?
            </h2>
            <p class="text-lg text-gray-400 mb-12 leading-relaxed">
                Bergabunglah dengan ribuan pengguna yang telah menemukan event impian mereka bersama TicketIN.
                Daftar sekarang dan dapatkan akses eksklusif ke event-event terbaik.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
            <a href="{{ route('register') }}"
               class="group px-8 py-4 accent-button rounded-lg font-medium flex items-center space-x-2">
                <span>Daftar Sekarang</span>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>

            <a href="{{ route('events.index') }}"
               class="px-8 py-4 minimal-button rounded-lg font-medium">
                Jelajahi Event
            </a>
        </div>

        <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-2xl mb-2 text-indigo-400">🎪</div>
                <div class="text-gray-400 text-sm">Event Berkualitas</div>
            </div>
            <div>
                <div class="text-2xl mb-2 text-purple-400">⚡</div>
                <div class="text-gray-400 text-sm">Proses Kilat</div>
            </div>
            <div>
                <div class="text-2xl mb-2 text-green-400">🔒</div>
                <div class="text-gray-400 text-sm">100% Aman</div>
            </div>
            <div>
                <div class="text-2xl mb-2 text-orange-400">🎉</div>
                <div class="text-gray-400 text-sm">Pengalaman Seru</div>
            </div>
        </div>
    </div>
</section>

<!-- ================= MINIMAL FOOTER ================= -->
<footer class="bg-black text-gray-100 py-16 border-t border-white/10">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-8 mb-12">
            <!-- Brand -->
            <div class="md:col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-xl">🎟</span>
                    </div>
                    <h3 class="text-2xl font-light dark-gradient-text">TicketIN</h3>
                </div>
                <p class="text-gray-400 mb-6 max-w-md leading-relaxed">
                    Platform tiket event modern yang menghubungkan Anda dengan pengalaman live terbaik.
                    Dari konser hingga festival, kami siap membuat momen unforgettable.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 minimal-card rounded-lg flex items-center justify-center hover:bg-white/10 transition-colors">
                        <span class="text-lg">📘</span>
                    </a>
                    <a href="#" class="w-10 h-10 minimal-card rounded-lg flex items-center justify-center hover:bg-white/10 transition-colors">
                        <span class="text-lg">📷</span>
                    </a>
                    <a href="#" class="w-10 h-10 minimal-card rounded-lg flex items-center justify-center hover:bg-white/10 transition-colors">
                        <span class="text-lg">🐦</span>
                    </a>
                    <a href="#" class="w-10 h-10 minimal-card rounded-lg flex items-center justify-center hover:bg-white/10 transition-colors">
                        <span class="text-lg">🎵</span>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-medium mb-6 text-gray-200">Platform</h4>
                <ul class="space-y-3 text-gray-500">
                    <li><a href="{{ route('events.index') }}" class="hover:text-gray-300 transition-colors">Cari Event</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition-colors">Cara Beli Tiket</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition-colors">Hubungi Kami</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition-colors">FAQ</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 class="text-lg font-medium mb-6 text-gray-200">Dukungan</h4>
                <ul class="space-y-3 text-gray-500">
                    <li><a href="#" class="hover:text-gray-300 transition-colors">Pusat Bantuan</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition-colors">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition-colors">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-gray-300 transition-colors">Karir</a></li>
                </ul>
            </div>
        </div>

        <!-- Newsletter -->
        <div class="minimal-card rounded-xl p-8 mb-8">
            <div class="text-center">
                <h4 class="text-xl font-medium mb-4 text-gray-200">Tetap Update Event Terbaru</h4>
                <p class="text-gray-400 mb-6">Dapatkan info event eksklusif dan diskon spesial langsung di inbox Anda</p>
                <div class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                    <input type="email" placeholder="Masukkan email Anda..." class="flex-1 px-4 py-3 minimal-card rounded-lg text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    <button class="px-6 py-3 accent-button rounded-lg font-medium">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>

        <!-- Bottom -->
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center">
            <div class="text-gray-500 text-sm mb-4 md:mb-0">
                © {{ date('Y') }} TicketIN. Made with ❤️ for event lovers everywhere.
            </div>
            <div class="flex items-center space-x-6 text-sm text-gray-500">
                <span>🔒 SSL Secured</span>
                <span>⚡ Powered by Laravel</span>
                <span>🎨 Designed for Modern Users</span>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button id="scrollToTop" class="fixed bottom-8 right-8 w-12 h-12 accent-button rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 opacity-0 invisible">
    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>
    <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>

<script>
    // Scroll to Top functionality
    const scrollToTopBtn = document.getElementById('scrollToTop');

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.remove('opacity-0', 'invisible');
            scrollToTopBtn.classList.add('opacity-100', 'visible');
        } else {
            scrollToTopBtn.classList.remove('opacity-100', 'visible');
            scrollToTopBtn.classList.add('opacity-0', 'invisible');
        }
    });

    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Slideshow functionality
    class Slideshow {
        constructor() {
            this.slides = document.querySelectorAll('.slide');
            this.dots = document.querySelectorAll('.dot');
            this.prevBtn = document.querySelector('.prev');
            this.nextBtn = document.querySelector('.next');
            this.loadingIndicator = document.querySelector('.loading-indicator');
            this.currentSlide = 0;
            this.slideInterval = null;
            this.autoPlayDelay = 2000; // 2 seconds
            this.isPaused = false;

            this.init();
        }

        init() {
            this.showSlide(0);
            this.preloadImages();
            this.startAutoPlay();
            this.addEventListeners();
        }

        preloadImages() {
            const images = document.querySelectorAll('.slide img');
            let loadedCount = 0;

            images.forEach(img => {
                if (img.complete) {
                    loadedCount++;
                    img.classList.remove('loading');
                    img.classList.add('loaded');
                } else {
                    img.addEventListener('load', () => {
                        loadedCount++;
                        img.classList.remove('loading');
                        img.classList.add('loaded');

                        if (loadedCount === images.length) {
                            this.hideLoadingIndicator();
                        }
                    });

                    img.addEventListener('error', () => {
                        console.error('Failed to load image:', img.src);
                        loadedCount++;
                        if (loadedCount === images.length) {
                            this.hideLoadingIndicator();
                        }
                    });
                }
            });

            if (loadedCount === images.length) {
                this.hideLoadingIndicator();
            }
        }

        hideLoadingIndicator() {
            setTimeout(() => {
                this.loadingIndicator.style.opacity = '0';
                setTimeout(() => {
                    this.loadingIndicator.style.display = 'none';
                }, 300);
            }, 500);
        }

        showSlide(index) {
            // Hide all slides
            this.slides.forEach(slide => slide.classList.remove('active'));
            this.dots.forEach(dot => dot.classList.remove('active'));

            // Show current slide
            this.slides[index].classList.add('active');
            this.dots[index].classList.add('active');

            this.currentSlide = index;
        }

        nextSlide() {
            if (this.isPaused) return;
            const nextIndex = (this.currentSlide + 1) % this.slides.length;
            this.showSlide(nextIndex);
        }

        prevSlide() {
            if (this.isPaused) return;
            const prevIndex = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
            this.showSlide(prevIndex);
        }

        goToSlide(index) {
            this.showSlide(index);
        }

        startAutoPlay() {
            this.slideInterval = setInterval(() => {
                if (!this.isPaused) {
                    this.nextSlide();
                }
            }, this.autoPlayDelay);
        }

        stopAutoPlay() {
            if (this.slideInterval) {
                clearInterval(this.slideInterval);
                this.slideInterval = null;
            }
        }

        pause() {
            this.isPaused = true;
        }

        resume() {
            this.isPaused = false;
        }

        resetAutoPlay() {
            this.stopAutoPlay();
            this.startAutoPlay();
        }

        addEventListeners() {
            // Dot navigation
            this.dots.forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    this.goToSlide(index);
                    this.resetAutoPlay();
                });
            });

            // Arrow navigation
            this.prevBtn.addEventListener('click', () => {
                this.prevSlide();
                this.resetAutoPlay();
            });

            this.nextBtn.addEventListener('click', () => {
                this.nextSlide();
                this.resetAutoPlay();
            });

            // Pause on hover
            const slideshowContainer = document.querySelector('.slideshow-container');
            slideshowContainer.addEventListener('mouseenter', () => {
                this.pause();
            });

            slideshowContainer.addEventListener('mouseleave', () => {
                this.resume();
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (e.key === 'ArrowLeft') {
                    e.preventDefault();
                    this.prevSlide();
                    this.resetAutoPlay();
                } else if (e.key === 'ArrowRight') {
                    e.preventDefault();
                    this.nextSlide();
                    this.resetAutoPlay();
                }
            });

            // Touch/swipe support for mobile
            let startX = 0;
            let endX = 0;

            slideshowContainer.addEventListener('touchstart', (e) => {
                startX = e.touches[0].clientX;
            });

            slideshowContainer.addEventListener('touchend', (e) => {
                endX = e.changedTouches[0].clientX;
                const diff = startX - endX;

                if (Math.abs(diff) > 50) { // Minimum swipe distance
                    if (diff > 0) {
                        this.nextSlide();
                    } else {
                        this.prevSlide();
                    }
                    this.resetAutoPlay();
                }
            });
        }
    }

    // Initialize slideshow when DOM is loaded
    document.addEventListener('DOMContentLoaded', () => {
        new Slideshow();
    });
</script>

</body>
</html>
