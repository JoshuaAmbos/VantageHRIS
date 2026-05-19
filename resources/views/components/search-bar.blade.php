@props(['action', 'placeholder' => 'Search...', 'value' => ''])

<form action="{{ $action }}" method="GET" class="w-full sm:max-w-xs relative">
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-5 h-5 text-[#549bde]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                </path>
            </svg>
        </div>

        <input type="text" name="search" value="{{ $value }}" placeholder="{{ $placeholder }}"
            class="w-full pl-10 pr-10 py-2.5 bg-white border border-[#e2e8f0] text-base text-[#081a2b] rounded-xl focus:outline-none focus:border-[#2982d6] focus:ring-1 focus:ring-[#2982d6] placeholder-[#a9cdef] transition-all shadow-xs">

        @if ($value)
            <a href="{{ $action }}"
                class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#549bde] hover:text-rose-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>
        @endif
    </div>
</form>
