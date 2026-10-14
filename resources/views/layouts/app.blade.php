<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mr. Mendoza Health Center') }}</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900">
    <div class="min-h-screen bg-gray-100">
        
        <nav class="bg-emerald-900 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center text-white font-bold text-lg">
                            <span class="bg-white text-emerald-900 px-2.5 py-1 rounded font-bold mr-2 shadow">M</span> 
                            Mr. Mendoza Health Center
                        </div>

                        <div class="flex space-x-2">
                            <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-emerald-950 text-white shadow-inner' : 'text-emerald-100 hover:bg-emerald-800' }} transition">
                                Dashboard
                            </a>
                            <a href="{{ route('products.index') }}" class="px-3 py-1.5 rounded-md text-sm font-medium {{ request()->routeIs('products.*') ? 'bg-emerald-950 text-white shadow-inner' : 'text-emerald-100 hover:bg-emerald-800' }} transition">
                                Inventory List
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <span class="text-white text-sm font-medium">{{ Auth::user()->name ?? 'Almen Admin' }}</span>
                        
                        <!-- Logout Form -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-emerald-800 hover:bg-emerald-700 text-white text-xs font-bold px-3 py-1.5 rounded transition shadow-sm">
                                Log Out
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </nav>

        <main class="py-6">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>