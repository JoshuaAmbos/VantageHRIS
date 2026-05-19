<x-app-layout>
    <x-slot name="header">
        {{ __('Edit User Account') }}
    </x-slot>

    <div class="max-w-4xl mx-auto bg-white shadow-sm sm:rounded-xl border border-gray-100 overflow-hidden mt-6">
        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-lg font-bold text-vantage-900">Modify Login Credentials</h3>
            <p class="text-sm text-slate-500">Update access levels or manage credentials for this system user account.
            </p>
        </div>

        <div class="p-8">
            <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">

                    {{-- Linked Employee Metadata --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-400 mb-1">Linked Employee Profile</label>
                        <div
                            class="w-full rounded-lg bg-slate-50 border border-slate-200 px-4 py-2.5 text-sm text-slate-700 font-medium">
                            @if($user->employee)
                                {{ $user->employee->last_name }}, {{ $user->employee->first_name }}
                                <span
                                    class="text-xs text-slate-400 ml-1">({{ $user->employee->department->name ?? 'No Department' }})</span>
                            @else
                                <span class="text-amber-600 italic">No Employee Profile Associated</span>
                            @endif
                        </div>
                    </div>

                    {{-- Account Name --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-vantage-900 mb-1">Account Display Name
                            <span style="color: red">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-vantage-900 mb-1">Login Email Address
                            <span style="color: red">*</span></label>
                        <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Role --}}
                    <div>
                        <label for="role" class="block text-sm font-semibold text-vantage-900 mb-1">System Access Level
                            <span style="color: red">*</span></label>
                        <select name="role" id="role"
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            @foreach ($roles as $roleOption)
                                <option value="{{ $roleOption }}" {{ old('role', $user->role) == $roleOption ? 'selected' : '' }}>
                                    {{ str($roleOption)->title() }}
                                </option>
                            @endforeach
                        </select>
                        @error('role') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Security Credentials Notice --}}
                    <div class="pt-4 border-t border-gray-100">
                        <h4 class="text-sm font-bold text-slate-800 mb-1">Update Password</h4>
                        <p class="text-xs text-slate-400">Leave the fields below completely blank if you want to keep
                            the current password intact.</p>
                    </div>

                    {{-- Password --}}
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="password" class="block text-sm font-semibold text-vantage-900 mb-1">New
                                Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                            @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="password_confirmation"
                                class="block text-sm font-semibold text-vantage-900 mb-1">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                placeholder="••••••••"
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
                        Update User Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>