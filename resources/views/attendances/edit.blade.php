<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Attendance Record') }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-lg">
        <form action="{{ route('attendances.update', $attendance->id) }}" method="POST">
            @csrf
            @method("PATCH")

            <!-- Employee Dropdown -->
            <div class="mb-4">
                <label for="employee_id" class="block font-medium text-sm text-gray-700">Employee Name</label>
                <select name="employee_id" id="employee_id" class="w-full rounded border-gray-300 shadow-sm">
                    @foreach ($employees as $employee)
                        <!-- FIXED: Changed old('employee') to check old('employee_id') and added $attendance->employee_id fallback -->
                        <option value="{{ $employee->id }}" {{ old('employee_id', $attendance->employee_id) == $employee->id ? 'selected' : '' }}>
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date Input -->
            <div class="mb-4">
                <label for="attendance_date" class="block font-medium text-sm text-gray-700">Date</label>
                <!-- FIXED: Added old() handling wrapper around the date value string -->
                <input type="date" id="attendance_date" name="attendance_date"
                    value="{{ old('attendance_date', $attendance->attendance_date) }}"
                    class="w-full rounded border-gray-300 shadow-sm"><br>
                @error('attendance_date')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Time Wrappers -->
            <div class="mb-4 flex gap-4">
                <div class="w-1/2">
                    <label for="time_in" class="block font-medium text-sm text-gray-700">Time In</label>
                    <!-- FIXED: Formatted string to H:i time text so HTML5 inputs read it perfectly -->
                    <input type="time" id="time_in" name="time_in"
                        value="{{ old('time_in', \Carbon\Carbon::parse($attendance->time_in)->format('H:i')) }}"
                        class="w-full rounded border-gray-300 shadow-sm"><br>
                    @error('time_in')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="w-1/2">
                    <label for="time_out" class="block font-medium text-sm text-gray-700">Time Out</label>
                    <!-- FIXED: Formatted string to H:i time text so HTML5 inputs read it perfectly -->
                    <input type="time" id="time_out" name="time_out"
                        value="{{ old('time_out', \Carbon\Carbon::parse($attendance->time_out)->format('H:i')) }}"
                        class="w-full rounded border-gray-300 shadow-sm"><br>
                    @error('time_out')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Status Dropdown -->
            <div class="mb-4">
                <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                <select name="status" id="status" class="w-full rounded border-gray-300 shadow-sm">
                    @foreach ($statuses as $status)
                        <!-- FIXED: Added $attendance->status fallback choice checker inside old() method -->
                        <option value="{{ $status }}" {{ old('status', $attendance->status) == $status ? 'selected' : '' }}>
                            {{ str($status)->title() }}
                        </option>
                    @endforeach
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remarks Input -->
            <div class="mb-6">
                <label for="remarks" class="block font-medium text-sm text-gray-700">Remarks (optional)</label>
                <input type="text" name="remarks" id="remarks" value="{{ old('remarks', $attendance->remarks) }}"
                    class="w-full rounded border-gray-300 shadow-sm"><br>
                @error('remarks')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions buttons -->
            <div class="flex items-center gap-2">
                <a href="{{ route('attendances.index') }}" class="px-4 py-2 rounded text-white"
                    style="background-color: gray; text-decoration: none; display: inline-block;">
                    Cancel
                </a>
                <button type="submit" class="px-4 py-2 rounded text-white" style="background-color: deepskyblue;">
                    Update Record
                </button>
            </div>
        </form>
    </div>
</x-app-layout>