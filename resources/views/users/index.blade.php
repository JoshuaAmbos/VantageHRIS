<x-app-layout>
    <x-slot name="header">
        {{ __('User Account Directory') }}
    </x-slot>

    <div class="mt-6">
        <!-- Table Header & Provisioning Action Link -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-vantage-900">All System Users</h3>
            <a href="{{ route('users.create') }}"
                class="inline-flex items-center px-4 py-2 bg-vantage-800 text-white text-sm font-bold rounded-lg shadow-sm hover:bg-vantage-900 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Provision User Account
            </a>
        </div>

        <!-- Data Grid Display Frame -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-vantage-50/50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                User / Account Name</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Login Email</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Linked Employee Profile</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Access Role</th>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Created Date</th>
                            <th scope="col"
                                class="px-6 py-4 text-right text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50/50 transition-colors">

                                {{-- Avatar Icon and Account Name --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="h-8 w-8 rounded-full bg-slate-100 text-slate-700 border border-slate-200 flex items-center justify-center font-bold text-xs uppercase">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-semibold text-vantage-900">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Email --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-slate-600">{{ $user->email }}</div>
                                </td>

                                {{-- Relational Link back to Employee Model --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->employee)
                                        <div class="text-sm text-vantage-900 font-medium">
                                            {{ $user->employee->last_name }}, {{ $user->employee->first_name }}
                                        </div>
                                        <div class="text-[10px] text-slate-400 font-medium">
                                            {{ $user->employee->department->name ?? 'No Department' }}
                                        </div>
                                    @else
                                        <span class="text-xs text-amber-600 font-medium italic flex items-center">
                                            Orphaned Account
                                        </span>
                                    @endif
                                </td>

                                {{-- Access Role Dynamic Badges --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->role === 'admin')
                                        <span
                                            class="px-2.5 py-1 inline-flex text-xs font-bold rounded-md bg-red-50 text-red-700 border border-red-100">
                                            Administrator
                                        </span>
                                    @elseif($user->role === 'hr')
                                        <span
                                            class="px-2.5 py-1 inline-flex text-xs font-bold rounded-md bg-vantage-50 text-vantage-800 border border-vantage-100">
                                            HR Management
                                        </span>
                                    @else
                                        <span
                                            class="px-2.5 py-1 inline-flex text-xs font-medium rounded-md bg-slate-50 text-slate-600 border border-slate-200/60">
                                            Employee
                                        </span>
                                    @endif
                                </td>

                                {{-- Account Creation Stamp --}}
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-xs text-slate-600 font-medium">
                                        {{ $user->created_at->format('M d, Y') }}
                                    </div>
                                </td>

                                {{-- System Admin Actions Column --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-slate-600 hover:text-vantage-800 bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded transition-colors">Edit</a>

                                        <!-- Prevent the active administrator user from dropping their own account row -->
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline"
                                                onsubmit="return confirm('Completely revoke system credentials for this account?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded transition-colors">Revoke</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination Integration --}}
            @if(method_exists($users, 'links'))
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>