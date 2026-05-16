<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Department') }}: {{ $department->name }}
        </h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('departments.update', $department->id) }}" method="POST">
            @csrf
            {{-- 1. Method Spoofing: This tells Laravel to treat this POST as a PATCH request --}}
            @method('PATCH')

            <label for="name">Department Name</label><br>
            {{-- 2. Use 'value' instead of 'placeholder' to load existing data --}}
            <input type="text" id="name" name="name" value="{{ old('name', $department->name) }}"><br>
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <br>

            <label for="description">Description</label><br>
            <input type="text" id="description" name="description"
                value="{{ old('description', $department->description) }}"><br>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <br>

            <label for="manager_id">Manager</label><br>
            <select name="manager_id" id="manager_id"
                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors">
                <option value="">No Manager Assigned</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('manager_id', $department->manager_id) == $employee->id ? 'selected' : '' }}>
                        {{ $employee->first_name }} {{ $employee->last_name }}
                    </option>
                @endforeach
            </select>

            <br>
            @error('manager_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <br>

            {{-- 3. Status selection (Required by your DepartmentRequest) --}}
            <label for="status">Status</label><br>
            <select name="status" id="status">
                <option value="active" {{ old('status', $department->status) == 'active' ? 'selected' : '' }}>Active
                </option>
                <option value="inactive" {{ old('status', $department->status) == 'inactive' ? 'selected' : '' }}>Inactive
                </option>
            </select><br>
            @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            <br>

            <div class="mt-4">
                <a href="{{ route('departments.index') }}" class="px-4 py-2 rounded text-white"
                    style="background-color: gray; text-decoration: none; display: inline-block;">
                    Cancel
                </a>

                <button type="submit" class="px-4 py-2 rounded text-white" style="background-color: deepskyblue;">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-app-layout>