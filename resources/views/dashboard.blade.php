<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <div class="mb-8 bg-white border border-[#e2e8f0] rounded-xl p-8 shadow-sm relative overflow-hidden">
        <div
            class="absolute top-0 right-0 -mt-8 -mr-8 w-64 h-64 bg-[#eaf3fb] rounded-full opacity-40 blur-3xl pointer-events-none">
        </div>

        <div class="relative z-10">

            <h3 class="text-3xl font-extrabold text-[#103456] tracking-tight mt-4 mb-2">
                Welcome back, {{ Auth::user()->name }}!
            </h3>
            <p class="text-[#2168ab] max-w-xl text-base leading-relaxed">
                Here is your centralized workplace snapshot for today. Use the tracking modules below to review
                schedules, logs, and active workflow allocations.
            </p>
        </div>
    </div>

    <div class="mb-8">
        @if(in_array(auth()->user()->role, ['admin', 'hr']))
            @include('dashboard._admin')
        @else
            @include('dashboard._employee')
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] p-6">
        <h3 class="text-lg font-bold text-[#081a2b] mb-5 tracking-tight">Quick Actions Dashboard</h3>
        <div class="flex flex-wrap gap-4">

            {{-- Administrative Actions (Admin & HR Staff Only) --}}
            @if(in_array(auth()->user()->role, ['admin', 'hr']))
                <a href="{{ route('employees.create') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-[#2982d6] hover:bg-[#2168ab] text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Register New Employee
                </a>

                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center px-4 py-2.5 bg-white text-[#2168ab] hover:bg-[#eaf3fb] text-sm font-semibold rounded-lg transition-colors border border-[#a9cdef] shadow-sm">
                    <svg class="w-4 h-4 mr-2 text-[#549bde]" fill="none" stroke="currentColor" stroke-width="2"
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
                    class="inline-flex items-center px-4 py-2.5 bg-[#f8fafc] text-[#103456] hover:bg-[#eaf3fb] hover:text-[#2982d6] text-sm font-semibold rounded-lg transition-colors border border-[#e2e8f0]">
                    <svg class="w-4 h-4 mr-2 text-[#549bde]" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Manage Departments
                </a>
            @endif

            {{-- Standard Self-Service Actions (All Roles) --}}
            <a href="{{ route('leave-requests.index') }}"
                class="inline-flex items-center px-4 py-2.5 bg-white text-[#2168ab] hover:bg-[#eaf3fb] text-sm font-semibold rounded-lg transition-colors border border-[#a9cdef] shadow-sm">
                <svg class="w-4 h-4 mr-2 text-[#549bde]" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2">
                    </path>
                </svg>
                View Leave Requests
            </a>

            <a href="{{ route('attendances.index') }}"
                class="inline-flex items-center px-4 py-2.5 bg-white text-[#2168ab] hover:bg-[#eaf3fb] text-sm font-semibold rounded-lg transition-colors border border-[#a9cdef] shadow-sm">
                <svg class="w-4 h-4 mr-2 text-[#549bde]" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                View Attendance Logs
            </a>

        </div>
    </div>
</x-app-layout>