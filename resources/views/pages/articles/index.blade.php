<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Articles
            </h2>
            <a class="bg-blue-600 text-white py-2 px-6 rounded-lg text-sm font-medium transition-colors duration-200 hover:bg-blue-700" href="{{ route('articles.create') }}">
                Create Article
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <x-alert />
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid lg:grid-cols-3 grid-cols-1 gap-8">
                        @foreach($articles as $article)
                        <div class="bg-white rounded-lg shadow-xl overflow-hidden transition-transform transform hover:scale-105 duration-300">
                            <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-56 object-cover rounded-t-lg">
                            <div class="px-6 py-4">
                                <h3 class="text-2xl font-semibold text-gray-900 hover:text-blue-500 transition-colors duration-200">{{ $article->title }}</h3>
                                <p class="text-sm text-gray-600 mb-3">By <strong>{{ $article->user->name }}</strong></p>
                                <p class="text-gray-700 text-base mb-4">
                                    {{ Str::limit($article->full_text, 100) }}...
                                </p>
                                <div class="flex items-center space-x-3">
                                    <span class="text-sm text-gray-500">{{ $article->created_at->format('M d, Y') }}</span>
                                    <span class="text-sm bg-blue-200 text-blue-800 px-3 py-1 rounded-full">
                                        {{ $article->category->name }}
                                    </span>
                                </div>
                                <div class="flex mt-3">
                                    @foreach($article->tags as $tag)
                                    <span class="bg-blue-500 text-white text-sm px-3 py-1 rounded-full mr-2 mt-2 transition-all duration-200 hover:bg-blue-600">
                                        {{ $tag->name }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="flex items-center justify-between px-6 py-4 bg-gray-50">
                                <a href="{{ route('articles.edit', $article->id) }}" class="bg-green-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-600 transition-colors duration-200">
                                    Edit
                                </a>
                                <form action="{{ route('articles.delete', $article->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-600 transition-colors duration-200">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
