<x-app-layout>
    <x-slot name="header">
        {{ __('Request Leave') }}
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow-sm sm:rounded-xl border border-gray-100 overflow-hidden mt-6">
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-bold text-vantage-900">Request a Leave</h3>
            <p class="text-sm text-slate-500">Please fill out the details below to request a leave.
            </p>
        </div>

        <div class="p-8">
            <form action="{{ route('leave-requests.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6">

                    {{-- Leave Type --}}
                    <div>
                        <label for="leave_type" class="block text-sm font-semibold text-vantage-900 mb-1">Type of
                            Leave <span style="color: red">*</span></label>
                        <select name="leave_type" id="leave_type"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            <option value="{{ App\Models\LeaveRequest::LEAVE_TYPE_PERSONAL }}">Personal</option>
                            @foreach ($types as $type)
                                <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                                    {{ str($type)->title() }}
                                </option>
                            @endforeach
                        </select>
                        @error('leave_type') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Reason --}}
                    <div>
                        <label for="reason" class="block text-sm font-semibold text-vantage-900 mb-1">Reason <span
                                style="color: red">*</span></label>
                        <textarea name="reason" id="reason" value="{{ old('reason') }}" rows="3"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        </textarea>
                        @error('reason') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Dates --}}
                    <div class="grid grid-cols-2 gap-6">

                        {{-- Start Date --}}
                        <div>
                            <label for="start_date" class="block text-sm font-semibold text-vantage-900 mb-1"> Start
                                Date
                                <span style="color: red">*</span></label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            @error('start_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- End Date --}}
                        <div>
                            <label for="end_date" class="block text-sm font-semibold text-vantage-900 mb-1"> End Date
                                <span style="color: red">*</span></label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            @error('end_date') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                </div>

                {{-- Actions --}}
                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                    <a href="{{ route('leave-requests.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-vantage-800 rounded-lg hover:bg-vantage-900 focus:ring-4 focus:ring-vantage-500/30 transition-colors shadow-sm">
                        Submit Leave Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>