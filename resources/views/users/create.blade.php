<x-app-layout>
    <x-slot name="header">
        {{ __('Provision User Account') }}
    </x-slot>

    {{-- Unified Form Box Wrapper --}}
    <div
        class="max-w-4xl mx-auto bg-white shadow-sm rounded-xl border border-[#e2e8f0] overflow-hidden mt-6 mx-2 sm:mx-auto">
        <div class="px-6 py-5 sm:px-8 sm:py-6 border-b border-[#e2e8f0] bg-[#f8fafc]">
            <h3 class="text-xl font-bold text-[#081a2b] tracking-tight">Create Login Credentials</h3>
            <p class="text-sm sm:text-base text-[#2168ab] mt-1">Select an unlinked employee profile to grant system
                access permissions.</p>
        </div>

        <div class="p-4 sm:p-8">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                    {{-- Employee Selection --}}
                    <div class="md:col-span-2">
                        <label for="employee_id" class="block text-base font-bold text-[#081a2b] mb-1.5">Select Employee
                            <span class="text-rose-500">*</span></label>
                        <select name="employee_id" id="employee_id"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            <option value="">Choose an Employee</option>
                            @foreach ($unassignedEmployees as $emp)
                                <option value="{{ $emp->id }}" {{ old('employee_id') == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->last_name }}, {{ $emp->first_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id') <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email Address --}}
                    <div>
                        <label for="email" class="block text-base font-bold text-[#081a2b] mb-1.5">Login Email Address
                            <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            placeholder="username@vantage.com"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                        @error('email') <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

                    {{-- Role Dropdown --}}
                    <div>
                        <label for="role" class="block text-base font-bold text-[#081a2b] mb-1.5">System Access Level
                            <span class="text-rose-500">*</span></label>
                        <select name="role" id="role"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            <option value="">Choose Access Level</option>
                            @foreach ($roles as $roleOption)
                                <option value="{{ $roleOption }}" {{ old('role') == $roleOption ? 'selected' : '' }}>
                                    {{ str($roleOption)->title() }}
                                </option>
                            @endforeach
                        </select>
                        @error('role') <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

                    {{-- Password Input --}}
                    <div>
                        <label for="password" class="block text-base font-bold text-[#081a2b] mb-1.5">Password <span
                                class="text-rose-500">*</span></label>
                        <input type="password" name="password" id="password"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('password') <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Confirmation Input --}}
                    <div>
                        <label for="password_confirmation"
                            class="block text-base font-bold text-[#081a2b] mb-1.5">Confirm Password <span
                                class="text-rose-500">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                    </div>

                </div>

                {{-- Footer Operations Section --}}
                <div
                    class="mt-8 pt-6 border-t border-[#e2e8f0] flex flex-col-reverse sm:flex-row items-center justify-end gap-3">
                    <a href="{{ route('users.index') }}"
                        class="w-full sm:w-auto text-center px-5 py-2.5 text-base font-semibold text-[#2168ab] bg-[#f8fafc] border border-[#e2e8f0] rounded-xl hover:bg-[#eaf3fb] hover:text-[#103456] transition-colors shadow-xs">
                        Cancel
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto px-5 py-2.5 text-base font-semibold text-white bg-[#2982d6] hover:bg-[#2168ab] rounded-xl shadow-xs transition-colors cursor-pointer">
                        Create User Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>