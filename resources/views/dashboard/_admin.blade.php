<!-- Admin & HR Global Management Grid Layout -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- Card 1: Total Workforce Headcount -->
    <div
        class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Employees</h3>
            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-700 shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $totalEmployees }}</p>
        <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
            +{{ $numEmployeesMonth }} onboarding this month
        </p>
    </div>

    <!-- Card 2: Departments Summary -->
    <div
        class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Departments</h3>
            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-700 shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $totalDepartments }}</p>
        <p class="text-xs text-slate-500 mt-2 font-medium">
            {{ $numActiveDepartments }} active operational units
        </p>
    </div>

    <!-- Card 3: Enterprise Leave Requests System -->
    <div
        class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Global Leaves</h3>
            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-700 shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $totalRequests }}</p>
        <p
            class="text-xs mt-2 font-medium flex items-center {{ $pendingRequests > 0 ? 'text-amber-600' : 'text-slate-400' }}">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z">
                </path>
            </svg>
            {{ $pendingRequests }} pending verification
        </p>
    </div>

    <!-- Card 4: System User Accounts -->
    <div
        class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Active Users</h3>
            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-700 shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $totalUsers }}</p>
        <p class="text-xs text-slate-400 mt-2 font-medium">Authentication records verified</p>
    </div>

</div>