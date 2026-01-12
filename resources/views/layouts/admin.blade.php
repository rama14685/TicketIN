<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
    
    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-900 text-white">
        <div class="p-6 text-xl font-bold">
            TicketIN
        </div>

        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}"
               class="block px-6 py-3 hover:bg-gray-700">
                Dashboard
            </a>

            <a href="{{ route('admin.events.index') }}"
               class="block px-6 py-3 hover:bg-gray-700">
                Events
            </a>

            <a href="{{ route('admin.kategori.index') }}"
               class="block px-6 py-3 hover:bg-gray-700">
                Kategori
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">
                @yield('header')
            </h1>
        </div>

        <div class="bg-white p-6 rounded shadow">
            @yield('content')
        </div>
    </main>

</div>

</body>
</html>
