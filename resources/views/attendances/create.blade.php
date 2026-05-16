<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Attendances') }}
        </h2>
    </x-slot>

    {{-- form --}}
    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <label for="employee_id">Employee Name</label>
        <select name="employee_id" id="employee_id">
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}" {{ old('employee') == $employee->id ? 'selected' : '' }}>
                    {{ $employee->first_name }} {{ $employee->last_name }}
                </option>
            @endforeach
        </select>


        <label for="attendance_date">Date</label>
        <input type="date" id="attendance_date" name="attendance_date"><br>

        <label for="time_in">Time In</label>
        <input type="time" id="time_in" name="time_in"><br>

        <label for="time_out">Time Out</label>
        <input type="time" id="time_out" name="time_out"><br>

        <label for="status">Status</label>
        <select name="status" id="status">
            @foreach ($statuses as $status)
                <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                    {{ str($status)->title() }}
                </option>
            @endforeach
        </select>

        @error('status')
            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
        @enderror

        <label for="remarks">Remarks (optional)</label>
        <input type="text" name="remarks" id="remarks"><br>

        <a href="{{ route('attendances.index') }}" class="px-4 py-2 rounded text-white"
            style="background-color: gray; text-decoration: none; display: inline-block;">
            Cancel
        </a>
        <button type="submit" class="px-4 py-2 rounded text-white" style="background-color: deepskyblue;">
            Save Attendance
        </button>
    </form>
</x-app-layout>