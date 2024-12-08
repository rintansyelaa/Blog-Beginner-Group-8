<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Categories
            </h2>
            <a class="bg-blue-600 text-white py-2 px-5 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-blue-700" href="{{ route('categories.create') }}">
                Create Category
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert />
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @forelse($categoryList as $category)
                    <div class="flex items-center border-b border-gray-300 hover:bg-gray-50 transition-colors duration-300 rounded-lg mb-3 px-5 py-4">
                        <div class="flex items-center space-x-4">
                            <span class="text-lg font-medium text-gray-800">{{ $loop->iteration }}</span>
                            <p class="text-xl font-semibold text-gray-900">{{ $category->name }}</p>
                        </div>
                        <div class="flex space-x-2 ml-auto">
                            <a href="{{ route('categories.edit', $category->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-green-600">
                                Update
                            </a>
                            <form action="{{ route('categories.delete', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="flex justify-center items-center py-10">
                        <h1 class="text-xl text-gray-500">There are no categories yet</h1>
                    </div>
                    @endforelse
                </div>
                <div class="px-5 py-5">
                    {!! $categoryList->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
