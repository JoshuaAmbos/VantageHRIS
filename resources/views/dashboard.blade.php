<x-app-layout>
    <x-slot name="header">
        Dashboard
    </x-slot>

    <!-- Welcome Hero Section -->
    <div
        class="mb-8 bg-gradient-to-r from-vantage-900 to-vantage-800 rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
        <div
            class="absolute top-0 right-0 -mt-8 -mr-8 w-64 h-64 bg-vantage-500 rounded-full opacity-20 blur-3xl pointer-events-none">
        </div>

        <div class="relative z-10">
            <h3 class="text-3xl font-extrabold mb-2 tracking-tight">Welcome back, {{ Auth::user()->name }}!</h3>
            <p class="text-vantage-100/80 max-w-xl text-sm leading-relaxed">
                Here is a quick overview of what is happening across your organization today. Use the quick actions
                below to manage your teams and departments.
            </p>
        </div>
    </div>

    <!-- Key Metrics Grid -->
    <!-- ADJUSTED: Changed grid-cols-3 to grid-cols-4 on desktop screens -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <!-- Employees -->
        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Employees</h3>
                <div
                    class="w-10 h-10 rounded-xl bg-vantage-50 flex items-center justify-center text-vantage-600 shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-vantage-900">{{ $totalEmployees }}</p>
            <p class="text-xs text-vantage-500 mt-2 font-medium flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                </svg>
                +{{ $numEmployeesMonth }} newly onboarded this month
            </p>
        </div>

        <!-- Departments -->
        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Departments</h3>
                <div
                    class="w-10 h-10 rounded-xl bg-vantage-50 flex items-center justify-center text-vantage-600 shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-vantage-900">{{ $totalDepartments }}</p>
            <p class="text-xs text-vantage-500 mt-2 font-medium flex items-center">
                <svg class="w-3 h-3 mr-1 opacity-80" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 21h16.5M4.5 3h15M5.25 21V3m13.5 18V3M12 6v1.5m0 3V12m0 3v1.5m0 3V21m-4.5-13.5h.008v.008H7.5V7.5Zm0 3h.008v.008H7.5v-.008Zm0 3h.008v.008H7.5v-.008Zm9 0h.008v.008h-.008v-.008Zm0-3h.008v.008h-.008v-.008Zm0-3h.008v.008h-.008v-.008Z">
                    </path>
                </svg>
                {{ $numActiveDepartments }} active department(s)
            </p>
        </div>

        <!-- Leave Requests -->
        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Leave Requests</h3>
                <div
                    class="w-10 h-10 rounded-xl bg-vantage-50 flex items-center justify-center text-vantage-600 shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2-2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-vantage-900">{{ $totalRequests }}</p>
            <p class="text-xs text-amber-500 mt-2 font-medium flex items-center">
                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ $pendingRequests }} pending HR approval
            </p>
        </div>

        <!-- Users Module Metric Card -->
        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Active User Accounts</h3>
                <div
                    class="w-10 h-10 rounded-xl bg-vantage-50 flex items-center justify-center text-vantage-600 shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                        </path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-vantage-900">{{ $totalUsers ?? 0 }}</p>
            <p class="text-xs text-slate-500 mt-2 font-medium flex items-center">
                <svg class="w-3 h-3 mr-1 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                    </path>
                </svg>
                System credential logs secured
            </p>
        </div>

    </div>

    <!-- Quick Actions Panel -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <h3 class="text-lg font-bold text-vantage-900 mb-4">Quick Actions</h3>
        <div class="flex flex-wrap gap-4">
            <!-- Primary Action -->
            <a href="{{ route('employees.create') }}"
                class="inline-flex items-center px-4 py-2 bg-vantage-800 hover:bg-vantage-900 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm focus:ring-2 focus:ring-vantage-500 focus:ring-offset-1">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Register New Employee
            </a>

            <!-- Users Module Action Link -->
            <a href="{{ route('users.create') }}"
                class="inline-flex items-center px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm focus:ring-2 focus:ring-slate-500 focus:ring-offset-1">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Provision User Account
            </a>

            <!-- Secondary Action -->
            <a href="{{ route('departments.index') }}"
                class="inline-flex items-center px-4 py-2 bg-vantage-50 text-vantage-800 hover:bg-vantage-100 text-sm font-semibold rounded-lg transition-colors border border-vantage-100">
                <svg class="w-4 h-4 mr-2 opacity-70" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                Manage Departments
            </a>
        </div>
    </div>

</x-app-layout>