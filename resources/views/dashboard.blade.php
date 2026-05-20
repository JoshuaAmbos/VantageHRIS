<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-[#081a2b] leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="w-full min-w-0 px-2 sm:px-0 space-y-6 sm:space-y-8 mt-4 sm:mt-6">

        {{-- Interactive Welcome Hero Banner --}}
        <div class="bg-white border border-[#e2e8f0] rounded-xl p-6 sm:p-8 shadow-sm relative overflow-hidden w-full">
            <div
                class="absolute top-0 right-0 -mt-8 -mr-8 w-48 h-48 sm:w-64 sm:h-64 bg-[#eaf3fb] rounded-full opacity-40 blur-3xl pointer-events-none">
            </div>

            <div class="relative z-10">
                <h3 class="text-2xl sm:text-3xl font-extrabold text-[#103456] tracking-tight mb-2">
                    Welcome back, {{ Auth::user()->name }}!
                </h3>
                <p class="text-[#2168ab] max-w-xl text-sm sm:text-base leading-relaxed">
                    Here is your centralized workplace snapshot for today. Use the tracking modules below to review
                    schedules, logs, and active workflow allocations.
                </p>
            </div>
        </div>

        {{-- Segmented Sub-Layout Includes Depending on User Type Permissions --}}
        <div class="w-full">
            @if(in_array(auth()->user()->role, ['admin', 'hr']))
                @include('dashboard._admin')
            @else
                @include('dashboard._employee')
            @endif
        </div>


    </div>
</x-app-layout>