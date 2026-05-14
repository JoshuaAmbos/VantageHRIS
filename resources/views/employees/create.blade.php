<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Add Employee') }}</h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf

            {{-- 1. Department --}}
            <label for="department_id">Department</label><br>
            <select name="department_id" id="department_id" class="rounded border-gray-300">
                <option value="">Select Department</option>
                @foreach($departments as $dept)
                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                        {{ $dept->name }}
                    </option>
                @endforeach
            </select>
            @error('department_id') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            <br><br>

            {{-- 2. Names --}}
            <div class="flex gap-4">
                <div>
                    <label for="first_name">First Name</label><br>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}">
                    @error('first_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label for="last_name">Last Name</label><br>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}">
                    @error('last_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                </div>
            </div>
            <br>

            {{-- 3. Position (Using your Model Constants) --}}
            <label for="position">Position</label><br>
            <select name="position" id="position">
                <option value="{{ \App\Models\Employee::POSITION_SOFTWARE_ENGINEER }}">Software Engineer</option>
                <option value="{{ \App\Models\Employee::POSITION_MANAGER }}">Manager</option>
                <option value="{{ \App\Models\Employee::POSITION_HR_STAFF }}">HR Staff</option>
                <option value="{{ \App\Models\Employee::POSITION_ADMIN }}">Administrator</option>
                <option value="{{ \App\Models\Employee::POSITION_ACCOUNTANT }}">Accountant</option>
            </select>
            <br><br>

            {{-- 4. Employment Status --}}
            <label for="employment_status">Employment Status</label><br>
            <select name="employment_status" id="employment_status">
                <option value="{{ \App\Models\Employee::STATUS_FULL_TIME }}">Full-time</option>
                <option value="{{ \App\Models\Employee::STATUS_PART_TIME }}">Part-time</option>
            </select>
            <br><br>

            {{-- 5. Contact Info --}}
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            <br>

            <label for="phone">Phone</label><br>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
            @error('phone') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            <br>

            <label for="address">Address</label><br>
            <input type="text" name="address" id="address" value="{{ old('address') }}">
            @error('address') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            <br>

            <label for="hire_date">Hire Date</label><br>
            <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date') }}">
            @error('hire_date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            <br><br>

            <div class="mt-4">
                <a href="{{ route('employees.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded no-underline inline-block">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-sky-500 text-white rounded">Save Employee</button>
            </div>
        </form>
    </div>
</x-app-layout>