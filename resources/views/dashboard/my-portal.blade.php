<x-app-layout>
    <x-slot name="header">
        {{ __('My Employee Portal') }}
    </x-slot>

    <div class="mt-6 px-4 sm:px-0 max-w-7xl mx-auto space-y-6">

        {{-- Employee Profile Overview Card & Quick Action Time Clock --}}
        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] p-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div class="flex items-center gap-4">
                    <div
                        class="h-16 w-16 rounded-2xl bg-[#eaf3fb] border border-[#d4e6f7] text-[#184e81] flex items-center justify-center font-extrabold text-2xl shadow-inner flex-shrink-0">
                        {{ substr($employee->first_name ?? 'E', 0, 1) }}{{ substr($employee->last_name ?? 'P', 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-extrabold text-[#081a2b] tracking-tight">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </h3>
                        <p class="text-[#2168ab] text-sm font-semibold mt-0.5">
                            {{ $employee->position }} <span class="text-slate-300 mx-1.5">•</span>
                            {{ $employee->department->name ?? 'Unassigned Unit' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Core Dashboard Split Grid Component Frame --}}
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- Left Side: Recent Attendance Logs --}}
            <div
                class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden lg:col-span-5 flex flex-col">
                <div class="px-5 py-4 border-b border-[#e2e8f0] bg-[#f8fafc]">
                    <h4 class="text-sm font-bold text-[#2168ab] uppercase tracking-wider">Recent Attendance</h4>
                </div>

                <div class="overflow-x-auto min-w-full flex-1">
                    <table class="min-w-full divide-y divide-[#e2e8f0] table-fixed">
                        <tbody class="bg-white divide-y divide-[#e2e8f0]">
                            @forelse($recentAttendance as $attendance)
                                <tr class="hover:bg-[#f8fafc]/40 transition-colors">
                                    <td class="px-5 py-3.5 whitespace-nowrap">
                                        <span class="text-sm font-bold text-[#081a2b]">
                                            {{ \Carbon\Carbon::parse($attendance->attendance_date)->format('M j, Y') }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap">
                                        <div class="text-xs text-slate-400 font-semibold">
                                            {{ $attendance->time_in && $attendance->time_in !== '00:00:00' ? \Carbon\Carbon::parse($attendance->time_in)->format('g:i A') : '—' }}
                                            <span class="mx-1 text-slate-300">to</span>
                                            {{ $attendance->time_out && $attendance->time_out !== '00:00:00' ? \Carbon\Carbon::parse($attendance->time_out)->format('g:i A') : '—' }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap text-right">
                                        @php $status = strtolower($attendance->status); @endphp
                                        @if($status === 'present')
                                            <span
                                                class="px-2 py-0.5 text-[10px] font-bold rounded bg-green-100 text-green-800">Present</span>
                                        @elseif($status === 'late')
                                            <span
                                                class="px-2 py-0.5 text-[10px] font-bold rounded bg-yellow-100 text-yellow-800">Late</span>
                                        @elseif($status === 'on leave')
                                            <span class="px-2 py-0.5 text-[10px] font-bold rounded bg-blue-100 text-blue-800">On
                                                Leave</span>
                                        @else
                                            <span
                                                class="px-2 py-0.5 text-[10px] font-bold rounded bg-rose-100 text-rose-800">Absent</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-10 text-center text-sm text-slate-400 italic bg-white">
                                        No recent attendance records logged.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Right Side: Leave Requests History --}}
            <div
                class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden lg:col-span-7 flex flex-col">
                <div class="px-5 py-4 border-b border-[#e2e8f0] bg-[#f8fafc] flex justify-between items-center">
                    <h4 class="text-sm font-bold text-[#2168ab] uppercase tracking-wider">Leave Requests History</h4>
                    <a href="{{ route('leave-requests.create') }}"
                        class="text-xs font-bold text-[#2982d6] hover:text-[#2168ab] transition-colors">
                        + Submit Request
                    </a>
                </div>

                <div class="overflow-x-auto min-w-full flex-1">
                    <table class="min-w-full divide-y divide-[#e2e8f0] table-fixed">
                        <thead class="bg-[#f8fafc]/50 border-b border-[#e2e8f0]">
                            <tr>
                                <th scope="col"
                                    class="px-5 py-2.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider w-1/4">
                                    Type</th>
                                <th scope="col"
                                    class="px-5 py-2.5 text-left text-xs font-bold text-slate-400 uppercase tracking-wider w-2/5">
                                    Duration</th>
                                <th scope="col"
                                    class="px-5 py-2.5 text-center text-xs font-bold text-slate-400 uppercase tracking-wider w-1/4">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#e2e8f0]">
                            @forelse($leaveRequests as $request)
                                <tr class="hover:bg-[#f8fafc]/40 transition-colors">
                                    <td class="px-5 py-3.5 whitespace-nowrap">
                                        <div class="text-sm font-bold text-[#103456]">{{ $request->leave_type }}</div>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap">
                                        <div class="flex flex-col">
                                            <span class="text-xs font-bold text-[#081a2b]">
                                                {{ \Carbon\Carbon::parse($request->start_date)->format('M j, Y') }}
                                            </span>
                                            <span class="text-[10px] text-slate-400 mt-0.5">
                                                to {{ \Carbon\Carbon::parse($request->end_date)->format('M j, Y') }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-3.5 whitespace-nowrap text-center">
                                        @if($request->status === 'Approved')
                                            <span
                                                class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-green-300 text-green-900">Approved</span>
                                        @elseif($request->status === 'Pending')
                                            <span
                                                class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-yellow-300 text-yellow-900">Pending</span>
                                        @else
                                            <span
                                                class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-rose-300 text-rose-900">Rejected</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-5 py-12 text-center text-sm text-slate-400 italic bg-white">
                                        No tracking leave request entries found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>