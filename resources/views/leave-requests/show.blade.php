<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <span>{{ __('Leave Request Details') }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 px-2 sm:px-0 space-y-6">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-[#e2e8f0] p-4 sm:p-8">

            <div
                class="border-b border-[#e2e8f0] pb-6 mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-4">
                    <div
                        class="h-16 w-16 rounded-2xl bg-[#eaf3fb] border border-[#d4e6f7] text-[#184e81] flex items-center justify-center font-extrabold text-2xl shadow-inner flex-shrink-0">
                        {{ substr($leaveRequest->submittedBy->first_name ?? 'E', 0, 1) }}{{ substr($leaveRequest->submittedBy->last_name ?? 'P', 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-[#081a2b] tracking-tight">
                            {{ $leaveRequest->submittedBy->first_name ?? 'Unknown' }}
                            {{ $leaveRequest->submittedBy->last_name ?? 'User' }}
                        </h3>
                        <p class="text-[#2168ab] text-sm sm:text-base font-medium mt-1">
                            Type: <span class="font-bold">{{ $leaveRequest->leave_type }}</span>
                        </p>
                    </div>
                </div>

                @if ($leaveRequest->status === App\Models\LeaveRequest::STATUS_APPROVED)
                    <span
                        class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-emerald-50 text-emerald-700 border border-emerald-100 self-start sm:self-center">
                        Approved
                    </span>
                @elseif ($leaveRequest->status === App\Models\LeaveRequest::STATUS_PENDING)
                    <span
                        class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-amber-50 text-amber-700 border border-amber-100 self-start sm:self-center">
                        Pending Review
                    </span>
                @else
                    <span
                        class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-rose-50 text-rose-700 border border-rose-100 self-start sm:self-center">
                        Rejected
                    </span>
                @endif
            </div>

            <div class="space-y-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-[#f8fafc] p-5 rounded-xl border border-[#e2e8f0]">
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">Start Date</p>
                        <p class="text-base font-bold text-[#081a2b]">
                            {{ \Carbon\Carbon::parse($leaveRequest->start_date)->format('M j, Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">End Date</p>
                        <p class="text-base font-bold text-[#081a2b]">
                            {{ \Carbon\Carbon::parse($leaveRequest->end_date)->format('M j, Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">Authorized Signature
                        </p>
                        <p class="text-base font-semibold text-[#103456]">
                            @if($leaveRequest->approvedBy)
                                {{ $leaveRequest->approvedBy->first_name }} {{ $leaveRequest->approvedBy->last_name }}
                            @else
                                <span class="text-slate-400 italic">Awaiting evaluation loop</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="space-y-3">
                    <h4
                        class="font-bold text-[#2168ab] uppercase tracking-widest text-xs border-b border-[#e2e8f0] pb-2">
                        Statement of Purpose
                    </h4>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-2">Reason Provided</p>
                        <div
                            class="text-base font-medium text-[#081a2b] leading-relaxed bg-white p-5 rounded-xl border border-[#e2e8f0] shadow-2xs min-h-[100px]">
                            {{ $leaveRequest->reason }}
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="mt-10 pt-6 border-t border-[#e2e8f0] flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                @if($leaveRequest->status === App\Models\LeaveRequest::STATUS_PENDING && in_array(auth()->user()->role, ['admin', 'hr', 'manager']))
                    @if(auth()->user()->role !== 'manager' || (auth()->user()->employee && auth()->user()->employee->department_id === $leaveRequest->submittedBy->department_id))
                        <form action="{{ route('leave-requests.update-status', $leaveRequest->id) }}" method="POST"
                            class="w-full sm:w-auto">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="Approved">
                            <button type="submit"
                                class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-base font-semibold rounded-xl shadow-xs transition-colors cursor-pointer w-full">
                                Approve Request
                            </button>
                        </form>

                        <form action="{{ route('leave-requests.update-status', $leaveRequest->id) }}" method="POST"
                            class="w-full sm:w-auto" onsubmit="return confirm('Reject this request?');">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="Rejected">
                            <button type="submit"
                                class="px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white text-base font-semibold rounded-xl shadow-xs transition-colors cursor-pointer w-full">
                                Reject Request
                            </button>
                        </form>
                    @endif
                @endif

                @if($leaveRequest->status === App\Models\LeaveRequest::STATUS_PENDING)
                    <a href="{{ route('leave-requests.edit', $leaveRequest->id) }}"
                        class="text-center px-5 py-2.5 bg-[#2982d6] hover:bg-[#2168ab] text-white text-base font-semibold rounded-xl shadow-xs transition-colors cursor-pointer w-full sm:w-auto">
                        Edit Request
                    </a>
                @endif

                <a href="{{ route('leave-requests.index') }}"
                    class="text-center px-5 py-2.5 text-base font-semibold text-[#2168ab] bg-[#f8fafc] border border-[#e2e8f0] rounded-xl hover:bg-[#eaf3fb] hover:text-[#103456] transition-colors shadow-xs w-full sm:w-auto sm:ml-auto">
                    Back to Directory
                </a>
            </div>

        </div>
    </div>
</x-app-layout>