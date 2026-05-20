<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <label for="email" class="block text-sm font-bold text-[#081a2b] mb-2">
                {{ __('Email Address') }}
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username" placeholder="name@company.com"
                class="block w-full rounded-xl border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-[#081a2b] placeholder-slate-400 shadow-2xs focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] text-base transition-colors" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-rose-600 text-sm font-semibold" />
        </div>

        <div>
            <label for="password" class="block text-sm font-bold text-[#081a2b] mb-2">
                {{ __('Password') }}
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                placeholder="••••••••"
                class="block w-full rounded-xl border-[#e2e8f0] bg-[#f8fafc] px-4 py-3 text-[#081a2b] placeholder-slate-400 shadow-2xs focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] text-base transition-colors" />
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