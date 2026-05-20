<x-app-layout>
    <x-slot name="header">
        {{ __('Leave Performance Analytics') }}
    </x-slot>

    <div class="mt-6 px-2 sm:px-0 space-y-6">

        {{-- Header Controls Area --}}
        <div class="mb-4">
            <h3 class="text-xl font-bold text-[#081a2b] tracking-tight">Leave Utilization Tracking</h3>
            <a href="{{ route('reports.index') }}"
                class="text-sm font-semibold text-[#2168ab] hover:text-[#103456] inline-flex items-center mt-1">
                ← Back to Report Center
            </a>
        </div>

        {{-- Verification State Ribbon Breakdown Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <div class="bg-white p-5 rounded-xl border border-[#e2e8f0] shadow-sm flex items-center justify-between">
                <span class="text-base font-bold text-[#081a2b]">Approved Requests</span>
                <span
                    class="px-3 py-1 font-extrabold text-sm rounded-full bg-green-300 text-green-900">{{ $leaveSummary['Approved'] ?? 0 }}</span>
            </div>

            <div class="bg-white p-5 rounded-xl border border-[#e2e8f0] shadow-sm flex items-center justify-between">
                <span class="text-base font-bold text-[#081a2b]">Awaiting Evaluation</span>
                <span
                    class="px-3 py-1 font-extrabold text-sm rounded-full bg-yellow-300 text-yellow-900">{{ $leaveSummary['Pending'] ?? 0 }}</span>
            </div>

            <div class="bg-white p-5 rounded-xl border border-[#e2e8f0] shadow-sm flex items-center justify-between">
                <span class="text-base font-bold text-[#081a2b]">Rejected Requests</span>
                <span
                    class="px-3 py-1 font-extrabold text-sm rounded-full bg-rose-300 text-rose-900">{{ $leaveSummary['Rejected'] ?? 0 }}</span>
            </div>
        </div>

        {{-- Category Breakdown Display Panel --}}
        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden flex flex-col w-full">
            <div class="px-6 py-4 border-b border-[#e2e8f0] bg-[#f8fafc]">
                <h4 class="text-base font-bold text-[#081a2b]">Leave Classification Distribution</h4>
            </div>
            <div class="overflow-x-auto min-w-full">
                <table class="min-w-full divide-y divide-[#e2e8f0] table-fixed">
                    <thead class="bg-[#f8fafc]">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Categorized Leave Type
                            </th>
                            <th scope="col"
                                class="w-48 px-4 py-3.5 text-center text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Frequency Volume
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#e2e8f0]">
                        @forelse($typeDistribution as $typeRow)
                            <tr class="hover:bg-[#f8fafc]/50 transition-colors">
                                <td class="px-4 py-3.5 text-base font-bold text-[#081a2b]">
                                    {{ str($typeRow->leave_type)->title() }}
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <span
                                        class="px-3 py-0.5 inline-flex text-xs font-bold rounded-full bg-blue-300 text-blue-900">
                                        {{ $typeRow->total }} Logged Requests
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-8 text-center text-base text-slate-400 italic bg-white">
                                    No logged categorical leave history metrics available yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>