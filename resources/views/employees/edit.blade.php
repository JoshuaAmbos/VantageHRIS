<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Employee') }}: {{ $employee->first_name }} {{ $employee->last_name }}
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow-sm sm:rounded-xl border border-gray-100 overflow-hidden mt-6">

        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 p-4 m-6 mb-0 rounded-r-lg">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="p-8">
            <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Names --}}
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-vantage-900 mb-1">First
                            Name</label>
                        <input type="text" name="first_name" id="first_name"
                            value="{{ old('first_name', $employee->first_name) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-vantage-900 mb-1">Last
                            Name</label>
                        <input type="text" name="last_name" id="last_name"
                            value="{{ old('last_name', $employee->last_name) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                    </div>

                    {{-- Contact Info --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-vantage-900 mb-1">Email
                            Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-semibold text-vantage-900 mb-1">Phone
                            Number</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-semibold text-vantage-900 mb-1">Residential
                            Address</label>
                        <textarea name="address" id="address" rows="3"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">{{ old('address', $employee->address) }}</textarea>
                    </div>

                    {{-- Organizational Info --}}
                    <div class="md:col-span-2 pt-4 border-t border-gray-100"></div>

                    <div>
                        <label for="department_id"
                            class="block text-sm font-semibold text-vantage-900 mb-1">Department</label>
                        <select name="department_id" id="department_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="position" class="block text-sm font-semibold text-vantage-900 mb-1">Position</label>
                        <select name="position" id="position"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            @foreach([\App\Models\Employee::POSITION_SOFTWARE_ENGINEER, \App\Models\Employee::POSITION_MANAGER, \App\Models\Employee::POSITION_HR_STAFF, \App\Models\Employee::POSITION_ADMIN, \App\Models\Employee::POSITION_ACCOUNTANT] as $pos)
                                <option value="{{ $pos }}" {{ old('position', $employee->position) == $pos ? 'selected' : '' }}>
                                    {{ $pos }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="hire_date" class="block text-sm font-semibold text-vantage-900 mb-1">Hire
                            Date</label>
                        <input type="date" name="hire_date" id="hire_date"
                            value="{{ old('hire_date', $employee->hire_date) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                    </div>

                    <div>
                        <label for="employment_status"
                            class="block text-sm font-semibold text-vantage-900 mb-1">Status</label>
                        <select name="employment_status" id="employment_status"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            @foreach([\App\Models\Employee::STATUS_FULL_TIME, \App\Models\Employee::STATUS_PART_TIME] as $status)
                                <option value="{{ $status }}" {{ old('employment_status', $employee->employment_status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                    <a href="{{ route('employees.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-vantage-800 rounded-lg hover:bg-vantage-900 focus:ring-4 focus:ring-vantage-500/30 transition-colors shadow-sm">
                        Update Employee Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>