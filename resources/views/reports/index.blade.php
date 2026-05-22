<x-app-layout>
    <x-slot name="header">
        {{ __('HR Intelligence Reports') }}
    </x-slot>

    <div class="mt-6 px-2 sm:px-0 space-y-6">
        <h3 class="text-xl font-bold text-[#081a2b] tracking-tight">System Report Dashboard</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-5">

            {{-- Total Active Staff --}}
            <div class="bg-white p-6 rounded-xl border border-[#e2e8f0] shadow-sm">
                <p class="text-xs font-bold text-[#2168ab] uppercase tracking-widest">Total Active Staff</p>
                <h3 class="text-3xl font-extrabold text-[#081a2b] mt-1">{{ $totalEmployees }} Members</h3>
            </div>

            {{-- Pending Leave Actions --}}
            <div class="bg-white p-6 rounded-xl border border-[#e2e8f0] shadow-sm">
                <p class="text-xs font-bold text-[#2168ab] uppercase tracking-widest">Pending Leave Actions</p>
                <h3 class="text-3xl font-extrabold mt-1">
                    <span class="{{ $pendingLeaves > 0 ? 'text-yellow-600' : 'text-slate-400' }}">{{ $pendingLeaves }}
                        Requests</span>
                </h3>
            </div>
        </div>

        {{-- Demographics Distribution Grid Card Layout --}}
        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden flex flex-col w-full">
            <div class="px-6 py-4 border-b border-[#e2e8f0] bg-[#f8fafc]">
                <h4 class="text-base font-bold text-[#081a2b]">Workforce Role Distribution</h4>
            </div>
            <div class="overflow-x-auto min-w-full">
                <table class="min-w-full divide-y divide-[#e2e8f0] table-fixed">
                    <thead class="bg-[#f8fafc]">
                        <tr>
                            <th scope="col"
                                class="px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Organizational Position Title
                            </th>
                            <th scope="col"
                                class="w-48 px-4 py-3.5 text-center text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Active Count
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#e2e8f0]">
                        @foreach($positionDistribution as $row)
                            <tr class="hover:bg-[#f8fafc]/50 transition-colors">
                                <td class="px-4 py-3.5 text-base font-bold text-[#081a2b]">
                                    {{ str($row->position)->title() }}
                                </td>
                                <td class="px-4 py-3.5 text-center">
                                    <span
                                        class="px-3 py-0.5 inline-flex text-xs font-bold rounded-full bg-blue-300 text-blue-900">
                                        {{ $row->total }} Staff Assigned
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>