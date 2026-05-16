<x-app-layout>
    <x-slot name="header">
        {{ __('Attendance Records') }}
    </x-slot>

    <div class="p-6">
        <table class="min-w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">Employee</th>
                    <th class="border p-2">Date</th>
                    <th class="border p-2">Time In</th>
                    <th class="border p-2">Time Out</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Remarks</th>
                    <th class="border p-2">Actions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                    <tr>
                        <td class="border p-2 font-bold">{{ $attendance->employee->first_name }}
                            {{ $attendance->employee->last_name }}
                        </td>
                        <td class="border p-2">{{ $attendance->attendance_date }}</td>
                        <td class="border p-2">{{ $attendance->time_in }} AM</td>
                        <td class="border p-2">{{ $attendance->time_out }} PM</td>
                        <td class="border p-2">{{str($attendance->status)->title() }}</td>
                        <td class="border p-2">{{ $attendance->remarks }}</td>
                        <td class="border p-2 flex gap-2">
                            {{-- Edit Link --}}
                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="px-2 py-1 rounded text-white"
                                style="background-color: skyblue; text-decoration: none;">
                                EDIT
                            </a>

                            {{-- Delete Form --}}
                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST"
                                onsubmit="return confirm('Delete this record?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 rounded text-white" style="background-color: red;">
                                    DELETE
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Create Button --}}
        <div class="mt-4">
            <a href="{{ route('attendances.create') }}" class="px-4 py-2 rounded text-white"
                style="background-color: deepskyblue; text-decoration: none;">
                Add Attendance Record
            </a>
        </div>
    </div>
</x-app-layout>