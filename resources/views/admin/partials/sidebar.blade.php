<aside class="w-64 admin-sidebar shadow-xl">
    <div class="p-6 border-b border-white/10">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center">
                <span class="text-white font-bold text-lg">T</span>
            </div>
            <div>
                <h1 class="text-xl font-bold dark-gradient-text">TicketIN</h1>
                <p class="text-xs text-gray-400">Admin Panel</p>
            </div>
        </div>
    </div>

    <nav class="p-4 space-y-2">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-300
           {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
            </svg>
            <span class="font-medium">Dashboard</span>
        </a>

        <a href="{{ route('admin.events.index') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-300
           {{ request()->routeIs('admin.events.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span class="font-medium">Kelola Event</span>
        </a>

        <a href="{{ route('admin.kategori.index') }}"
           class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-300
           {{ request()->routeIs('admin.kategori.*') ? 'bg-indigo-600/20 text-indigo-300 border border-indigo-500/30' : 'text-gray-300 hover:bg-white/5 hover:text-white' }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
            </svg>
            <span class="font-medium">Kategori</span>
        </a>

        <div class="pt-8 border-t border-white/10">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center space-x-3 px-4 py-3 text-red-400 hover:bg-red-500/10 hover:text-red-300 rounded-lg transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                    </svg>
                    <span class="font-medium">Logout</span>
                </button>
            </form>
        </div>
    </nav>
</aside>
