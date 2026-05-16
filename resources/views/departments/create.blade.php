<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Departments') }}
        </h2>
    </x-slot>

    {{-- form --}}
    <form action="{{ route('departments.store') }}" method="POST">
        @csrf
        <label for="name">Department Name</label>
        <input type="text" id="name" name="name"><br>

        <label for="description">Description</label>
        <input type="text" id="description" name="description"><br>

        <!-- Department Manager Selection Field -->
        <div class="mb-5">
            <label for="manager_id" class="block text-sm font-semibold text-vantage-900 mb-1">
                Department Manager <span class="text-xs text-slate-400 font-normal">(Optional)</span>
            </label>

            <select name="manager_id" id="manager_id"
                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-vantage-500 focus:ring focus:ring-vantage-500/20 transition-colors duration-200">
                <option value="">Select a Manager</option>
                @foreach($employees as $employee)
                    <option value="{{ $employee->id }}" {{ old('manager_id') == $employee->id ? 'selected' : '' }}>
                        {{ $employee->first_name }} {{ $employee->last_name }}
                    </option>
                @endforeach
            </select>

            @error('manager_id')
                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
            @enderror
        </div>

        <a href="{{ route('departments.index') }}" class="px-4 py-2 rounded text-white"
            style="background-color: gray; text-decoration: none; display: inline-block;">
            Cancel
        </a>
        <button type="submit" class="px-4 py-2 rounded text-white" style="background-color: deepskyblue;">
            Save Changes
        </button>
    </form>
</x-app-layout>