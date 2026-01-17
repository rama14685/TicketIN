<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .dark-bg {
                background: linear-gradient(135deg, #0f0f0f 0%, #1a1a1a 100%);
            }

            .minimal-card {
                background: rgba(255, 255, 255, 0.02);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.1);
            }

            .minimal-input {
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.1);
                color: #e5e7eb;
                transition: all 0.3s ease;
            }

            .minimal-input:focus {
                background: rgba(255, 255, 255, 0.1);
                border-color: rgba(255, 255, 255, 0.3);
                box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
            }

            .minimal-input::placeholder {
                color: rgba(255, 255, 255, 0.5);
            }

            .minimal-label {
                color: rgba(255, 255, 255, 0.9);
                font-weight: 500;
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

            .dark-gradient-text {
                background: linear-gradient(135deg, #e5e7eb 0%, #9ca3af 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
        </style>
    </head>
    <body class="font-sans antialiased dark-bg overflow-hidden">
        <div class="min-h-screen flex flex-col sm:justify-center items-center relative">
            <!-- Logo Section -->
            <div class="relative z-10 mb-8 mt-8">
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-16 h-16 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-lg flex items-center justify-center shadow-xl group-hover:scale-110 transition-transform duration-300">
                        <span class="text-white font-bold text-2xl">🎟</span>
                    </div>
                    <div>
                        <h1 class="text-3xl font-light dark-gradient-text">TicketIN</h1>
                        <p class="text-gray-400 text-sm">Platform Tiket Event Modern</p>
                    </div>
                </a>
            </div>

            <!-- Auth Card -->
            <div class="relative z-10 w-full sm:max-w-md px-6 py-8 minimal-card rounded-xl mx-4">
                {{ $slot }}
            </div>

            <!-- Back to Home -->
            <div class="relative z-10 mt-8">
                <a href="/" class="text-gray-400 hover:text-white transition-colors duration-300 flex items-center space-x-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </body>
</html>
