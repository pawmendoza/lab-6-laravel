<nav x-data="{ open: false }" class="bg-emerald-800 border-b border-emerald-900 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side: Logo & Navigation Links -->
            <div class="flex items-center space-x-6">
                <!-- Logo / Brand Name -->
                <div class="shrink-0 flex items-center space-x-2">
                    <div class="w-8 h-8 bg-white text-emerald-800 rounded-full flex items-center justify-center font-bold">M</div>
                    <a href="{{ route('dashboard') }}" class="font-bold text-lg text-white">
                        Mr. Mendoza Health Center
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:flex">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-emerald-900 text-white' : 'text-white hover:bg-emerald-700' }} px-3 py-2 rounded-md text-sm font-medium transition">
                        Dashboard
                    </a>
                    <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products*') ? 'bg-emerald-900 text-white' : 'text-white hover:bg-emerald-700' }} px-3 py-2 rounded-md text-sm font-medium transition">
                        Inventory List
                    </a>
                    <a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions*') ? 'bg-emerald-900 text-white' : 'text-white hover:bg-emerald-700' }} px-3 py-2 rounded-md text-sm font-medium transition">
                        Transactions
                    </a>
                </div>
            </div>

            <!-- Right Side: Notification Bell & User Profile Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:space-x-4">
                <!-- Notification Bell Dropdown -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="relative p-2 text-white bg-emerald-700 rounded-full hover:bg-emerald-600 focus:outline-none transition">
                                <!-- Bell Icon SVG -->
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2.032 2.032 0 01-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>

                                <!-- Unread Notification Badge Count -->
                                @if(auth()->user() && auth()->user()->unreadNotifications->count() > 0)
                                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-600 rounded-full">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                @endif
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400 font-semibold uppercase tracking-wider">
                                Low Stock Alerts
                            </div>

                            @forelse(auth()->user()->unreadNotifications as $notification)
                                <x-dropdown-link :href="route('products.index')">
                                    <div class="text-xs">
                                        <span class="font-bold text-gray-800">{{ $notification->data['name'] ?? 'Product' }}</span><br>
                                        <span class="text-gray-600">{{ $notification->data['message'] ?? 'Low stock alert' }}</span>
                                    </div>
                                </x-dropdown-link>
                            @empty
                                <div class="px-4 py-2 text-xs text-gray-500 text-center">
                                    No new low stock alerts.
                                </div>
                            @endforelse
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- User Profile Dropdown -->
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-emerald-700 hover:bg-emerald-600 focus:outline-none transition">
                                <div>{{ Auth::user()->name ?? 'Admin' }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l4 4a1 1 0 01-1.414 0L10 5.828 6.707 9.172a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication Logout -->
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
            </div>

            <!-- Hamburger Menu for Mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-emerald-200 hover:text-white hover:bg-emerald-700 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-emerald-900 px-4 pt-2 pb-3 space-y-1">
        <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-800">Dashboard</a>
        <a href="{{ route('products.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-800">Inventory List</a>
        <a href="{{ route('transactions.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-800">Transactions</a>
        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-800">Profile</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-emerald-800">
                Log Out
            </button>
        </form>
    </div>
</nav>