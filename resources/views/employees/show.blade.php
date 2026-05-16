<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <span>{{ __('Employee Profile') }}</span>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-6">
        <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-gray-100 p-8">

            <!-- Profile Header -->
            <div class="border-b border-gray-100 pb-6 mb-6 flex justify-between items-start">
                <div class="flex items-center gap-4">
                    <div
                        class="h-16 w-16 rounded-2xl bg-vantage-100 text-vantage-800 flex items-center justify-center font-extrabold text-2xl shadow-inner">
                        {{ substr($employee->first_name, 0, 1) }}{{ substr($employee->last_name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-3xl font-extrabold text-vantage-900 tracking-tight">{{ $employee->first_name }}
                            {{ $employee->last_name }}
                        </h3>
                        <p class="text-slate-500 font-medium mt-1">{{ $employee->position }} <span class="mx-2">•</span>
                            {{ $employee->department->name ?? 'No Department' }}</p>
                    </div>
                </div>
                <span
                    class="px-4 py-1.5 rounded-full text-xs font-bold tracking-wide uppercase {{ $employee->employment_status === \App\Models\Employee::STATUS_FULL_TIME ? 'bg-vantage-50 text-vantage-800 border border-vantage-200' : 'bg-gray-100 text-gray-600 border border-gray-200' }}">
                    {{ $employee->employment_status }}
                </span>
            </div>

            <!-- Details Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

                <!-- Personal & Contact Info -->
                <div class="space-y-5">
                    <h4
                        class="font-bold text-vantage-800 uppercase tracking-wider text-xs border-b border-gray-100 pb-2">
                        Contact Information</h4>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Email Address</p>
                        <p class="font-medium text-vantage-900">{{ $employee->email }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Phone Number</p>
                        <p class="font-medium text-vantage-900">{{ $employee->phone }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Residential Address</p>
                        <p class="font-medium text-vantage-900">{{ $employee->address }}</p>
                    </div>
                </div>

                <!-- Employment Info -->
                <div class="space-y-5">
                    <h4
                        class="font-bold text-vantage-800 uppercase tracking-wider text-xs border-b border-gray-100 pb-2">
                        Employment Details</h4>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Date of Hire</p>
                        <p class="font-medium text-vantage-900">
                            {{ \Carbon\Carbon::parse($employee->hire_date)->format('F j, Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Department ID</p>
                        <p class="font-medium text-vantage-900">{{ $employee->department_id ?? 'N/A'}}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">System Link</p>
                        <p class="font-medium text-slate-500 italic">
                            {{ $employee->user_id ? 'Linked to System User #' . $employee->user_id : 'No system account linked' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="mt-10 pt-6 border-t border-gray-100 flex items-center gap-3">

                <!-- Edit Button (Left) -->
                <a href="{{ route('employees.edit', $employee->id) }}"
                    class="px-5 py-2.5 bg-vantage-800 text-white text-sm font-bold rounded-lg hover:bg-vantage-900 shadow-sm transition-colors">
                    Edit Record
                </a>

                <!-- Delete Form (Left) -->
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                    onsubmit="return confirm('Are you absolutely sure you want to delete this employee? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-5 py-2.5 bg-white border border-red-200 text-red-600 text-sm font-bold rounded-lg hover:bg-red-50 transition-colors">
                        Delete Employee
                    </button>
                </form>

                <!-- Back Button (Right) -->
                <a href="{{ route('employees.index') }}"
                    class="ml-auto px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors shadow-sm">
                    Back to Directory
                </a>

            </div>

        </div>
    </div>
</x-app-layout>