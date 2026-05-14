<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="max-w-md w-full mx-auto p-8 bg-white rounded-2xl shadow-xl border border-gray-100">

        <!-- Branding & Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-xl bg-vantage-50 mb-4 shadow-inner">
                <span class="text-vantage-900 font-bold text-3xl">V</span>
            </div>
            <h2 class="text-2xl font-extrabold text-vantage-900 tracking-tight">
                Vantage<span class="text-vantage-500">HRIS</span>
            </h2>
            <p class="text-sm text-slate-500 mt-2">Please sign in to access your secure workspace.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-sm font-semibold text-vantage-900 mb-2">
                    {{ __('Email Address') }}
                </label>
                <div class="relative">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                        autocomplete="username" placeholder="name@company.com"
                        class="block w-full rounded-lg border-gray-300 px-4 py-3 text-slate-900 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors duration-200" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-2">
                    <label for="password" class="block text-sm font-semibold text-vantage-900">
                        {{ __('Password') }}
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm font-medium text-vantage-600 hover:text-vantage-800 transition-colors"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot password?') }}
                        </a>
                    @endif
                </div>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="••••••••"
                        class="block w-full rounded-lg border-gray-300 px-4 py-3 text-slate-900 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors duration-200" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-sm" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="h-4 w-4 rounded border-gray-300 text-vantage-600 focus:ring-vantage-500 transition-colors">
                <label for="remember_me" class="ml-2 block text-sm text-slate-600">
                    {{ __('Keep me signed in') }}
                </label>
            </div>

            <!-- Submit Button -->
            <div class="pt-2">
                <button type="submit"
                    class="w-full flex justify-center items-center py-3 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-vantage-800 hover:bg-vantage-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-vantage-500 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                        </path>
                    </svg>
                    {{ __('Sign In to Workspace') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>