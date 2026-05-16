<x-app-layout>
    <x-slot name="header">
        {{ __('Register New Employee') }}
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow-sm sm:rounded-xl border border-gray-100 overflow-hidden mt-6">
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-bold text-vantage-900">Employee Information</h3>
            <p class="text-sm text-slate-500">Please fill out the details below to add a new member to the organization.
            </p>
        </div>

        <div class="p-8">
            <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- 1. Names --}}
                    <div>
                        <label for="first_name" class="block text-sm font-semibold text-vantage-900 mb-1">First
                            Name <span style="color: red">*</span></label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-semibold text-vantage-900 mb-1">Last
                            Name <span style="color: red">*</span></label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- 2. Contact Info --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-vantage-900 mb-1">Email
                            Address <span style="color: red">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-sm font-semibold text-vantage-900 mb-1">Phone
                            Number <span style="color: red">*</span></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="block text-sm font-semibold text-vantage-900 mb-1">Residential
                            Address <span style="color: red">*</span></label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- 3. Organizational Details --}}
                    <div class="md:col-span-2 pt-4 border-t border-gray-100">
                        <h4 class="text-sm font-bold text-vantage-800 uppercase tracking-wider mb-4">Employment Details
                        </h4>
                    </div>

                    <div>
                        <label for="department_id"
                            class="block text-sm font-semibold text-vantage-900 mb-1">Department</label>
                        <select name="department_id" id="department_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            <option value="">None</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="position" class="block text-sm font-semibold text-vantage-900 mb-1">Position <span
                                style="color: red">*</span></label>
                        <select name="position" id="position"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            <option value="{{ \App\Models\Employee::POSITION_SOFTWARE_ENGINEER }}">Software Engineer
                            </option>
                            <option value="{{ \App\Models\Employee::POSITION_MANAGER }}">Manager</option>
                            <option value="{{ \App\Models\Employee::POSITION_HR_STAFF }}">HR Staff</option>
                            <option value="{{ \App\Models\Employee::POSITION_ADMIN }}">Administrator</option>
                            <option value="{{ \App\Models\Employee::POSITION_ACCOUNTANT }}">Accountant</option>
                        </select>
                    </div>

                    <div>
                        <label for="employment_status" class="block text-sm font-semibold text-vantage-900 mb-1">Status
                            <span style="color: red">*</span></label>
                        <select name="employment_status" id="employment_status"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            <option value="{{ \App\Models\Employee::STATUS_FULL_TIME }}">Full-time</option>
                            <option value="{{ \App\Models\Employee::STATUS_PART_TIME }}">Part-time</option>
                        </select>
                    </div>

                    <div>
                        <label for="hire_date" class="block text-sm font-semibold text-vantage-900 mb-1">Hire
                            Date <span style="color: red">*</span></label>
                        <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date') }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        @error('hire_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                    <a href="{{ route('employees.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-vantage-800 rounded-lg hover:bg-vantage-900 focus:ring-4 focus:ring-vantage-500/30 transition-colors shadow-sm">
                        Save Employee Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>