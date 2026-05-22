<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#081a2b] leading-tight">
            {{ __('Attendance Analytics Report') }}
        </h2>
    </x-slot>

    <div class="mt-6 px-2 sm:px-0 space-y-6">

        {{-- Header Controls & Date Picker --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
            <div>
                <h3 class="text-xl font-bold text-[#081a2b] tracking-tight">
                    Daily Attendance Overview for {{ \Carbon\Carbon::parse($date)->format('M j, Y') }}
                </h3>
            </div>

            {{-- Calendar Date Parameter Form Filter --}}
            <form action="{{ route('reports.attendance') }}" method="GET"
                class="w-full sm:w-auto flex items-center gap-2">
                <input type="date" name="date" value="{{ $date }}"
                    class="px-4 py-2 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] shadow-xs">
                <button type="submit"
                    class="px-4 py-2 bg-[#2982d6] hover:bg-[#2168ab] text-white font-semibold rounded-xl transition-colors shadow-xs">
                    Filter
                </button>
            </form>
        </div>

        {{-- Core Metrics Grid Metric Blocks --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

            {{-- Present Box --}}
            <div class="bg-white p-5 rounded-xl border border-[#e2e8f0] shadow-sm">
                <span class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-green-300 text-green-900">Present</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#081a2b] mt-3">
                    {{ $attendanceSummary[\App\Models\Attendance::STATUS_PRESENT] ?? 0 }} Instances
                </h2>
            </div>

            {{-- Late Box --}}
            <div class="bg-white p-5 rounded-xl border border-[#e2e8f0] shadow-sm">
                <span class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-yellow-300 text-yellow-900">Late</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#081a2b] mt-3">
                    {{ $attendanceSummary[\App\Models\Attendance::STATUS_LATE] ?? 0 }} Instances
                </h2>
            </div>

            {{-- On Leave Box --}}
            <div class="bg-white p-5 rounded-xl border border-[#e2e8f0] shadow-sm">
                <span class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-blue-300 text-blue-900">On Leave</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#081a2b] mt-3">
                    {{ $attendanceSummary[\App\Models\Attendance::STATUS_ON_LEAVE] ?? 0 }} Instances
                </h2>
            </div>

            {{-- Absent Box --}}
            <div class="bg-white p-5 rounded-xl border border-[#e2e8f0] shadow-sm">
                <span class="px-2.5 py-0.5 text-xs font-bold rounded-full bg-rose-300 text-rose-900">Absent</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#081a2b] mt-3">
                    {{ $attendanceSummary[\App\Models\Attendance::STATUS_ABSENT] ?? 0 }} Instances
                </h2>
            </div>
        </div>

        {{-- Detailed Daily Logs Table Frame --}}
        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden flex flex-col w-full">
            <div class="px-6 py-4 border-b border-[#e2e8f0] bg-[#f8fafc]">
                <h4 class="text-base font-bold text-[#081a2b]">Detailed Log Breakdown</h4>
            </div>

            <div class="overflow-x-auto min-w-full">
                <table class="min-w-full divide-y divide-[#e2e8f0] table-fixed">
                    <thead class="bg-[#f8fafc]">
                        <tr>
                            <th scope="col"
                                class="w-1/3 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Employee
                            </th>
                            <th scope="col"
                                class="w-28 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Time In
                            </th>
                            <th scope="col"
                                class="w-28 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Time Out
                            </th>
                            <th scope="col"
                                class="w-28 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Status
                            </th>
                            <th scope="col"
                                class="px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Remarks
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#e2e8f0]">
                        @forelse($attendances as $attendance)
                            <tr class="hover:bg-[#f8fafc]/50 transition-colors">

                                {{-- Employee Badge Column --}}
                                <td class="px-4 py-3.5 whitespace-nowrap truncate">
                                    <div class="flex items-center">
                                        <div
                                            class="h-9 w-9 rounded-full bg-[#eaf3fb] border border-[#d4e6f7] text-[#184e81] flex items-center justify-center font-bold text-xs flex-shrink-0">
                                            {{ substr($attendance->employee->first_name ?? 'E', 0, 1) }}{{ substr($attendance->employee->last_name ?? 'P', 0, 1) }}
                                        </div>
                                        <div class="ml-2.5 truncate">
                                            <div class="text-base font-bold text-[#081a2b] truncate">
                                                {{ $attendance->employee->first_name ?? 'Unknown' }}
                                                {{ $attendance->employee->last_name ?? 'Employee' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Clock In Column --}}
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <div class="text-base text-[#2168ab] font-semibold">
                                        {{ $attendance->time_in ? \Carbon\Carbon::parse($attendance->time_in)->format('g:i A') : '—' }}
                                    </div>
                                </td>

                                {{-- Clock Out Column --}}
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <div class="text-base text-[#2168ab] font-semibold">
                                        {{ $attendance->time_out ? \Carbon\Carbon::parse($attendance->time_out)->format('g:i A') : '—' }}
                                    </div>
                                </td>

                                {{-- Status Column --}}
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    @php
                                        $normalizedStatus = strtolower(trim($attendance->status));
                                    @endphp

                                    @if($normalizedStatus === \App\Models\Attendance::STATUS_PRESENT)
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-green-300 text-green-900">Present</span>
                                    @elseif($normalizedStatus === \App\Models\Attendance::STATUS_LATE)
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-yellow-300 text-yellow-900">Late</span>
                                    @elseif($normalizedStatus === \App\Models\Attendance::STATUS_ON_LEAVE)
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-blue-300 text-blue-900">On
                                            Leave</span>
                                    @else
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-rose-300 text-rose-900">Absent</span>
                                    @endif
                                </td>

                                {{-- Remarks Column --}}
                                <td class="px-4 py-3.5">
                                    <div class="text-base text-slate-500 font-medium truncate max-w-xs">
                                        {{ $attendance->remarks ?? '—' }}
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-base text-slate-400 italic bg-white">
                                    No detailed log entries found for this calendar date.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if(method_exists($attendances, 'links') && $attendances->hasPages())
                    <div class="px-6 py-4 border-t border-[#e2e8f0] bg-[#f8fafc] mt-auto">
                        {{ $attendances->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</x-app-layout>