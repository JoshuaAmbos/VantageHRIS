<x-app-layout>
    <x-slot name="header">
        {{ __('Register New Department') }}
    </x-slot>

    <div
        class="max-w-4xl mx-auto bg-white shadow-sm rounded-xl border border-[#e2e8f0] overflow-hidden mt-6 mx-2 sm:mx-auto">
        <div class="px-6 py-5 sm:px-8 sm:py-6 border-b border-[#e2e8f0] bg-[#f8fafc]">
            <h3 class="text-xl font-bold text-[#081a2b] tracking-tight">Department Information</h3>
            <p class="text-sm sm:text-base text-[#2168ab] mt-1">Please fill out the details below to add a new
                department to the organization.</p>
        </div>

        {{-- Form --}}
        <div class="p-4 sm:p-8">
            <form action="{{ route('departments.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                    {{-- Name --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="name" class="block text-base font-bold text-[#081a2b] mb-1.5">Department Name <span
                                class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">

                        @error('name')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Department Manager Selection Field -->
                    <div class="col-span-2 md:col-span-1">
                        <label for="manager_id" class="block text-base font-bold text-[#081a2b] mb-1.5">
                            Department Manager <span class="text-xs text-slate-400 font-normal">(Optional)</span>
                        </label>

                        <select name="manager_id" id="manager_id"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                            <option value="">Select a Manager</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('manager_id') == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }} {{ $employee->last_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('manager)id')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-span-2">
                        <label for="description" class="block text-base font-bold text-[#081a2b] mb-1.5">Description
                            <span style="color: red">*</span></label>
                        <textarea name="description" id="description" value="{{ old('description') }}" rows="2"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        </textarea>

                        @error('description')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Buttons --}}
                <div
                    class="mt-8 pt-6 border-t border-[#e2e8f0] flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('departments.index') }}"
                        class="w-full sm:w-auto text-center px-5 py-2.5 text-base font-semibold text-[#2168ab] bg-[#f8fafc] border border-[#e2e8f0] rounded-xl hover:bg-[#eaf3fb] hover:text-[#103456] transition-colors shadow-xs">
                        Cancel
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 text-base font-semibold text-white bg-[#2982d6] hover:bg-[#2168ab] rounded-xl shadow-xs transition-colors cursor-pointer">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>