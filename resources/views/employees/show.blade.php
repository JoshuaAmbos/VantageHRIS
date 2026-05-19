<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <span>{{ __('Employee Profile') }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6 px-2 sm:px-0">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-[#e2e8f0] p-4 sm:p-8">

            <div class="border-b border-[#e2e8f0] pb-6 mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div class="flex items-center gap-4">
                    <div class="h-16 w-16 rounded-2xl bg-[#eaf3fb] border border-[#d4e6f7] text-[#184e81] flex items-center justify-center font-extrabold text-2xl shadow-inner flex-shrink-0">
                        {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-2xl sm:text-3xl font-extrabold text-[#081a2b] tracking-tight">
                            {{ $employee->first_name }} {{ $employee->last_name }}
                        </h3>
                        <p class="text-[#2168ab] text-sm sm:text-base font-medium mt-1">
                            {{ $employee->position }} <span class="mx-1 text-[#a9cdef]">•</span> {{ $employee->department->name ?? 'No Department' }}
                        </p>
                    </div>
                </div>
                
                @if($employee->employment_status === \App\Models\Employee::STATUS_FULL_TIME)
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-emerald-50 text-emerald-700 border border-emerald-100 self-start sm:self-center">
                        {{ $employee->employment_status }}
                    </span>
                @else
                    <span class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wider uppercase bg-indigo-50 text-indigo-700 border border-indigo-100 self-start sm:self-center">
                        {{ $employee->employment_status }}
                    </span>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-10">
                <div class="space-y-5">
                    <h4 class="font-bold text-[#2168ab] uppercase tracking-widest text-xs border-b border-[#e2e8f0] pb-2">
                        Contact Information
                    </h4>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">Email Address</p>
                        <p class="text-base font-semibold text-[#081a2b] break-all">{{ $employee->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">Phone Number</p>
                        <p class="text-base font-semibold text-[#081a2b]">{{ $employee->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">Residential Address</p>
                        <p class="text-base font-semibold text-[#081a2b]">{{ $employee->address ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <h4 class="font-bold text-[#2168ab] uppercase tracking-widest text-xs border-b border-[#e2e8f0] pb-2">
                        Employment Details
                    </h4>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">Date of Hire</p>
                        <p class="text-base font-semibold text-[#081a2b]">
                            {{ $employee->hire_date ? \Carbon\Carbon::parse($employee->hire_date)->format('F j, Y') : 'N/A' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">Department ID</p>
                        <p class="text-base font-semibold text-[#081a2b]">#{{ $employee->department_id ?? 'N/A'}}</p>
                    </div>
                    <div>
                        <p class="text-xs text-[#7eb4e7] uppercase tracking-wider font-bold mb-1">System Link</p>
                        <p class="text-sm font-medium text-[#549bde] italic">
                            {{ $employee->user_id ? 'Linked to System User #' . $employee->user_id : 'No system account linked' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-[#e2e8f0] flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <a href="{{ route('employees.edit', $employee->id) }}"
                    class="text-center px-5 py-2.5 bg-[#2982d6] hover:bg-[#2168ab] text-white text-base font-semibold rounded-xl shadow-xs transition-colors cursor-pointer w-full sm:w-auto">
                    Edit Record
                </a>

                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="w-full sm:w-auto"
                    onsubmit="return confirm('Are you absolutely sure you want to delete this employee? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-5 py-2.5 bg-white border border-rose-200 text-rose-600 text-base font-semibold rounded-xl hover:bg-rose-50 transition-colors shadow-xs cursor-pointer w-full">
                        Delete Employee
                    </button>
                </form>

                <a href="{{ route('employees.index') }}"
                    class="text-center px-5 py-2.5 text-base font-semibold text-[#2168ab] bg-[#f8fafc] border border-[#e2e8f0] rounded-xl hover:bg-[#eaf3fb] hover:text-[#103456] transition-colors shadow-xs w-full sm:w-auto sm:ml-auto">
                    Back to Directory
                </a>
            </div>

        </div>
    </div>
</x-app-layout>