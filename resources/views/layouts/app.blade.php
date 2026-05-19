<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-[#f8fafc]">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'VantageHRIS') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body x-data="{ mobileMenuOpen: false }"
    class="font-sans antialiased bg-[#f8fafc] text-[#081a2b] h-full flex overflow-hidden selection:bg-[#2982d6] selection:text-white">

    <div x-show="mobileMenuOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="mobileMenuOpen = false"
        class="fixed inset-0 bg-[#06121e]/60 z-40 lg:hidden" style="display: none;"></div>

    <aside :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 w-64 bg-white flex flex-col lg:static lg:flex-shrink-0 transform transition-transform duration-300 ease-in-out z-50">

        <div class="h-16 flex items-center justify-between px-6 border-b border-[#e2e8f0]">
            <div class="flex items-center space-x-2.5">
                <div class="w-9 h-9 bg-[#2982d6] rounded-lg flex items-center justify-center shadow-sm">
                    <span class="text-white font-extrabold text-lg tracking-tighter">V</span>
                </div>
                <span class="text-xl font-bold tracking-tight text-[#081a2b]">
                    Vantage<span class="text-[#2982d6] font-bold">HRIS</span>
                </span>
            </div>

            <button @click="mobileMenuOpen = false"
                class="lg:hidden p-1 rounded-md text-[#2168ab] hover:text-[#103456] focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto custom-scrollbar">
            <a href="{{ route('dashboard') }}"
                class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-150 group {{ request()->routeIs('dashboard') ? 'bg-[#eaf3fb] text-[#103456] font-semibold' : 'text-[#2168ab] hover:bg-[#f8fafc] hover:text-[#184e81]' }}">
                <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('dashboard') ? 'text-[#2982d6]' : 'text-[#549bde] group-hover:text-[#2982d6]' }}"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z">
                    </path>
                </svg>
                <span class="text-base">Dashboard</span>
            </a>

            @if(in_array(auth()->user()->role, ['admin', 'hr', 'manager']))
                <div class="pt-5 pb-2">
                    <p class="px-3 text-xs font-bold text-[#2168ab] uppercase tracking-widest">Core HR</p>
                </div>

                @if(in_array(auth()->user()->role, ['admin', 'hr']))
                    <a href="{{ route('employees.index') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-150 group {{ request()->routeIs('employees.*') ? 'bg-[#eaf3fb] text-[#103456] font-semibold' : 'text-[#2168ab] hover:bg-[#f8fafc] hover:text-[#184e81]' }}">
                        <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('employees.*') ? 'text-[#2982d6]' : 'text-[#549bde] group-hover:text-[#2982d6]' }}"
                            fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2">
                            </path>
                            <circle cx="9" cy="7" r="4" stroke-linecap="round" stroke-linejoin="round"></circle>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"></path>
                        </svg>
                        <span class="text-base">Employees</span>
                    </a>
                @endif

                <a href="{{ route('departments.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-150 group {{ request()->routeIs('departments.*') ? 'bg-[#eaf3fb] text-[#103456] font-semibold' : 'text-[#2168ab] hover:bg-[#f8fafc] hover:text-[#184e81]' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('departments.*') ? 'text-[#2982d6]' : 'text-[#549bde] group-hover:text-[#2982d6]' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    <span class="text-base">Departments</span>
                </a>
            @endif

            <div class="pt-5 pb-2">
                <p class="px-3 text-xs font-bold text-[#2168ab] uppercase tracking-widest">Time &amp; Access</p>
            </div>

            <a href="{{ route('attendances.index') }}"
                class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-150 group {{ request()->routeIs('attendances.*') ? 'bg-[#eaf3fb] text-[#103456] font-semibold' : 'text-[#2168ab] hover:bg-[#f8fafc] hover:text-[#184e81]' }}">
                <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('attendances.*') ? 'text-[#2982d6]' : 'text-[#549bde] group-hover:text-[#2982d6]' }}"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="text-base">Attendances</span>
            </a>

            <a href="{{ route('leave-requests.index') }}"
                class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-150 group {{ request()->routeIs('leave-requests.*') ? 'bg-[#eaf3fb] text-[#103456] font-semibold' : 'text-[#2168ab] hover:bg-[#f8fafc] hover:text-[#184e81]' }}">
                <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('leave-requests.*') ? 'text-[#2982d6]' : 'text-[#549bde] group-hover:text-[#2982d6]' }}"
                    fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="text-base">Leave Requests</span>
            </a>

            @if(in_array(auth()->user()->role, ['admin', 'hr']))
                <a href="{{ route('users.index') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg transition-all duration-150 group {{ request()->routeIs('users.*') ? 'bg-[#eaf3fb] text-[#103456] font-semibold' : 'text-[#2168ab] hover:bg-[#f8fafc] hover:text-[#184e81]' }}">
                    <svg class="w-5 h-5 mr-3 transition-colors {{ request()->routeIs('users.*') ? 'text-[#2982d6]' : 'text-[#549bde] group-hover:text-[#2982d6]' }}"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                    <span class="text-base">Users</span>
                </a>
            @endif
        </nav>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 bg-[#f8fafc] ml-0 overflow-hidden">
        <header class="h-16 bg-white flex items-center px-4 sm:px-8 justify-between relative z-30 border-b border-[#e2e8f0]">
            <div class="flex items-center space-x-3">
                <button @click="mobileMenuOpen = true"
                    class="p-2 -ml-2 rounded-lg text-[#2168ab] hover:bg-[#eaf3fb] hover:text-[#103456] lg:hidden focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <h2 class="text-xl font-bold text-[#081a2b] tracking-tight">
                    {{ $header ?? 'Overview' }}
                </h2>
            </div>

            <div class="flex items-center space-x-3 sm:space-x-5 ml-auto">
                <div
                    class="hidden sm:flex items-center text-sm font-semibold text-[#184e81] bg-[#f8fafc] border border-[#d4e6f7] px-3 py-1.5 rounded-full shadow-sm">
                    <svg class="w-4 h-4 mr-1.5 text-[#2982d6]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    {{ now()->format('D, M j, Y') }}
                </div>

                <div class="relative" x-data="{ profileOpen: false }">
                    <button @click="profileOpen = !profileOpen" @click.outside="profileOpen = false"
                        class="flex items-center space-x-2 focus:outline-none hover:opacity-80 transition-opacity">
                        <div
                            class="w-8 h-8 rounded-full bg-[#2982d6] text-white flex items-center justify-center font-bold text-sm shadow-sm">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <svg class="w-4 h-4 text-[#549bde] hidden sm:block" fill="none" stroke="currentColor"
                            stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>

                    <div x-show="profileOpen" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-[#e2e8f0] z-50 overflow-hidden"
                        style="display: none;">

                        <div class="px-4 py-3 border-b border-[#e2e8f0] bg-[#f8fafc]">
                            <p class="text-sm font-bold truncate text-[#081a2b] leading-none mb-1">
                                {{ Auth::user()->name ?? 'Administrator' }}
                            </p>
                            <p class="text-[11px] text-[#2168ab] font-medium tracking-wide">
                                {{ str(Auth::user()->role)->title() }}
                            </p>
                        </div>

                        <div class="py-1">
                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center px-4 py-2.5 text-sm font-semibold text-[#2168ab] hover:bg-[#eaf3fb] hover:text-[#103456] transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Settings
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-2.5 text-sm font-semibold text-rose-600 hover:bg-rose-50 hover:text-rose-700 transition-colors text-left">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                        </path>
                                    </svg>
                                    Sign Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 sm:p-8 bg-[#f8fafc]">
            <div class="max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>