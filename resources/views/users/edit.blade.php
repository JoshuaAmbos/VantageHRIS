<x-app-layout>
    <x-slot name="header">
        {{ __('Edit User Account') }}
    </x-slot>

    {{-- Unified Form Frame Panel --}}
    <div
        class="max-w-4xl mx-auto bg-white shadow-sm rounded-xl border border-[#e2e8f0] overflow-hidden mt-6 mx-2 sm:mx-auto">
        <div class="px-6 py-5 sm:px-8 sm:py-6 border-b border-[#e2e8f0] bg-[#f8fafc]">
            <h3 class="text-xl font-bold text-[#081a2b] tracking-tight">Modify Login Credentials</h3>
            <p class="text-sm sm:text-base text-[#2168ab] mt-1">Update access levels or manage credentials for this
                system user account.</p>
        </div>

        <div class="p-4 sm:p-8">
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 sm:gap-6">

                    {{-- Linked Employee Metadata Banner --}}
                    <div class="md:col-span-2">
                        <label class="block text-base font-bold text-[#2168ab] mb-1.5">Linked Employee Profile</label>
                        <div
                            class="w-full rounded-xl bg-[#f8fafc] border border-[#e2e8f0] px-4 py-3 text-base text-[#081a2b] font-semibold shadow-inner">
                            @if($user->employee)
                                {{ $user->employee->last_name }}, {{ $user->employee->first_name }}
                                <span
                                    class="text-sm text-[#549bde] font-medium ml-1">({{ $user->employee->department->name ?? 'No Department' }})</span>
                            @else
                                <span class="text-amber-600 italic font-medium">No Employee Profile Associated</span>
                            @endif
                        </div>
                    </div>

                    {{-- Account Display Name --}}
                    <div>
                        <label for="name" class="block text-base font-bold text-[#081a2b] mb-1.5">Account Display Name
                            <span class="text-rose-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('name') <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email Address --}}
                    <div>
                        <label for="email" class="block text-base font-bold text-[#081a2b] mb-1.5">Login Email Address
                            <span class="text-rose-500">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs">
                        @error('email') <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

                    {{-- Role Dropdown --}}
                    <div class="md:col-span-2">
                        <label for="role" class="block text-base font-bold text-[#081a2b] mb-1.5">System Access Level
                            <span class="text-rose-500">*</span></label>
                        <select name="role" id="role"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] transition-all shadow-xs appearance-none">
                            @foreach ($roles as $roleOption)
                                <option value="{{ $roleOption }}" {{ old('role', $user->role) == $roleOption ? 'selected' : '' }}>
                                    {{ str($roleOption)->title() }}
                                </option>
                            @endforeach
                        </select>
                        @error('role') <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p> @enderror
                    </div>

                    {{-- Security Credentials Notice Split Banner --}}
                    <div class="md:col-span-2 pt-4 border-t border-[#e2e8f0]">
                        <h4 class="text-sm font-bold text-[#2168ab] uppercase tracking-widest mb-1">Update Password</h4>
                        <p class="text-sm text-[#549bde] font-medium">Leave the fields below completely blank if you
                            want to keep the current password intact.</p>
                    </div>

                    {{-- New Password Input --}}
                    <div>
                        <label for="password" class="block text-base font-bold text-[#081a2b] mb-1.5">New
                            Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
                        @error('password') <p class="text-rose-600 text-sm mt-1.5 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password Input --}}
                    <div>
                        <label for="password_confirmation"
                            class="block text-base font-bold text-[#081a2b] mb-1.5">Confirm New Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="••••••••"
                            class="w-full px-4 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">
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
                        Update User Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>