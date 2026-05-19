<x-app-layout>
    <x-slot name="header">
        {{ __('Register New Employee') }}
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow-sm rounded-xl border border-[#e2e8f0] overflow-hidden mt-6 mx-2 sm:mx-auto">
        <div class="px-6 py-5 sm:px-8 sm:py-6 border-b border-[#e2e8f0] bg-[#f8fafc]">
            <h3 class="text-xl font-bold text-[#081a2b] tracking-tight">Employee Information</h3>
            <p class="text-sm sm:text-base text-[#2168ab] mt-1">Please fill out the details below to add a new member to the organization.</p>
        </div>

        <div class="p-4 sm:p-8">
            <form action="{{ route('employees.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                    {{-- 1. Names --}}
                    <div>
                        <label for="first_name" class="block text-base font-bold text-[#081a2b] mb-1.5">First Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                        @error('first_name')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name" class="block text-base font-bold text-[#081a2b] mb-1.5">Last Name <span class="text-rose-500">*</span></label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                        @error('last_name')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 2. Contact Info --}}
                    <div>
                        <label for="email" class="block text-base font-bold text-[#081a2b] mb-1.5">Email Address <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                        @error('email')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="phone" class="block text-base font-bold text-[#081a2b] mb-1.5">Phone Number <span class="text-rose-500">*</span></label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                        @error('phone')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="block text-base font-bold text-[#081a2b] mb-1.5">Residential Address <span class="text-rose-500">*</span></label>
                        <input type="text" name="address" id="address" value="{{ old('address') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                        @error('address')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 3. Organizational Details --}}
                    <div class="md:col-span-2 pt-4 border-t border-[#e2e8f0]">
                        <h4 class="text-xs font-bold text-[#2168ab] uppercase tracking-widest mb-4">Employment Details</h4>
                    </div>

                    <div>
                        <label for="department_id" class="block text-base font-bold text-[#081a2b] mb-1.5">Department</label>
                        <div class="relative">
                            <select name="department_id" id="department_id"
                                class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                                <option value="">None</option>
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('department_id')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="position" class="block text-base font-bold text-[#081a2b] mb-1.5">Position <span class="text-rose-500">*</span></label>
                        <select name="position" id="position"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            <option value="{{ \App\Models\Employee::POSITION_SOFTWARE_ENGINEER }}">Software Engineer</option>
                            <option value="{{ \App\Models\Employee::POSITION_MANAGER }}">Manager</option>
                            <option value="{{ \App\Models\Employee::POSITION_HR_STAFF }}">HR Staff</option>
                            <option value="{{ \App\Models\Employee::POSITION_ADMIN }}">Administrator</option>
                            <option value="{{ \App\Models\Employee::POSITION_ACCOUNTANT }}">Accountant</option>
                        </select>
                    </div>

                    <div>
                        <label for="employment_status" class="block text-base font-bold text-[#081a2b] mb-1.5">Status <span class="text-rose-500">*</span></label>
                        <select name="employment_status" id="employment_status"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            <option value="{{ \App\Models\Employee::STATUS_FULL_TIME }}">Full-time</option>
                            <option value="{{ \App\Models\Employee::STATUS_PART_TIME }}">Part-time</option>
                        </select>
                    </div>

                    <div>
                        <label for="hire_date" class="block text-base font-bold text-[#081a2b] mb-1.5">Hire Date <span class="text-rose-500">*</span></label>
                        <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('hire_date')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-[#e2e8f0] flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('employees.index') }}"
                        class="w-full sm:w-auto text-center px-5 py-2.5 text-base font-semibold text-[#2168ab] bg-[#f8fafc] border border-[#e2e8f0] rounded-xl hover:bg-[#eaf3fb] hover:text-[#103456] transition-colors shadow-xs">
                        Cancel
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 text-base font-semibold text-white bg-[#2982d6] hover:bg-[#2168ab] rounded-xl shadow-xs transition-colors cursor-pointer">
                        Save Employee Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>