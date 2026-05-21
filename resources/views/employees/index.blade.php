<x-app-layout>
    <x-slot name="header">
        {{ __('Employee Directory') }}
    </x-slot>

    <div class="mt-6 px-2 sm:px-0">
        <h3 class="text-xl font-bold text-[#081a2b] mb-6 tracking-tight">All Employees</h3>

        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4 mb-6">
            <div class="w-full sm:max-w-xs">
                <x-search-bar :action="route('employees.index')" :value="$search" placeholder="Search employees..." />
            </div>

            <a href="{{ route('employees.create') }}"
                class="inline-flex items-center justify-center px-4 py-2.5 bg-[#2982d6] hover:bg-[#2168ab] text-white text-base font-semibold rounded-xl shadow-xs transition-colors cursor-pointer w-full sm:w-auto">
                <svg class="w-5 h-5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                New Employee
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden flex flex-col w-full">
            <div class="overflow-x-auto min-w-full">
                <table class="min-w-full divide-y divide-[#e2e8f0] table-auto">
                    <thead class="bg-[#f8fafc]">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Employee Name</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Contact</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Department</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Position</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-4 text-center text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#e2e8f0]">
                        @forelse ($employees as $employee)
                            <tr class="hover:bg-[#f8fafc]/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="h-10 w-10 rounded-full bg-[#eaf3fb] border border-[#d4e6f7] text-[#184e81] flex items-center justify-center font-bold text-sm shadow-xs flex-shrink-0">
                                            {{ substr($employee->first_name ?? 'E', 0, 1) }}{{ substr($employee->last_name ?? 'P', 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-base font-bold text-[#081a2b]">
                                                {{ $employee->first_name }} {{ $employee->last_name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-base text-[#2168ab] font-medium">{{ $employee->email }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-base text-[#103456]">{{ $employee->department->name ?? 'N/A' }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-base text-[#081a2b] font-semibold">{{ $employee->position }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(strtolower($employee->employment_status) === 'full-time' || strtolower($employee->employment_status) === 'permanent')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-green-300 text-green-900">
                                            {{ $employee->employment_status }}
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-blue-300 text-blue-900">
                                            {{ $employee->employment_status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-base font-semibold">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('employees.show', $employee->id) }}"
                                            class="text-[#2982d6] hover:text-[#103456] bg-[#eaf3fb] hover:bg-[#d4e6f7] px-3 py-1.5 rounded-lg transition-colors text-sm font-bold shadow-xs">View</a>
                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                            class="text-[#103456] hover:text-[#081a2b] bg-[#f8fafc] hover:bg-[#e2e8f0] px-3 py-1.5 rounded-lg transition-colors border border-[#e2e8f0] text-sm font-bold shadow-xs">Edit</a>

                                        @if (Auth::user()->role == App\Models\User::ROLE_ADMIN)
                                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                                class="inline" onsubmit="return confirm('Delete this employee?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition-colors text-sm font-bold border border-rose-100 shadow-xs cursor-pointer">Delete</button>
                                            </form>
                                        @endif

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-400 italic bg-white">
                                    No employee records found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($employees, 'links') && $employees->hasPages())
                <div class="px-6 py-4 border-t border-[#e2e8f0] bg-[#f8fafc] mt-auto">
                    {{ $employees->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>