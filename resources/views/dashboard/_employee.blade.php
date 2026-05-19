<!-- Employee & Staff Personalized Dashboard Grid Layout -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <!-- Card 1: Today's Shift Punch Status -->
    <div
        class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Today's Status</h3>
            <div
                class="w-10 h-10 rounded-xl {{ $todayStatus !== 'Not Clocked In' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-50 text-slate-400' }} flex items-center justify-center shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-2xl font-bold text-slate-900">{{ $todayStatus }}</p>
        <p class="text-xs text-slate-400 mt-3 font-medium">Standard Shift: 08:00 AM - 05:00 PM</p>
    </div>

    <!-- Card 2: Personal Total Monthly Attendance Days -->
    <div
        class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Days Present</h3>
            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-700 shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $daysPresentCount }}</p>
        <p class="text-xs text-slate-400 mt-2 font-medium">Logged logs within active billing cycle</p>
    </div>

    <!-- Card 3: Personal Leave Requests Submitted Balance -->
    <div
        class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">My Leave Requests</h3>
            <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-700 shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-slate-900">{{ $totalRequests }}</p>
        <p class="text-xs text-amber-500 mt-2 font-medium flex items-center">
            {{ $pendingRequests }} pending approval review
        </p>
    </div>

    <!-- Card 4: Statutory Vacation Leave Balances Allocation -->
    <div
        class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Available Leaves</h3>
            <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 shadow-inner">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-bold text-amber-600">{{ $vacationBalance }} Days</p>
        <p class="text-xs text-slate-400 mt-2 font-medium">Remaining annual balance allocation</p>
    </div>

</div>