<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Department') }}: {{ $department->name }}
    </x-slot>

    <div
        class="max-w-4xl mx-auto bg-white shadow-sm rounded-xl border border-[#e2e8f0] overflow-hidden mt-6 mx-2 sm:mx-auto">

        {{-- Error notification summary --}}
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

        {{-- Form --}}
        <div class="p-4 sm:p-8">
            <form action="{{ route('departments.update', $department->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')

                <input type="hidden" name="status" value="{{ $department->status }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                    {{-- Name --}}
                    <div class="col-span-2 md:col-span-1">
                        <label for="name" class="block text-base font-bold text-[#081a2b] mb-1.5">Department Name <span
                                class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $department->name) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">

                        @error('name')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label for="manager_id" class="block text-base font-bold text-[#081a2b] mb-1.5">
                            Department Manager <span class="text-xs text-slate-400 font-normal">(Optional)</span>
                        </label>

                        <select name="manager_id" id="manager_id"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                            <option value="">None</option>
                            @foreach($employees as $employee)

                                <option value="{{ $employee->id }}" {{ old('manager_id', $department->manager_id) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                </option>
                            @endforeach
                        </select>

                        @error('manager_id')
                            <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="col-span-2">
                        <label for="description" class="block text-base font-bold text-[#081a2b] mb-1.5">Description
                            <span class="text-rose-500">*</span></label>

                        <textarea name="description" id="description" rows="3"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">{{ old('description', $department->description) }}</textarea>

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
                        Update Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>