{{-- Admin & HR Global Management Grid Layout --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    {{-- Card 1: Total Workforce Headcount --}}
    <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Employees</h3>
            <div class="w-10 h-10 rounded-xl bg-[#f8fafc] border border-[#e2e8f0] flex items-center justify-center text-slate-700 shadow-inner">
                <svg class="w-5 h-5 text-[#2168ab]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-[#081a2b]">{{ $totalEmployees }}</p>
        <p class="text-xs text-emerald-600 mt-2 font-medium flex items-center">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
            </svg>
            +{{ $numEmployeesMonth }} onboarding this month
        </p>
    </div>

    {{-- Card 2: Departments Summary --}}
    <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Departments</h3>
            <div class="w-10 h-10 rounded-xl bg-[#f8fafc] border border-[#e2e8f0] flex items-center justify-center text-slate-700 shadow-inner">
                <svg class="w-5 h-5 text-[#2168ab]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-[#081a2b]">{{ $totalDepartments }}</p>
        <p class="text-xs text-[#549bde] mt-2 font-medium">
            {{ $numActiveDepartments }} active operational units
        </p>
    </div>

    {{-- Card 3: Enterprise Leave Requests System --}}
    <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Global Leaves</h3>
            <div class="w-10 h-10 rounded-xl bg-[#f8fafc] border border-[#e2e8f0] flex items-center justify-center text-slate-700 shadow-inner">
                <svg class="w-5 h-5 text-[#2168ab]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-[#081a2b]">{{ $totalRequests }}</p>
        <p class="text-xs mt-2 font-medium flex items-center {{ $pendingRequests > 0 ? 'text-amber-600' : 'text-slate-400' }}">
            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ $pendingRequests }} pending verification
        </p>
    </div>

    {{-- Card 4: System User Accounts --}}
    <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] p-6 hover:shadow-md transition-shadow duration-200">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Active Users</h3>
            <div class="w-10 h-10 rounded-xl bg-[#f8fafc] border border-[#e2e8f0] flex items-center justify-center text-slate-700 shadow-inner">
                <svg class="w-5 h-5 text-[#2168ab]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </div>
        </div>
        <p class="text-3xl font-extrabold text-[#081a2b]">{{ $totalUsers }}</p>
        <p class="text-xs text-slate-400 mt-2 font-medium">Authentication records verified</p>
    </div>

</div>

{{-- FIXED: Extracted this full module completely out of the grid wrapper to allow 100% width --}}
<div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden w-full mb-8">
    <div class="px-6 py-4 border-b border-[#e2e8f0] bg-[#f8fafc]">
        <h4 class="text-base font-bold text-[#081a2b] tracking-tight">Recent HR System Activities</h4>
    </div>

    <div class="p-6">
        <div class="flow-root">
            <ul role="list" class="-mb-8">
                @forelse($recentActivities as $activity)
                    <li>
                        <div class="relative pb-8">
                            {{-- Connecting Vertical Timeline Rail Line Element --}}
                            @if(!$loop->last)
                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-[#e2e8f0]" aria-hidden="true"></span>
                            @endif

                            <div class="relative flex space-x-3 items-start">
                                <div>
                                    {{-- Contextual Status Rounded Pill Icon Wrapper --}}
                                    <span class="h-8 w-8 rounded-full flex items-center justify-center ring-8 ring-white shadow-xs
                                        @if($activity->event_type === 'employee_created') bg-green-100 border border-green-200 text-green-600
                                        @elseif($activity->event_type === 'employee_deleted') bg-rose-100 border border-rose-200 text-rose-600
                                        @else bg-blue-100 border border-blue-200 text-blue-600 @endif">
                                        
                                        @if($activity->event_type === 'employee_created')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                                        @elseif($activity->event_type === 'employee_deleted')
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        @endif
                                    </span>
                                </div>
                                
                                {{-- Activity Tracking String Text Data Output --}}
                                <div class="flex-1 min-w-0 pt-1.5 flex justify-between gap-4">
                                    <p class="text-base font-medium text-[#103456] leading-snug">
                                        {{ $activity->description }}
                                    </p>
                                    <div class="text-right whitespace-nowrap text-xs font-bold text-[#549bde] tracking-wide mt-0.5">
                                        <time datetime="{{ $activity->created_at }}">{{ $activity->created_at->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @empty
                    <li class="text-center text-base text-slate-400 italic py-4 mb-4">
                        No system activity audit records logged within this billing cycle.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
</div>