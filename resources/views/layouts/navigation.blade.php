<nav x-data="{ open: false }" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'bg-gray-900 border-b border-gray-800' : 'bg-white border-b border-gray-100' }}">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
<a href="{{ url('/') }}">
                        <x-application-logo class="block h-9 w-auto {{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'fill-current text-gray-200' : 'fill-current text-gray-800' }}" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @auth
                        <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:text-indigo-400' : '' }}">
                            Events
                        </x-nav-link>
                    @else
                        <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:text-indigo-400' : '' }}">
                            Events
                        </x-nav-link>
                    @endauth

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:text-indigo-400' : '' }}">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:text-indigo-400' : '' }}">
                                {{ __('Dashboard') }}
                            </x-nav-link>
                            <x-nav-link :href="route('history')" :active="request()->routeIs('history')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:text-indigo-400' : '' }}">
                                Riwayat
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md {{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 bg-gray-800 hover:text-indigo-400' : 'text-gray-500 bg-white hover:text-gray-700' }} focus:outline-none transition ease-in-out duration-150">
                            @auth
    <div class="flex items-center space-x-3">
        <span class="text-sm {{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200' : 'text-gray-700' }}">
            Halo, {{ Auth::user()->name }}
        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="text-sm text-red-500 hover:underline">
                Logout
            </button>
        </form>
    </div>
@endauth

@guest
    <div class="flex items-center space-x-4">
        <a href="{{ route('login') }}"
           class="text-sm text-gray-600 hover:text-indigo-600">
            Login
        </a>

        <a href="{{ route('register') }}"
           class="text-sm text-gray-600 hover:text-indigo-600">
            Register
        </a>
    </div>
@endguest


                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden {{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'bg-gray-900' : 'bg-white' }}">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:bg-gray-800' : '' }}">
                    Events
                </x-responsive-nav-link>
            @else
                <x-responsive-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:bg-gray-800' : '' }}">
                    Events
                </x-responsive-nav-link>
            @endauth

            @auth
                @if(Auth::user()->role === 'admin')
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:bg-gray-800' : '' }}">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:bg-gray-800' : '' }}">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('history')" :active="request()->routeIs('history')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:bg-gray-800' : '' }}">
                        Riwayat Pembelian
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
<div class="pt-4 pb-1 {{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'border-t border-gray-700' : 'border-t border-gray-200' }}">

    @auth
        <div class="px-4">
            <div class="font-medium text-base {{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200' : 'text-gray-800' }}">
                {{ Auth::user()->name }}
            </div>
            <div class="font-medium text-sm {{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-400' : 'text-gray-500' }}">
                {{ Auth::user()->email }}
            </div>
        </div>

        <div class="mt-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:bg-gray-800' : '' }}">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:bg-gray-800' : '' }}">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    @endauth

    @guest
        <div class="mt-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('login')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:bg-gray-800' : '' }}">
                Login
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('register')" class="{{ request()->routeIs('events.*') || request()->routeIs('cart.*') ? 'text-gray-200 hover:bg-gray-800' : '' }}">
                Register
            </x-responsive-nav-link>
        </div>
    @endguest

</div>

    </div>
</nav>
