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

        <label for="manager_id">Manager</label>
        <input type="text" id="manager_id" name="manager_id"><br>

        <a href="{{ route('departments.index') }}" class="px-4 py-2 rounded text-white"
            style="background-color: gray; text-decoration: none; display: inline-block;">
            Cancel
        </a>
        <button type="submit" class="px-4 py-2 rounded text-white" style="background-color: deepskyblue;">
            Save Changes
        </button>
    </form>
</x-app-layout>