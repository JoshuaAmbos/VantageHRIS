<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'VantageHRIS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="font-sans antialiased bg-slate-50 text-slate-900 h-full flex overflow-hidden selection:bg-vantage-500 selection:text-white">

    <!-- Premium Sidebar Context Container -->
    <aside class="w-64 bg-slate-900 text-slate-200 flex-shrink-0 flex flex-col border-r border-slate-800 z-20 relative">

        <!-- Brand Identity Container -->
        <div class="h-16 flex items-center px-6 border-b border-slate-800 bg-slate-950/40">
            <div class="flex items-center space-x-2.5">
                <div
                    class="w-8 h-8 bg-gradient-to-br from-vantage-400 to-vantage-600 rounded-lg flex items-center justify-center shadow-lg shadow-vantage-900/40">
                    <span class="text-white font-extrabold text-base tracking-tighter">V</span>
                </div>
                <span class="text-lg font-bold tracking-tight text-white">
                    Vantage<span class="text-vantage-400 font-medium">HRIS</span>
                </span>
            </div>
        </div>

        <!-- Scrollable Navigation Matrix -->
        <nav class="flex-1 px-3 py-4 space-y-0.5 overflow-y-auto custom-scrollbar">
            <p class="px-3 text-[10px] font-bold text-slate-500 uppercase tracking-widest mb-3">Workspace</p>

            <!-- Dashboard Node -->
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-150 group relative {{ request()->routeIs('dashboard') ? 'bg-slate-800 text-white font-medium' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                @if(request()->routeIs('dashboard'))
                    <span class="absolute left-0 top-2.5 bottom-2.5 w-1 bg-vantage-500 rounded-r"></span>
                @endif
                <svg class="w-[18px] h-[18px] mr-3 transition-colors {{ request()->routeIs('dashboard') ? 'text-vantage-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                    </path>
                </svg>
                <span class="text-sm">Dashboard</span>
            </a>

            <!-- Employees Node -->
            <a href="{{ route('employees.index') }}"
                class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-150 group relative {{ request()->routeIs('employees.*') ? 'bg-slate-800 text-white font-medium' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                @if(request()->routeIs('employees.*'))
                    <span class="absolute left-0 top-2.5 bottom-2.5 w-1 bg-vantage-500 rounded-r"></span>
                @endif
                <svg class="w-[18px] h-[18px] mr-3 transition-colors {{ request()->routeIs('employees.*') ? 'text-vantage-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                    </path>
                </svg>
                <span class="text-sm">Employees</span>
            </a>

            <!-- Departments Node -->
            <a href="{{ route('departments.index') }}"
                class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-150 group relative {{ request()->routeIs('departments.*') ? 'bg-slate-800 text-white font-medium' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                @if(request()->routeIs('departments.*'))
                    <span class="absolute left-0 top-2.5 bottom-2.5 w-1 bg-vantage-500 rounded-r"></span>
                @endif
                <svg class="w-[18px] h-[18px] mr-3 transition-colors {{ request()->routeIs('departments.*') ? 'text-vantage-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                <span class="text-sm">Departments</span>
            </a>

            <!-- Attendances Node -->
            <a href="{{ route('attendances.index') }}"
                class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-150 group relative {{ request()->routeIs('attendances.*') ? 'bg-slate-800 text-white font-medium' : 'text-slate-400 hover:bg-slate-800/60 hover:text-slate-200' }}">
                @if(request()->routeIs('attendances.*'))
                    <span class="absolute left-0 top-2.5 bottom-2.5 w-1 bg-vantage-500 rounded-r"></span>
                @endif
                <svg class="w-[18px] h-[18px] mr-3 transition-colors {{ request()->routeIs('attendances.*') ? 'text-vantage-400' : 'text-slate-500 group-hover:text-slate-300' }}"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                </svg>
                <span class="text-sm">Attendances</span>
            </a>
        </nav>

        <!-- FIXED: Re-engineered Profile Footer Pane with Split Inline Utilities -->
        <div class="p-4 bg-slate-950/30 border-t border-slate-800/60 flex flex-col space-y-3">

            <!-- User Info Details Card Row -->
            <div class="flex items-center space-x-3 px-1">
                <div
                    class="w-9 h-9 rounded-full bg-slate-800 border border-slate-700 text-slate-200 flex items-center justify-center text-xs font-bold ring-2 ring-slate-900">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-xs font-semibold truncate text-slate-100 leading-none mb-1">
                        {{ Auth::user()->name ?? 'Administrator' }}
                    </p>
                    <p class="text-[10px] text-slate-500 font-medium tracking-wide">System Admin</p>
                </div>
            </div>

            <!-- Action Button Split Utility Row -->
            <div class="grid grid-cols-2 gap-2">
                <!-- Profile Link Button -->
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center justify-center space-x-1.5 py-2 rounded-md bg-slate-800/40 text-[11px] font-medium text-slate-400 hover:bg-slate-800 hover:text-slate-200 border border-slate-800/80 hover:border-slate-700 transition-all duration-150 text-center">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Settings</span>
                </a>

                <!-- Sign Out POST Form Button -->
                <form method="POST" action="{{ route('logout') }}" class="inline-block">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center space-x-1.5 py-2 rounded-md bg-slate-800/40 text-[11px] font-medium text-slate-400 hover:bg-red-950/40 hover:text-red-400 border border-slate-800/80 hover:border-red-900/40 transition-all duration-150 cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Workspace Surface -->
    <div class="flex-1 flex flex-col min-w-0 bg-slate-50">

        <!-- Shared Header Workspace Bar -->
        <header
            class="h-16 bg-white border-b border-slate-200/80 flex items-center px-8 justify-between relative z-10 shadow-xs">
            <div class="flex items-center">
                <h2 class="text-base font-bold text-slate-900 tracking-tight">
                    {{ $header ?? 'Overview' }}
                </h2>
            </div>

            <!-- Contextual Operations Pane -->
            <div class="flex items-center space-x-4">
                <div
                    class="hidden sm:flex items-center text-xs font-semibold text-slate-600 bg-slate-100 border border-slate-200 px-3 py-1.5 rounded-md shadow-xs">
                    <svg class="w-3.5 h-3.5 mr-1.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ now()->format('D, M j, Y') }}
                </div>
            </div>
        </header>

        <!-- Viewport Scrollable Execution Engine Slot -->
        <main class="flex-1 overflow-y-auto p-8 bg-slate-50/50">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>