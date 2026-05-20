<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Employee') }}: {{ $employee->first_name }} {{ $employee->last_name }}
    </x-slot>

    <div
        class="max-w-4xl mx-auto bg-white shadow-sm rounded-xl border border-[#e2e8f0] overflow-hidden mt-6 mx-2 sm:mx-auto">

        {{-- Error notif --}}
        @if ($errors->any())
            <div class="bg-rose-50 border-l-4 border-rose-500 p-4 m-4 sm:m-6 mb-0 rounded-r-xl">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-rose-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-bold text-rose-800">Please correct the following errors:</h3>
                        <ul class="mt-2 text-sm text-rose-700 list-disc list-inside font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <div class="p-4 sm:p-8">
            <form action="{{ route('employees.update', $employee->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">
                    {{-- Names --}}
                    <div>
                        <label for="first_name" class="block text-base font-bold text-[#081a2b] mb-1.5">First
                            Name</label>
                        <input type="text" name="first_name" id="first_name"
                            value="{{ old('first_name', $employee->first_name) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                    </div>

                    <div>
                        <label for="last_name" class="block text-base font-bold text-[#081a2b] mb-1.5">Last Name</label>
                        <input type="text" name="last_name" id="last_name"
                            value="{{ old('last_name', $employee->last_name) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                    </div>

                    {{-- Contact Info --}}
                    <div>
                        <label for="email" class="block text-base font-bold text-[#081a2b] mb-1.5">Email Address</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $employee->email) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                    </div>

                    <div>
                        <label for="phone" class="block text-base font-bold text-[#081a2b] mb-1.5">Phone Number</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $employee->phone) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                    </div>

                    <div class="md:col-span-2">
                        <label for="address" class="block text-base font-bold text-[#081a2b] mb-1.5">Residential
                            Address</label>
                        <textarea name="address" id="address" rows="3"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs resize-none">{{ old('address', $employee->address) }}</textarea>
                    </div>

                    {{-- Organizational Info --}}
                    <div class="md:col-span-2 pt-4 border-t border-[#e2e8f0]"></div>

                    <div>
                        <label for="department_id"
                            class="block text-base font-bold text-[#081a2b] mb-1.5">Department</label>
                        <select name="department_id" id="department_id"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            <option value="">None</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="position" class="block text-base font-bold text-[#081a2b] mb-1.5">Position</label>
                        <select name="position" id="position"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            @foreach([\App\Models\Employee::POSITION_SOFTWARE_ENGINEER, \App\Models\Employee::POSITION_MANAGER, \App\Models\Employee::POSITION_HR_STAFF, \App\Models\Employee::POSITION_ADMIN, \App\Models\Employee::POSITION_ACCOUNTANT] as $pos)
                                <option value="{{ $pos }}" {{ old('position', $employee->position) == $pos ? 'selected' : '' }}>
                                    {{ $pos }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="hire_date" class="block text-base font-bold text-[#081a2b] mb-1.5">Hire Date</label>
                        <input type="date" name="hire_date" id="hire_date"
                            value="{{ old('hire_date', $employee->hire_date) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                    </div>

                    <div>
                        <label for="employment_status"
                            class="block text-base font-bold text-[#081a2b] mb-1.5">Status</label>
                        <select name="employment_status" id="employment_status"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            @foreach([\App\Models\Employee::STATUS_FULL_TIME, \App\Models\Employee::STATUS_PART_TIME] as $status)
                                <option value="{{ $status }}" {{ old('employment_status', $employee->employment_status) == $status ? 'selected' : '' }}>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div
                    class="mt-8 pt-6 border-t border-[#e2e8f0] flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('employees.index') }}"
                        class="w-full sm:w-auto text-center px-5 py-2.5 text-base font-semibold text-[#2168ab] bg-[#f8fafc] border border-[#e2e8f0] rounded-xl hover:bg-[#eaf3fb] hover:text-[#103456] transition-colors shadow-xs">
                        Cancel
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 text-base font-semibold text-white bg-[#2982d6] hover:bg-[#2168ab] rounded-xl shadow-xs transition-colors cursor-pointer">
                        Update Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>