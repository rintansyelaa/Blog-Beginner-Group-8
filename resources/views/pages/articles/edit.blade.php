<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Edit Article
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="px-6 pt-6">
                    <label for="" class="text-lg font-medium text-gray-700">Article Tags</label>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @forelse($article->tags as $tag)
                        <form action="{{ route('articles.tag.delete', [$article->id, $tag->id]) }}" class="flex items-center gap-2" method="POST">
                            @csrf
                            @method('DELETE')
                            <p class="bg-blue-500 text-white px-2 py-1 rounded-md">{{ $tag->name }}</p>
                            <button type="submit" class="bg-red-500 text-white rounded-md px-2 py-1">Delete</button>
                        </form>
                        @empty
                        <p>No tags assigned to this article.</p>
                        @endforelse
                    </div>
                </div>

                <form class="px-6 pt-4 pb-6 text-gray-900 space-y-6" action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="title" class="text-lg font-medium text-gray-700">Title</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            placeholder="Enter article title"
                            class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                            required
                            value="{{ $article->title }}"
                        >
                        @error('title')
                        <span class="block text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="category" class="text-lg font-medium text-gray-700">Category</label>
                        <select name="category" id="category" class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200">
                            <option value="{{ $article->category->name }}" class="hidden">{{ $article->category->name }}</option>
                            @foreach($categoryList as $category)
                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <span class="block text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="tags" class="text-lg font-medium text-gray-700">Available Tags</label>
                        <select name="tags[]" id="tags" class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" multiple>
                            <option value="" class="hidden">Choose Tag(s)</option>
                            @foreach($tagList as $tag)
                            @if(!$article->tags->contains($tag))
                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                            @endif
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
                            class="w-full rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 resize-none"
                            required
                        >{{ $article->full_text }}</textarea>
                        @error('full_text')
                        <span class="block text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <img src="{{ asset($article->image) }}" alt="Current image" class="rounded-lg shadow-sm mb-4 w-full max-w-xs mx-auto">
                        <label for="image" class="text-lg font-medium text-gray-700">Update Image</label>
                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="w-full rounded-lg border border-gray-300 py-2 px-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200"
                        >
                        @error('image')
                        <span class="block text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg text-lg font-semibold hover:bg-green-700 focus:ring-2 focus:ring-green-500 transition-colors duration-200">
                            Update Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
