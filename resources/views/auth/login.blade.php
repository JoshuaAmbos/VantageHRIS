<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-bold text-[#081a2b] mb-2">
                {{ __('Email Address') }}
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username" placeholder="name@vantage.com"
                class="block w-full rounded-xl border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-[#081a2b] placeholder-slate-400 shadow-2xs focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] text-base transition-colors" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-600 text-sm font-semibold" />
        </div>

        <div>
            <label for="password" class="block text-sm font-bold text-[#081a2b] mb-2">
                {{ __('Password') }}
            </label>

            <div class="relative" x-data="{ showPassword: false }">

                <input id="password" :type="showPassword ? 'text' : 'password'" {{-- Dynamically masks/unmasks text --}}
                    name="password" required autocomplete="current-password" placeholder="••••••••"
                    class="block w-full rounded-xl border-[#e2e8f0] bg-[#f8fafc] pl-4 pr-12 py-3 text-[#081a2b] placeholder-slate-400 shadow-2xs focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] text-base transition-colors" />

                <button type="button" @click="showPassword = !showPassword"
                    class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-[#2982d6] transition-colors focus:outline-none"
                    aria-label="Toggle password visibility">

                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.016 10.016 0 014.285-5.517M8.224 4.414A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M12 9a3 3 0 00-3 3m3 3a3 3 0 003-3M3 3l18 18" />
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2 text-rose-600 text-sm font-semibold" />
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember"
                class="h-4 w-4 rounded border-[#e2e8f0] text-[#2982d6] focus:ring-[#2982d6] transition-colors cursor-pointer">
            <label for="remember_me" class="ml-2 block text-sm font-medium text-[#2168ab] cursor-pointer select-none">
                {{ __('Keep me signed in') }}
            </label>
        </div>

        <div class="pt-2">
            <button type="submit"
                class="w-full flex justify-center items-center py-3 px-4 bg-[#2982d6] hover:bg-[#2168ab] text-white text-base font-semibold rounded-xl shadow-xs transition-colors cursor-pointer">
                <svg class="w-5 h-5 mr-2 -ml-1 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                    </path>
                </svg>
                {{ __('Sign In to Workspace') }}
            </button>
        </div>
    </form>
</x-guest-layout>