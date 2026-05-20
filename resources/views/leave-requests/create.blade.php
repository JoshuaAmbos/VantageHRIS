<x-app-layout>
    <x-slot name="header">
        {{ __('Request Leave') }}
    </x-slot>

    {{-- Unified Form Box Wrapper --}}
    <div
        class="max-w-4xl mx-auto bg-white shadow-sm rounded-xl border border-[#e2e8f0] overflow-hidden mt-6 mx-2 sm:mx-auto">
        <div class="px-6 py-5 sm:px-8 sm:py-6 border-b border-[#e2e8f0] bg-[#f8fafc]">
            <h3 class="text-xl font-bold text-[#081a2b] tracking-tight">Request a Leave</h3>
            <p class="text-sm sm:text-base text-[#2168ab] mt-1">Please fill out the details below to request a leave.
            </p>
        </div>

        <div class="p-4 sm:p-8">
            <form action="{{ route('leave-requests.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                    {{-- Leave Type --}}
                    <div class="md:col-span-2">
                        <label for="leave_type" class="block text-base font-bold text-[#081a2b] mb-1.5">Type of Leave
                            <span class="text-rose-500">*</span></label>
                        <select name="leave_type" id="leave_type"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            <option value="{{ App\Models\LeaveRequest::LEAVE_TYPE_PERSONAL }}">Personal</option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                                    {{ str($type)->title() }}
                                </option>
                            @endforeach
                        </select>
                        @error('leave_type')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Start Date --}}
                    <div>
                        <label for="start_date" class="block text-base font-bold text-[#081a2b] mb-1.5">Start Date <span
                                class="text-rose-500">*</span></label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('start_date')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- End Date --}}
                    <div>
                        <label for="end_date" class="block text-base font-bold text-[#081a2b] mb-1.5">End Date <span
                                class="text-rose-500">*</span></label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('end_date')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Reason --}}
                    <div class="md:col-span-2">
                        <label for="reason" class="block text-base font-bold text-[#081a2b] mb-1.5">Reason <span
                                class="text-rose-500">*</span></label>
                        <textarea name="reason" id="reason" rows="4"
                            placeholder="Please provide details regarding your request..."
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs resize-none">{{ old('reason') }}</textarea>
                        @error('reason')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Footer Operations Section --}}
                <div
                    class="mt-8 pt-6 border-t border-[#e2e8f0] flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('leave-requests.index') }}"
                        class="w-full sm:w-auto text-center px-5 py-2.5 text-base font-semibold text-[#2168ab] bg-[#f8fafc] border border-[#e2e8f0] rounded-xl hover:bg-[#eaf3fb] hover:text-[#103456] transition-colors shadow-xs">
                        Cancel
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 text-base font-semibold text-white bg-[#2982d6] hover:bg-[#2168ab] rounded-xl shadow-xs transition-colors cursor-pointer">
                        Submit Leave Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>