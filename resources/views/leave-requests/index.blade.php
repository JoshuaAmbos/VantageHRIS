<x-app-layout>
    <x-slot name="header">
        {{ __('Leave Requests') }}
    </x-slot>

    <div class="mt-6">
        {{-- Table Header & Actions --}}
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-vantage-900">All Leave Requests</h3>
            <a href="{{ route('leave-requests.create') }}"
                class="inline-flex items-center px-4 py-2 bg-vantage-800 text-white text-sm font-bold rounded-lg shadow-sm hover:bg-vantage-900 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add Request
            </a>
        </div>


        {{-- Grid --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full dividie-y divide-gray-200">
                    <thead class="bg-vantage-50/50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Submitted By</th>

                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Leave Type</th>

                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Start Date</th>

                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                End Date</th>

                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Reason</th>

                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Status</th>

                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Approved By</th>

                            <th scope="col"
                                class="px-6 py-4 text-left text-xs font-bold text-vantage-800 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dividie-gray-100">
                        @forelse ($leaveRequests as $request)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div
                                            class="h-8 w-8 rounded-full bg-vantage-100 text-vantage-800 flex items-center justify-center font-bold text-xs">
                                            {{ substr($request->submittedBy->first_name, 0, 1) }}{{ substr($request->submittedBy->last_name, 0, 1) }}
                                        </div>

                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-vantage-900">
                                                {{ $request->submittedBy->first_name }}
                                                {{ $request->submittedBy->last_name }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $request->leave_type }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $request->start_date }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $request->end_date }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $request->reason }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full @if ($request->status === App\Models\LeaveRequest::STATUS_PENDING) bg-orange-300 text-vantage-900 @elseif ($request->status === App\Models\LeaveRequest::STATUS_APPROVED) bg-green-300 text-vantage-900 @elseif ($request->status === App\Models\LeaveRequest::STATUS_REJECTED) bg-red-300 text-vantage-900 @endif">
                                        {{ $request->status }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-600">{{ $request->approvedBy ?? 'N/A' }}</div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('leave-requests.show', $request->id) }}"
                                            class="text-vantage-600 hover:text-vantage-900 bg-vantage-50 hover:bg-vantage-100 px-3 py-1 rounded transition-colors">View</a>
                                        <a href="{{ route('leave-requests.edit', $request->id) }}"
                                            class="text-slate-600 hover:text-vantage-800 bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded transition-colors">Edit</a>

                                        <form action="{{ route('leave-requests.destroy', $request->id) }}" method="POST"
                                            class="inline" onsubmit="return confirm('Delete this record?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded transition-colors">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p class="text-gray-400 italic">{{ $message }}</p>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Optional: Pagination links --}}
            @if(method_exists($leaveRequests, 'links'))
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $leaveRequests->links() }}
                </div>
            @endif

        </div>
    </div>

</x-app-layout>