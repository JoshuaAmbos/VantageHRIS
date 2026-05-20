<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Attendance Record') }}
    </x-slot>

    <div
        class="max-w-4xl mx-auto bg-white shadow-sm rounded-xl border border-[#e2e8f0] overflow-hidden mt-6 mx-2 sm:mx-auto">

        {{-- Error Notification --}}
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
            <form action="{{ route('attendances.update', $attendance->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                    {{-- Employee --}}
                    <div>
                        <label for="employee_id" class="block text-base font-bold text-[#081a2b] mb-1.5">Employee
                            Name</label>
                        <select name="employee_id" id="employee_id"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id', $attendance->employee_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Date --}}
                    <div>
                        <label for="attendance_date"
                            class="block text-base font-bold text-[#081a2b] mb-1.5">Date</label>
                        <input type="date" id="attendance_date" name="attendance_date"
                            value="{{ old('attendance_date', $attendance->attendance_date) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('attendance_date')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Time In --}}
                    <div>
                        <label for="time_in" class="block text-base font-bold text-[#081a2b] mb-1.5">Time In</label>
                        <input type="time" id="time_in" name="time_in"
                            value="{{ old('time_in', $attendance->time_in ? \Carbon\Carbon::parse($attendance->time_in)->format('H:i') : '') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('time_in')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Time Out --}}
                    <div>
                        <label for="time_out" class="block text-base font-bold text-[#081a2b] mb-1.5">Time Out</label>
                        <input type="time" id="time_out" name="time_out"
                            value="{{ old('time_out', $attendance->time_out ? \Carbon\Carbon::parse($attendance->time_out)->format('H:i') : '') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('time_out')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label for="status" class="block text-base font-bold text-[#081a2b] mb-1.5">Status</label>
                        <select name="status" id="status"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" {{ old('status', $attendance->status) == $status ? 'selected' : '' }}>
                                    {{ str($status)->title() }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Remarks --}}
                    <div class="md:col-span-2">
                        <label for="remarks" class="block text-base font-bold text-[#081a2b] mb-1.5">Remarks
                            (Optional)</label>
                        <input type="text" name="remarks" id="remarks"
                            value="{{ old('remarks', $attendance->remarks) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                        @error('remarks')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div
                    class="mt-8 pt-6 border-t border-[#e2e8f0] flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('attendances.index') }}"
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