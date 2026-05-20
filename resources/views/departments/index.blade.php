<x-app-layout>
    <x-slot name="header">
        {{ __('Departments Directory') }}
    </x-slot>

    <div class="mt-6 px-2 sm:px-0">
        <h3 class="text-xl font-bold text-[#081a2b] mb-6 tracking-tight">All Departments</h3>

        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4 mb-6">
            <div class="w-full sm:max-w-xs">
                <x-search-bar :action="route('departments.index')" :value="$search"
                    placeholder="Search departments..." />
            </div>

            <a href="{{ route('departments.create') }}"
                class="inline-flex items-center justify-center px-4 py-2.5 bg-[#2982d6] hover:bg-[#2168ab] text-white text-base font-semibold rounded-xl shadow-xs transition-colors cursor-pointer w-full sm:w-auto">
                <svg class="w-5 h-5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                New Department
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden flex flex-col w-full">
            <div class="overflow-x-auto min-w-full">
                <table class="min-w-full divide-y divide-[#e2e8f0] table-auto">
                    <thead class="bg-[#f8fafc]">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Department Name</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Description</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Manager</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-4 text-center text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#e2e8f0]">
                        @forelse ($departments as $department)
                            <tr class="hover:bg-[#f8fafc]/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-base font-bold text-[#081a2b]">{{ $department->name }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-base text-[#103456] truncate max-w-xs"
                                        title="{{ $department->description }}">{{ $department->description }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-base text-[#081a2b] font-semibold">
                                        @if ($department->manager)
                                            {{ $department->manager->first_name }} {{ $department->manager->last_name }}
                                        @else
                                            <span class="text-slate-400 italic font-normal">No manager assigned</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if(($department->status ?? 'active') === 'active')
                                        <span
                                            class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-green-300 text-green-900">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="px-3 py-1 inline-flex text-xs font-bold rounded-full bg-red-300 text-red-900">
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-right text-base font-semibold">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('departments.show', $department->id) }}"
                                            class="text-[#2982d6] hover:text-[#103456] bg-[#eaf3fb] hover:bg-[#d4e6f7] px-3 py-1.5 rounded-lg transition-colors text-sm font-bold shadow-xs">View</a>

                                        <a href="{{ route('departments.edit', $department->id) }}"
                                            class="text-[#103456] hover:text-[#081a2b] bg-[#f8fafc] hover:bg-[#e2e8f0] px-3 py-1.5 rounded-lg transition-colors border border-[#e2e8f0] text-sm font-bold shadow-xs">Edit</a>

                                        <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Delete this department?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-3 py-1.5 rounded-lg transition-colors text-sm font-bold border border-rose-100 shadow-xs cursor-pointer">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-400 italic bg-white">
                                    No departments found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($departments, 'links') && $departments->hasPages())
                <div class="px-6 py-4 border-t border-[#e2e8f0] bg-[#f8fafc]">
                    {{ $departments->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>