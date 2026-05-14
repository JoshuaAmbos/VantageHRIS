<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'VantageHRIS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-vantage-bg text-vantage-900 flex h-screen overflow-hidden">

    <!-- Professional Sidebar using the deepest Navy Blue -->
    <aside class="w-72 bg-vantage-900 text-white flex-shrink-0 flex flex-col shadow-2xl z-20 relative">
        <!-- Brand Logo -->
        <div class="h-20 flex items-center px-8 border-b border-vantage-800">
            <div class="flex items-center space-x-3">
                <div class="w-9 h-9 bg-vantage-50 rounded-lg flex items-center justify-center shadow-inner">
                    <span class="text-vantage-900 font-bold text-lg">V</span>
                </div>
                <span class="text-2xl font-bold tracking-tight">Vantage<span class="text-vantage-50">HRIS</span></span>
            </div>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <p class="px-4 text-xs font-semibold text-vantage-400 uppercase tracking-wider mb-2">Main Menu</p>

            <!-- Dashboard Link -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-vantage-500 shadow-md text-white' : 'text-vantage-100/60 hover:bg-vantage-800 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 opacity-80 group-hover:opacity-100" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                <span class="font-medium">Dashboard</span>
            </a>

            <!-- Employees Link -->
            <a href="{{ route('employees.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('employees.*') ? 'bg-vantage-500 shadow-md text-white' : 'text-vantage-100/60 hover:bg-vantage-800 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 opacity-80 group-hover:opacity-100" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                <span class="font-medium">Employee Management</span>
            </a>

            <!-- Departments Link -->
            <a href="{{ route('departments.index') }}"
                class="flex items-center px-4 py-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('departments.*') ? 'bg-vantage-500 shadow-md text-white' : 'text-vantage-100/60 hover:bg-vantage-800 hover:text-white' }}">
                <svg class="w-5 h-5 mr-3 opacity-80 group-hover:opacity-100" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                <span class="font-medium">Department Hub</span>
            </a>
        </nav>

        <!-- Bottom User Section -->
        <div class="p-5 bg-vantage-900 border-t border-vantage-800">
            <div class="flex items-center space-x-3 mb-4">
                <div
                    class="w-10 h-10 rounded-full bg-vantage-50 text-vantage-900 flex items-center justify-center text-sm font-extrabold shadow-sm">
                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-sm font-semibold truncate text-white">{{ Auth::user()->name ?? 'User' }}</p>
                    <p class="text-xs text-vantage-300 font-medium">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center space-x-2 py-2 rounded-md bg-vantage-800 text-xs text-vantage-100 hover:bg-vantage-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    <span>Sign Out</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Workspace -->
    <div class="flex-1 flex flex-col min-w-0 bg-vantage-bg">
        <!-- Top Insight Bar -->
        <header
            class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-200 flex items-center px-8 justify-between shadow-sm z-10">
            <div class="flex items-center">
                <h2 class="text-xl font-bold text-vantage-900 tracking-tight">
                    {{ $header ?? 'Overview' }}
                </h2>
            </div>

            <div class="flex items-center space-x-6">
                <!-- Date/Time Display -->
                <div
                    class="hidden md:flex items-center text-sm font-medium text-vantage-900 bg-vantage-50/50 border border-vantage-300/50 px-4 py-2 rounded-full">
                    <svg class="w-4 h-4 mr-2 text-vantage-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ now()->format('l, F j, Y') }}
                </div>
            </div>
        </header>

        <!-- Scrollable Content View -->
        <main class="flex-1 overflow-y-auto p-8 lg:p-10">
            <div class="max-w-7xl mx-auto text-vantage-900">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>