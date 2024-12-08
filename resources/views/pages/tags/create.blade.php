<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create New Tag
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form class="p-6 text-gray-900" action="{{ route('tags.store') }}" method="POST">
                    @csrf
                    <div class="mb-3 w-full">
                        <label for="name" class="text-lg">Tag Name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="w-full rounded-lg border border-l-gray-500"
                            placeholder="Fill tag name"
                            value="{{ old('name') }}"
                        >
                        @error('name')
                        <span class="block text-red-500">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded-lg">
                            Add Tag
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
