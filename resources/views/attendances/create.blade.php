<x-app-layout>
    <x-slot name="header">
        {{ __('Log Attendance') }}
    </x-slot>

    {{-- Unified Form Box Wrapper --}}
    <div
        class="max-w-4xl mx-auto bg-white shadow-sm rounded-xl border border-[#e2e8f0] overflow-hidden mt-6 mx-2 sm:mx-auto">
        <div class="px-6 py-5 sm:px-8 sm:py-6 border-b border-[#e2e8f0] bg-[#f8fafc]">
            <h3 class="text-xl font-bold text-[#081a2b] tracking-tight">New Attendance Entry</h3>
            <p class="text-sm sm:text-base text-[#2168ab] mt-1">Please fill out the details below to log an attendance
                milestone manually.</p>
        </div>

        <div class="p-4 sm:p-8">
            <form action="{{ route('attendances.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                    {{-- Employee Dropdown --}}
                    <div>
                        <label for="employee_id" class="block text-base font-bold text-[#081a2b] mb-1.5">Employee Name
                            <span class="text-rose-500">*</span></label>
                        <select name="employee_id" id="employee_id"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            <option value="">Select Employee...</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date Input --}}
                    <div>
                        <label for="attendance_date" class="block text-base font-bold text-[#081a2b] mb-1.5">Date <span
                                class="text-rose-500">*</span></label>
                        <input type="date" id="attendance_date" name="attendance_date"
                            value="{{ old('attendance_date', now()->format('Y-m-d')) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('attendance_date')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Time In Input --}}
                    <div>
                        <label for="time_in" class="block text-base font-bold text-[#081a2b] mb-1.5">Time In <span
                                class="text-rose-500">*</span></label>
                        <input type="time" id="time_in" name="time_in" value="{{ old('time_in') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('time_in')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Time Out Input --}}
                    <div>
                        <label for="time_out" class="block text-base font-bold text-[#081a2b] mb-1.5">Time Out</label>
                        <input type="time" id="time_out" name="time_out" value="{{ old('time_out') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('time_out')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status Selection Dropdown --}}
                    <div>
                        <label for="status" class="block text-base font-bold text-[#081a2b] mb-1.5">Status <span
                                class="text-rose-500">*</span></label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            <option value="">Select Status...</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                    {{ str($status)->title() }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remarks Input --}}
                    <div class="md:col-span-2">
                        <label for="remarks" class="block text-base font-bold text-[#081a2b] mb-1.5">Remarks
                            (Optional)</label>
                        <input type="text" name="remarks" id="remarks" value="{{ old('remarks') }}"
                            placeholder="Add any supplementary notes here..."
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                        @error('remarks')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Footer Operations Section --}}
                <div
                    class="mt-8 pt-6 border-t border-[#e2e8f0] flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('attendances.index') }}"
                        class="w-full sm:w-auto text-center px-5 py-2.5 text-base font-semibold text-[#2168ab] bg-[#f8fafc] border border-[#e2e8f0] rounded-xl hover:bg-[#eaf3fb] hover:text-[#103456] transition-colors shadow-xs">
                        Cancel
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 text-base font-semibold text-white bg-[#2982d6] hover:bg-[#2168ab] rounded-xl shadow-xs transition-colors cursor-pointer">
                        Save Attendance
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>