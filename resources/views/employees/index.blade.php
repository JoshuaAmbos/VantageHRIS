<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Employees') }}
        </h2>
    </x-slot>

    {{-- form --}}
    <div class="p-6">
        <table class="min-w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">First Name</th>
                    <th class="border p-2">Last Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Position</th>
                    <th class="border p-2">Employment Status</th>
                    <th class="border p-2">Actions</th>
                    {{-- rest of the details will be in 'show' view --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($employees as $employee)
                    <tr>
                        <td class="border p-2">{{ $employee->first_name }}</td>
                        <td class="border p-2">{{ $employee->last_name }}</td>
                        <td class="border p-2">{{ $employee->email }}</td>
                        <td class="border p-2">{{ $employee->position }}</td>
                        <td class="border p-2">{{ $employee->employment_status }}</td>
                        <td class="border p-2 flex gap-2">
                            <a href="{{ route('employees.show', $employee->id) }}" class="px-2 py-1 rounded text-white"
                                style="background-color: cornflowerblue">View</a>

                            <a href="{{  route('employees.edit', $employee->id) }}" class="px-2 py-1 rounded text-white"
                                style="background-color: skyblue; text-decoration: none;">Edit</a>

                            <form action="{{ route('employees.destroy', $employee->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 py-1 rounded text-white"
                                    style="background-color: red;">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- add btn --}}
        <div class="mt-4">
            <a href="{{ route('employees.create') }}" class="px-4 py-2 rounded text-white"
                style="background-color: deepskyblue; text-decoration: none;">
                Add Employee
            </a>
        </div>

    </div>
</x-app-layout>