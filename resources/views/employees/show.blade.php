<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employee Details') }}: {{ $employee->first_name }} {{ $employee->last_name }}
            </h2>
            <a href="{{ route('employees.index') }}" class="text-sm text-blue-600 hover:underline">
                &larr; Back to List
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Profile Header -->
                <div class="border-b pb-4 mb-6 flex justify-between items-start">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">{{ $employee->first_name }}
                            {{ $employee->last_name }}
                        </h3>
                        <p class="text-gray-500">{{ $employee->position }} | {{ $employee->department->name }}</p>
                    </div>
                    <span
                        class="px-3 py-1 rounded-full text-sm font-semibold {{ $employee->employment_status === 'Full-time' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ $employee->employment_status }}
                    </span>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

                    <!-- Personal & Contact Info -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-700 uppercase tracking-wider text-xs">Contact Information
                        </h4>
                        <div>
                            <p class="text-sm text-gray-500">Email Address</p>
                            <p class="font-medium">{{ $employee->email }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Phone Number</p>
                            <p class="font-medium">{{ $employee->phone }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Residential Address</p>
                            <p class="font-medium">{{ $employee->address }}</p>
                        </div>
                    </div>

                    <!-- Employment Info -->
                    <div class="space-y-4">
                        <h4 class="font-semibold text-gray-700 uppercase tracking-wider text-xs">Employment Details</h4>
                        <div>
                            <p class="text-sm text-gray-500">Date of Hire</p>
                            <p class="font-medium">{{ \Carbon\Carbon::parse($employee->hire_date)->format('M d, Y') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Department</p>
                            <p class="font-medium">{{ $employee->department->name }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">System Account ID</p>
                            <p class="font-medium text-gray-400 italic">
                                {{ $employee->user_id ? 'Linked to User #' . $employee->user_id : 'No linked system account' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer Actions -->
                <div class="mt-10 pt-6 border-t flex gap-4">
                    <a href="{{ route('employees.edit', $employee->id) }}"
                        class="px-4 py-2 bg-sky-500 text-white rounded-md hover:bg-sky-600 transition">
                        Edit Record
                    </a>

                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this employee?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 transition">
                            Delete Employee
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>