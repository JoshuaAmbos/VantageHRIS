<x-app-layout>
    <x-slot name="header">
        {{ __('Employee Directory') }}
    </x-slot>

    <div class="mt-6">
        <!-- Table Header & Actions -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-vantage-900">All Employees</h3>
            <a href="{{ route('employees.create') }}"
                class="inline-flex items-center px-4 py-2 bg-vantage-800 text-white text-sm font-bold rounded-lg shadow-sm hover:bg-vantage-900 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Employee
            </a>
        </div>

        <!-- Data Grid -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-vantage-50/50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Employee Name</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Contact</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Role</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-4 text-right text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($employees as $employee)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="h-8 w-8 rounded-full bg-vantage-100 text-vantage-800 flex items-center justify-center font-bold text-xs">
                                            {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-vantage-900">{{ $employee->first_name }}
                                                {{ $employee->last_name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-600">{{ $employee->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-vantage-900 font-medium">{{ $employee->position }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $employee->employment_status === \App\Models\Employee::STATUS_FULL_TIME ? 'bg-vantage-50 text-vantage-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $employee->employment_status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('employees.show', $employee->id) }}"
                                            class="text-vantage-600 hover:text-vantage-900 bg-vantage-50 hover:bg-vantage-100 px-3 py-1 rounded transition-colors">View</a>
                                        <a href="{{ route('employees.edit', $employee->id) }}"
                                            class="text-slate-600 hover:text-vantage-800 bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded transition-colors">Edit</a>

                                        <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Delete this employee?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded transition-colors">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Optional: Pagination links would go here if you paginate your DB query --}}
            @if(method_exists($employees, 'links'))
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $employees->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>