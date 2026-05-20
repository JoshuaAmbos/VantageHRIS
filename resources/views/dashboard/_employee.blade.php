@if(auth()->user()->role === 'manager')
    {{-- Manager Supervisory Dashboard Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        
        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Team Headcount</h3>
                <div class="w-10 h-10 rounded-xl bg-slate-50 border border-[#e2e8f0] flex items-center justify-center text-[#2168ab] shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-extrabold text-slate-900">{{ $totalEmployees }}</p>
            <p class="text-xs text-slate-400 mt-2 font-medium">Assigned team members</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Total Team Leaves</h3>
                <div class="w-10 h-10 rounded-xl bg-slate-50 border border-[#e2e8f0] flex items-center justify-center text-[#2168ab] shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-extrabold text-slate-900">{{ $totalRequests }}</p>
            <p class="text-xs text-slate-400 mt-2 font-medium">Historical requests logged</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Pending Approvals</h3>
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-inner {{ $pendingRequests > 0 ? 'text-amber-600 bg-amber-50' : 'bg-slate-50 text-slate-400' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold {{ $pendingRequests > 0 ? 'text-amber-600' : 'text-slate-900' }}">{{ $pendingRequests }}</p>
            <p class="text-xs mt-2 font-medium {{ $pendingRequests > 0 ? 'text-amber-600' : 'text-slate-400' }}">Requires your evaluation</p>
        </div>

    </div>
@else
    {{-- Employee & Staff Personalized Dashboard Grid Layout --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Today's Status</h3>
                <div class="w-10 h-10 rounded-xl {{ $todayStatus !== 'Not Clocked In' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-50 text-slate-400' }} flex items-center justify-center shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-2xl font-bold text-slate-900">{{ $todayStatus }}</p>
            <p class="text-xs text-slate-400 mt-3 font-medium">Standard Shift: 08:00 AM - 05:00 PM</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Days Present</h3>
                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-700 shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $daysPresentCount }}</p>
            <p class="text-xs text-slate-400 mt-2 font-medium">Logged logs within active billing cycle</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">My Leave Requests</h3>
                <div class="w-10 h-10 rounded-xl bg-slate-50 flex items-center justify-center text-slate-700 shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-slate-900">{{ $totalRequests }}</p>
            <p class="text-xs text-amber-500 mt-2 font-medium flex items-center">
                {{ $pendingRequests }} pending approval review
            </p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-wider">Available Leaves</h3>
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-600 shadow-inner">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-amber-600">{{ $vacationBalance }} Days</p>
            <p class="text-xs text-slate-400 mt-2 font-medium">Remaining annual balance allocation</p>
        </div>

    </div>
@endif

{{-- Unified Activity Timeline Module --}}
@if(in_array(auth()->user()->role, ['manager', 'admin', 'hr']))
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
                                @if(!$loop->last)
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-[#e2e8f0]" aria-hidden="true"></span>
                                @endif

                                <div class="relative flex space-x-3 items-start">
                                    <div>
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
                        <li class="text-center text-base text-slate-400 italic py-4">
                            No system activity audit records logged within this cycle.
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
@endif