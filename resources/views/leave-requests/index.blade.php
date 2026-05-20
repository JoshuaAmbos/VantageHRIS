<x-app-layout>
    <x-slot name="header">
        {{ __('Leave Requests Directory') }}
    </x-slot>

    <div class="mt-6 px-2 sm:px-0">
        <h3 class="text-xl font-bold text-[#081a2b] mb-6 tracking-tight">All Leave Requests</h3>

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
            <div class="w-full sm:max-w-xs">
                <x-search-bar :action="route('leave-requests.index')" :value="$search ?? ''"
                    placeholder="Search requests..." />
            </div>

            <a href="{{ route('leave-requests.create') }}"
                class="inline-flex items-center justify-center px-4 py-2.5 bg-[#2982d6] hover:bg-[#2168ab] text-white text-base font-semibold rounded-xl shadow-xs transition-colors cursor-pointer w-full sm:w-auto">
                <svg class="w-5 h-5 mr-1.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Request
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-[#e2e8f0] overflow-hidden flex flex-col w-full">
            <div class="overflow-x-auto min-w-full">
                <table class="min-w-full divide-y divide-[#e2e8f0] table-fixed">
                    <thead class="bg-[#f8fafc]">
                        <tr>
                            <th scope="col"
                                class="w-1/4 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Submitted By
                            </th>
                            <th scope="col"
                                class="w-32 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Leave Type
                            </th>
                            <th scope="col"
                                class="w-36 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Duration
                            </th>
                            <th scope="col"
                                class="w-28 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Status
                            </th>
                            <th scope="col"
                                class="w-36 px-4 py-3.5 text-left text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Approved By
                            </th>
                            <th scope="col"
                                class="w-44 px-4 py-3.5 text-right text-sm font-bold text-[#2168ab] uppercase tracking-wider whitespace-nowrap">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-[#e2e8f0]">
                        @forelse ($leaveRequests as $request)
                            <tr class="hover:bg-[#f8fafc]/50 transition-colors">

                                <td class="px-4 py-3.5 whitespace-nowrap truncate">
                                    <div class="flex items-center">
                                        <div
                                            class="h-9 w-9 rounded-full bg-[#eaf3fb] border border-[#d4e6f7] text-[#184e81] flex items-center justify-center font-bold text-xs flex-shrink-0">
                                            {{ substr($request->submittedBy->first_name ?? 'E', 0, 1) }}{{ substr($request->submittedBy->last_name ?? 'P', 0, 1) }}
                                        </div>
                                        <div class="ml-2.5 truncate">
                                            <div class="text-base font-bold text-[#081a2b] truncate">
                                                {{ $request->submittedBy->first_name ?? 'System' }}
                                                {{ $request->submittedBy->last_name ?? 'User' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <div class="text-base text-[#103456] font-medium">{{ $request->leave_type }}</div>
                                </td>

                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    <div class="flex flex-col">
                                        <span class="text-base font-bold text-[#081a2b]">
                                            {{ \Carbon\Carbon::parse($request->start_date)->format('M j, Y') }}
                                        </span>
                                        <span class="text-xs text-[#2168ab] font-medium mt-0.5">
                                            to {{ \Carbon\Carbon::parse($request->end_date)->format('M j, Y') }}
                                        </span>
                                    </div>
                                </td>

                                <td class="px-4 py-3.5 whitespace-nowrap">
                                    @if ($request->status === App\Models\LeaveRequest::STATUS_APPROVED)
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-green-300 text-green-900">
                                            Approved
                                        </span>
                                    @elseif ($request->status === App\Models\LeaveRequest::STATUS_PENDING)
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-yellow-300 text-yellow-900">
                                            Pending
                                        </span>
                                    @else
                                        <span
                                            class="px-2.5 py-0.5 inline-flex text-xs font-bold rounded-full bg-rose-300 text-rose-900">
                                            Rejected
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-3.5 whitespace-nowrap truncate">
                                    <div class="text-base text-[#103456] font-medium truncate">
                                        @if($request->approvedBy)
                                            {{ $request->approvedBy->first_name }} {{ $request->approvedBy->last_name }}
                                        @else
                                            <span class="text-slate-400 italic">—</span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-4 py-3.5 whitespace-nowrap text-right text-base font-semibold">
                                    <div class="flex items-center justify-end gap-1.5">
                                        <a href="{{ route('leave-requests.show', $request->id) }}"
                                            class="text-[#2982d6] hover:text-[#103456] bg-[#eaf3fb] hover:bg-[#d4e6f7] px-3 py-1.5 rounded-lg transition-colors text-sm font-bold shadow-xs">
                                            View
                                        </a>

                                        @if($request->status === App\Models\LeaveRequest::STATUS_PENDING)
                                            <a href="{{ route('leave-requests.edit', $request->id) }}"
                                                class="text-[#103456] hover:text-[#081a2b] bg-[#f8fafc] hover:bg-[#e2e8f0] px-2.5 py-1 rounded-lg transition-colors border border-[#e2e8f0] text-sm font-bold shadow-xs">
                                                Edit
                                            </a>
                                        @endif

                                        <form action="{{ route('leave-requests.destroy', $request->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-rose-600 hover:text-rose-800 bg-rose-50 hover:bg-rose-100 px-2.5 py-1 rounded-lg transition-colors text-sm font-bold border border-rose-100 shadow-xs cursor-pointer">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-base text-slate-400 italic bg-white">
                                    No leave requests found records.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($leaveRequests, 'links') && $leaveRequests->hasPages())
                <div class="px-6 py-4 border-t border-[#e2e8f0] bg-[#f8fafc] mt-auto">
                    {{ $leaveRequests->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>