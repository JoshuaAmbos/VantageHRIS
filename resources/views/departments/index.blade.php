<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <table class="min-w-full border-collapse">
            <thead>
                <tr>
                    <th class="border p-2">Department Name</th>
                    <th class="border p-2">Description</th>
                    <th class="border p-2">Manager</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $department)
                    <tr>
                        <td class="border p-2">{{ $department->name }}</td>
                        <td class="border p-2">{{ $department->description }}</td>
                        <td class="border p-2">
                            @if ($department->manager)
                                {{ $department->manager->first_name }} {{ $department->manager->last_name }}
                            @else
                                <span class="text-slate-400 italic">No manager assigned.</span>
                            @endif
                        </td>
                        <td class="border p-2">
                            @if ($department->status)
                                {{ str($department->status)->ucfirst() }}
                            @else
                                <span class="text-slate-400 italic">Status undefined.</span>
                            @endif
                        </td>
                        <td class="border p-2 flex gap-2">
                            {{-- Edit Link --}}
                            <a href="{{ route('departments.edit', $department->id) }}" class="px-2 py-1 rounded text-white"
                                style="background-color: skyblue; text-decoration: none;">
                                EDIT
                            </a>

                            {{-- Delete Form --}}
                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST"
                                onsubmit="return confirm('Delete this department?');">
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

        {{-- Create Button using Named Route --}}
        <div class="mt-4">
            <a href="{{ route('departments.create') }}" class="px-4 py-2 rounded text-white"
                style="background-color: deepskyblue; text-decoration: none;">
                Add Department
            </a>
        </div>
    </div>
</x-app-layout>