<x-app-layout>
    <x-slot name="header">
        {{ __('User Account Directory') }}
    </x-slot>

    <div class="mt-6 px-2 sm:px-0">
        <h3 class="text-xl font-bold text-[#081a2b] mb-6 tracking-tight">All System Users</h3>

        <div class="flex flex-col sm:flex-row justify-between items-stretch sm:items-center gap-4 mb-6">

            {{-- Search Bar --}}
            <div class="w-full sm:max-w-xs">
                <x-search-bar :action="route('users.index')" :value="$search" placeholder="Search users..." />
            </div>

            <a href="{{ route('users.create') }}"
                class="inline-flex items-center justify-center px-4 py-2.5 bg-[#2982d6] hover:bg-[#2168ab] text-white text-base font-semibold rounded-xl shadow-xs transition-colors cursor-pointer w-full sm:w-auto">
                <svg class="w-5 h-5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                    </path>
                </svg>
                Provision User Account
            </a>
        </div>


        {{-- Scroll-Free Structured Grid Table --}}
        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden flex flex-col w-full">
            <div class="overflow-x-auto min-w-full">
                <table class="min-w-full divide-y divide-[#e2e8f0] table-fixed">
                    <thead class="bg-[#f8fafc]">
                        <tr>
                            <th scope="col"
                                class="w-1/4 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                User / Account Name
                            </th>
                            <th scope="col"
                                class="w-1/4 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Login Email
                            </th>
                            <th scope="col"
                                class="w-1/4 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Linked Employee Profile
                            </th>
                            <th scope="col"
                                class="w-36 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Access Role
                            </th>
                            <th scope="col"
                                class="w-32 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Created Date
                            </th>
                            <th scope="col"
                                class="w-32 px-4 py-3.5 text-right text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#e2e8f0]">
                        @foreach ($users as $user)
                            <tr class="hover:bg-[#f8fafc]/50 transition-colors">

                                {{-- Avatar Initials Badge & Display Name --}}
                                <td class="px-4 py-3.5 whitespace-nowrap truncate">
                                    <div class="flex items-center">
                                        <div
                                            class="h-9 w-9 rounded-full bg-[#eaf3fb] border border-[#d4e6f7] text-[#184e81] flex items-center justify-center font-bold text-xs uppercase flex-shrink-0">
                                            {{ substr($user->name ?? 'U', 0, 2) }}
                                        </div>
                                        <div class="ml-2.5 truncate">
                                            <div class="text-base font-bold text-[#081a2b] truncate">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Login Email --}}
                                <td class="px-4 py-3.5 whitespace-nowrap truncate">
                                    <div class="text-base text-[#2168ab] font-medium truncate">{{ $user->email }}</div>
                                </td>

                                {{-- Profile Relational Links --}}
                                <td class="px-4 py-3.5 whitespace-nowrap truncate">
                                    @if($user->employee)
                                        <div class="text-base text-[#081a2b] font-bold truncate">
                                            {{ $user->employee->last_name }}, {{ $user->employee->first_name }}
                                        </div>
                                        <div class="text-xs text-[#549bde] font-medium truncate">
                                            {{ $user->employee->department->name ?? 'No Department' }}
                                        </div>
                                    @else
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-amber-100 text-amber-900 italic">
                                            Orphaned Account
                                        </span>
                                    @endif
                                </td>

                                {{-- Access Role High-Contrast Pastel Badge Matrix --}}
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    @php
                                        $normalizedRole = strtolower($user->role);
                                    @endphp

                                    @if($normalizedRole === 'admin' || $normalizedRole === 'administrator')
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-rose-300 text-rose-900">
                                            Admin
                                        </span>
                                    @elseif($normalizedRole === 'hr')
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-green-300 text-green-900">
                                            HR Staff
                                        </span>
                                    @elseif($normalizedRole === 'manager')
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-blue-300 text-blue-900">
                                            Manager
                                        </span>
                                    @else
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-yellow-300 text-yellow-900">
                                            Employee
                                        </span>
                                    @endif
                                </td>

                                {{-- Creation Stamp --}}
                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <div class="text-base text-[#103456] font-medium">
                                        {{ $user->created_at->format('M j, Y') }}
                                    </div>
                                </td>

                                {{-- Control Options Column --}}
                                <td class="px-4 py-3.5 whitespace-nowrap text-right text-base font-semibold">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-[#103456] hover:text-[#081a2b] bg-[#f8fafc] hover:bg-[#e2e8f0] px-2.5 py-1 rounded-lg transition-colors border border-[#e2e8f0] text-sm font-bold shadow-xs">
                                            Edit
                                        </a>

                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline"
                                                onsubmit="return confirm('Completely revoke system credentials for this account? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-2.5 py-1 rounded-lg transition-colors text-sm font-bold border border-rose-100 shadow-xs cursor-pointer">
                                                    Revoke
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Navigation Pagination Blocks --}}
            @if(method_exists($users, 'links') && $users->hasPages())
                <div class="px-6 py-4 border-t border-[#e2e8f0] bg-[#f8fafc] mt-auto">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>