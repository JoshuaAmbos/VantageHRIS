<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Employee') }}: {{ $employee->first_name }} {{ $employee->last_name }}
        </h2>
    </x-slot>

    <div class="p-6">
        @if ($errors->any())
            <div
                style="background-color: #fee2e2; color: #dc2626; padding: 1rem; margin-bottom: 1rem; border-radius: 0.5rem;">
                <strong>Validation Errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Names --}}
                <div>
                    <label for="first_name" class="block font-medium text-sm text-gray-700">First Name</label>
                    <input type="text" name="first_name" id="first_name"
                        value="{{ old('first_name', $employee->first_name) }}"
                        class="w-full rounded-md border-gray-300 shadow-sm">
                    @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="last_name" class="block font-medium text-sm text-gray-700">Last Name</label>
                    <input type="text" name="last_name" id="last_name"
                        value="{{ old('last_name', $employee->last_name) }}"
                        class="w-full rounded-md border-gray-300 shadow-sm">
                    @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Contact Info --}}
                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}"
                        class="w-full rounded-md border-gray-300 shadow-sm">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="phone" class="block font-medium text-sm text-gray-700">Phone Number</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}"
                        class="w-full rounded-md border-gray-300 shadow-sm">
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="address" class="block font-medium text-sm text-gray-700">Address</label>
                    <textarea name="address" id="address" rows="3"
                        class="w-full rounded-md border-gray-300 shadow-sm">{{ old('address', $employee->address) }}</textarea>
                    @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                {{-- Organizational Info --}}
                <div>
                    <label for="department_id" class="block font-medium text-sm text-gray-700">Department</label>
                    <select name="department_id" id="department_id" class="w-full rounded-md border-gray-300 shadow-sm">
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="position" class="block font-medium text-sm text-gray-700">Position</label>
                    <select name="position" id="position" class="w-full rounded-md border-gray-300 shadow-sm">
                        @foreach([\App\Models\Employee::POSITION_SOFTWARE_ENGINEER, \App\Models\Employee::POSITION_MANAGER, \App\Models\Employee::POSITION_HR_STAFF, \App\Models\Employee::POSITION_ADMIN, \App\Models\Employee::POSITION_ACCOUNTANT] as $pos)
                            <option value="{{ $pos }}" {{ old('position', $employee->position) == $pos ? 'selected' : '' }}>
                                {{ $pos }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="hire_date" class="block font-medium text-sm text-gray-700">Hire Date</label>
                    <input type="date" name="hire_date" id="hire_date"
                        value="{{ old('hire_date', $employee->hire_date) }}"
                        class="w-full rounded-md border-gray-300 shadow-sm">
                </div>

                <div>
                    <label for="employment_status" class="block font-medium text-sm text-gray-700">Employment
                        Status</label>
                    <select name="employment_status" id="employment_status"
                        class="w-full rounded-md border-gray-300 shadow-sm">
                        @foreach([\App\Models\Employee::STATUS_FULL_TIME, \App\Models\Employee::STATUS_PART_TIME] as $status)
                            <option value="{{ $status }}" {{ old('employment_status', $employee->employment_status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <a href="{{ route('employees.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md no-underline">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-sky-500 text-white rounded-md shadow-sm">Update Employee
                    Record</button>
            </div>
        </form>
    </div>
</x-app-layout>