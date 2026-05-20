<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <span>{{ __('Department Profile') }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 px-2 sm:px-0 space-y-6">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-[#e2e8f0] p-4 sm:p-8">

            {{-- Top Header Section featuring Name, Description, and Active Status --}}
            <div
                class="border-b border-[#e2e8f0] pb-6 mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-4">
                    <div
                        class="h-16 w-16 rounded-2xl bg-[#eaf3fb] border border-[#d4e6f7] text-[#184e81] flex items-center justify-center font-extrabold text-2xl shadow-inner flex-shrink-0">
                        {{ substr($department->name, 0, 2) }}
                    </div>
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-[#081a2b] tracking-tight">
                            {{ $department->name }}
                        </h3>
                        <p class="text-[#2168ab] text-sm sm:text-base font-medium mt-1">
                            Manager: <span
                                class="font-bold">{{ $department->manager ? $department->manager->first_name . ' ' . $department->manager->last_name : 'None Assigned' }}</span>
                        </p>
                    </div>
                </div>

                @if(($department->status ?? 'active') === 'active')
                    <span
                        class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-emerald-50 text-emerald-700 border border-emerald-100 self-start sm:self-center">
                        Active Unit
                    </span>
                @else
                    <span
                        class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-slate-50 text-slate-700 border border-slate-100 self-start sm:self-center">
                        Inactive
                    </span>
                @endif
            </div>

            {{-- Metadata Grid Details Summary Box --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                <div class="space-y-5">
                    <h4
                        class="font-bold text-[#2168ab] uppercase tracking-widest text-xs border-b border-[#e2e8f0] pb-2">
                        Unit Description
                    </h4>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">Operational Purpose
                        </p>
                        <p class="text-base font-medium text-[#081a2b] leading-relaxed">
                            {{ $department->description ?? 'No description defined for this business unit.' }}
                        </p>
                    </div>
                </div>

                <div class="space-y-5">
                    <h4
                        class="font-bold text-[#2168ab] uppercase tracking-widest text-xs border-b border-[#e2e8f0] pb-2">
                        Department Metrics
                    </h4>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">Total Assigned
                            Headcount</p>
                        <p class="text-base font-bold text-[#081a2b]">
                            {{ $department->employees->count() }}
                            {{ $department->employees->count() === 1 ? 'Member' : 'Members' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Department Members Data Table Panel Frame --}}
            <div class="mt-10 space-y-4" x-data="{ memberSearch: '' }">
                <div
                    class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-[#e2e8f0] pb-2">
                    <h4 class="font-bold text-[#2168ab] uppercase tracking-widest text-xs">
                        Department Members Directory
                    </h4>
                    {{-- Dynamic Inline Filter Input Field --}}
                    <div class="relative w-full sm:w-64">
                        <input x-model="memberSearch" type="text" placeholder="Search department members..."
                            class="w-full px-3 py-1.5 text-sm bg-[#f8fafc] border border-[#e2e8f0] rounded-lg focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] text-[#081a2b]">
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-[#e2e8f0] overflow-hidden flex flex-col w-full">
                    {{-- FIXED: Max height and custom vertical scrolling container box wrapper --}}
                    <div class="overflow-x-auto min-w-full max-h-96 overflow-y-auto custom-scrollbar">
                        <table class="min-w-full divide-y divide-[#e2e8f0] table-fixed">
                            <thead class="bg-[#f8fafc] sticky top-0 z-10 shadow-xs">
                                <tr>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap bg-[#f8fafc]">
                                        Employee Name</th>
                                    <th scope="col"
                                        class="px-4 py-3 text-left text-xs font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap bg-[#f8fafc]">
                                        Position Title</th>
                                    <th scope="col"
                                        class="w-48 px-4 py-3 text-center text-xs font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap bg-[#f8fafc]">
                                        Contact Channel</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-[#e2e8f0]">
                                @forelse($department->employees as $member)
                                    {{-- AlpineJS Row Filtering Logic --}}
                                    <tr x-show="memberSearch === '' || '{{ strtolower($member->first_name . ' ' . $member->last_name . ' ' . $member->position) }}'.includes(memberSearch.toLowerCase())"
                                        class="hover:bg-[#f8fafc]/50 transition-colors">
                                        {{-- Member Name Badge --}}
                                        <td class="px-4 py-3.5 whitespace-nowrap truncate">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-8 w-8 rounded-lg bg-[#eaf3fb] text-[#184e81] flex items-center justify-center font-bold text-xs flex-shrink-0 shadow-xs border border-[#d4e6f7]">
                                                    {{ substr($member->first_name, 0, 1) }}{{ substr($member->last_name, 0, 1) }}
                                                </div>
                                                <a href="{{ route('employees.show', $member->id) }}"
                                                    class="ml-2.5 text-base font-bold text-[#081a2b] hover:text-[#2982d6] transition-colors truncate">
                                                    {{ $member->first_name }} {{ $member->last_name }}
                                                </a>
                                            </div>
                                        </td>
                                        {{-- Position Label --}}
                                        <td
                                            class="px-4 py-3.5 whitespace-nowrap text-base font-semibold text-[#103456] truncate">
                                            {{ $member->position }}
                                        </td>
                                        {{-- Email Shorthand Link --}}
                                        <td class="px-4 py-3.5 whitespace-nowrap text-center text-sm font-medium">
                                            <a href="mailto:{{ $member->email }}"
                                                class="text-[#2982d6] hover:text-[#2168ab] font-bold underline truncate">
                                                {{ $member->email }}
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3"
                                            class="px-6 py-8 text-center text-base text-slate-400 italic bg-white">
                                            No active staff members are assigned to this department yet.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Action Footers Management Ribbon --}}
            <div
                class="mt-10 pt-6 border-t border-[#e2e8f0] flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                @if(in_array(auth()->user()->role, ['admin', 'hr']))
                    <a href="{{ route('departments.edit', $department->id) }}"
                        class="text-center px-5 py-2.5 bg-[#2982d6] hover:bg-[#2168ab] text-white text-base font-semibold rounded-xl shadow-xs transition-colors cursor-pointer w-full sm:w-auto">
                        Edit Unit Details
                    </a>

                    <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                        class="w-full sm:w-auto"
                        onsubmit="return confirm('Are you sure you want to delete this department? Employees inside this unit will retain profiles but lose department routing links.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-5 py-2.5 bg-white border border-rose-200 text-rose-600 text-base font-semibold rounded-xl hover:bg-rose-50 transition-colors shadow-xs cursor-pointer w-full">
                            Delete Department
                        </button>
                    </form>
                @endif

                <a href="{{ route('departments.index') }}"
                    class="text-center px-5 py-2.5 text-base font-semibold text-[#2168ab] bg-[#f8fafc] border border-[#e2e8f0] rounded-xl hover:bg-[#eaf3fb] hover:text-[#103456] transition-colors shadow-xs w-full sm:w-auto sm:ml-auto">
                    Back to Departments
                </a>
            </div>

        </div>
    </div>
</x-app-layout>