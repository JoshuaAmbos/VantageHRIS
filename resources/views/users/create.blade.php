<x-app-layout>
    <x-slot name="header">
        {{ __('Provision User Account') }}
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow-sm sm:rounded-xl border border-gray-100 overflow-hidden mt-6">
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-bold text-vantage-900">Create Login Credentials</h3>
            <p class="text-sm text-slate-500">Select an unlinked employee profile to grant system access permissions.
            </p>
        </div>

        <div class="p-8">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6">

                    {{-- Employee Selection --}}
                    <div>
                        <label for="employee_id" class="block text-sm font-semibold text-vantage-900 mb-1">Select
                            Employee <span style="color: red">*</span></label>
                        <select name="employee_id" id="employee_id"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            <option value="">Choose an Employee</option>
                            @foreach ($unassignedEmployees as $emp)
                                <option value="{{ $emp->id }}" {{ old('employee_id') == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->last_name }}, {{ $emp->first_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-vantage-900 mb-1">Login Email Address
                            <span style="color: red">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                            placeholder="username@vantage.com"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Role --}}
                    <div>
                        <label for="role" class="block text-sm font-semibold text-vantage-900 mb-1">System Access Level
                            <span style="color: red">*</span></label>
                        <select name="role" id="role"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            <option value="">Choose Access Level</option>

                            @foreach ($roles as $roleOption)
                                <option value="{{ $roleOption }}" {{ old('role') == $roleOption ? 'selected' : '' }}>
                                    {{ str($roleOption)->title() }}
                                </option>
                            @endforeach
                        </select>
                        @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Password --}}
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-vantage-900 mb-1">Password
                                <span style="color: red">*</span></label>
                            <input type="password" name="password" id="password"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-vantage-900 mb-1">Confirm Password <span
                                    style="color: red">*</span></label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        </div>
                    </div>

                </div>

                {{-- Actions --}}
                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                    <a href="{{ route('users.index') }}"
                        class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-bold text-white bg-vantage-800 rounded-lg hover:bg-vantage-900 focus:ring-4 focus:ring-vantage-500/30 transition-colors shadow-sm">
                        Create User Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>