<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Create New Article
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form class="p-8 text-gray-900 space-y-6" action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="text-lg font-medium text-gray-700">Title</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            placeholder="Enter article title"
                            class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            required
                            value="{{ old('title') }}"
                        >
                        @error('title')
                        <span class="block text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category" class="text-lg font-medium text-gray-700">Category</label>
                        <select name="category" id="category" class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" required>
                            <option value="" class="hidden">Choose Category</option>
                            @foreach($categoryList as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="block text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tags" class="text-lg font-medium text-gray-700">Tags</label>
                        <select name="tags[]" id="tags" class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" required multiple>
                            <option value="" class="hidden">Choose Tag(s)</option>
                            @foreach($tagList as $tag)
                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        @error('tags')
                        <span class="block text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="full_text" class="text-lg font-medium text-gray-700">Description</label>
                        <textarea
                            name="full_text"
                            id="full_text"
                            rows="6"
                            placeholder="Enter article description"
                            required
                            class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none"
                        >{{ old('full_text') }}</textarea>
                        @error('full_text')
                        <span class="block text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="image" class="text-lg font-medium text-gray-700">Upload Image</label>
                        <input
                            type="file"
                            name="image"
                            id="image"
                            required
                            class="w-full rounded-lg border border-gray-300 py-2 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        >
                        @error('image')
                        <span class="block text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-green-700 transition-colors duration-200 focus:ring-2 focus:ring-green-500">
                            Add Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
