<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- 1. WELCOME HERO SECTION (Visible to all authenticated sessions) -->
    <div
        class="mb-8 bg-gradient-to-r from-slate-900 to-slate-800 rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
        <div
            class="absolute top-0 right-0 -mt-8 -mr-8 w-64 h-64 bg-vantage-500 rounded-full opacity-10 blur-3xl pointer-events-none">
        </div>

        <div class="relative z-10">
            <h3 class="text-3xl font-extrabold mb-2 tracking-tight">Welcome back, {{ Auth::user()->name }}!</h3>
            <p class="text-slate-300 max-w-xl text-sm leading-relaxed mb-4">
                Here is your centralized workplace snapshot for today. Use the tracking modules to review schedules,
                logs, and workflow allocations.
            </p>
            <div
                class="inline-flex items-center text-xs font-semibold tracking-wider text-vantage-400 uppercase bg-slate-950/50 px-3 py-1 rounded-md border border-slate-700/50">
                Access Tier: {{ Auth::user()->role }}
            </div>
        </div>
    </div>

    <!-- 2. DYNAMIC SUB-VIEW INCLUSION ENGINE -->
    {{-- Dynamically injects the smaller partial cards based on user access scopes --}}
    @if(in_array(auth()->user()->role, ['admin', 'hr']))
        @include('dashboard._admin')
    @else
        @include('dashboard._employee')
    @endif

    <!-- 3. QUICK ACTIONS PANEL -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Quick Actions Dashboard</h3>
        <div class="flex flex-wrap gap-4">

            {{-- Administrative Actions (Admin & HR Staff Only) --}}
            @if(in_array(auth()->user()->role, ['admin', 'hr']))
                <a href="{{ route('employees.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Register New Employee
                </a>

                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center px-4 py-2 bg-white text-slate-700 hover:bg-slate-50 text-sm font-semibold rounded-lg transition-colors border border-slate-200 shadow-sm">
                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Provision User Account
                </a>
            @endif

            {{-- Supervisory Actions (Admin, HR, & Department Managers Only) --}}
            @if(in_array(auth()->user()->role, ['admin', 'hr', 'manager']))
                <a href="{{ route('departments.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-slate-50 text-slate-800 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors border border-slate-200">
                    <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Manage Departments
                </a>
            @endif

            {{-- Standard Self-Service Actions (All Roles) --}}
            <a href="{{ route('leave-requests.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white text-slate-700 hover:bg-slate-50 text-sm font-semibold rounded-lg transition-colors border border-slate-200 shadow-sm">
                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2">
                    </path>
                </svg>
                View Leave Requests
            </a>

            <a href="{{ route('attendances.index') }}"
                class="inline-flex items-center px-4 py-2 bg-white text-slate-700 hover:bg-slate-50 text-sm font-semibold rounded-lg transition-colors border border-slate-200 shadow-sm">
                <svg class="w-4 h-4 mr-2 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                View Attendance Logs
            </a>

        </div>
    </div>
</x-app-layout>