<x-user-layout>
    <div class="py-12">
        <!-- Hero Image -->
        <div class="flex justify-center items-center bg-center mb-6">
            <img src="{{ asset($article->image) }}" alt="Article Image" class="max-w-6xl rounded-lg shadow-xl">
        </div>

        <!-- Article Container -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Article Content -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-8 space-y-6">
                <!-- Article Title -->
                <h1 class="text-3xl font-bold text-gray-900">{{ $article->title }}</h1>
                <p class="text-gray-600 text-sm mt-2">By <span class="font-semibold">{{ $article->user->name }}</span> |
                    <span class="text-gray-500">{{ $article->created_at->format('F j, Y') }}</span>
                </p>
                <div class="h-1 bg-gray-800 w-full my-4"></div>

                <!-- Article Content -->
                <p class="text-lg text-gray-800 leading-relaxed">
                    {{ $article->full_text }}
                </p>

                <!-- Article Category -->
                <div class="flex justify-between items-center mt-6">
                    <div>
                        <p class="text-gray-500 text-sm">Category:</p>
                        <p class="inline-block bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">{{ $article->category->name }}</p>
                    </div>
                    <!-- Article Tags -->
                    <div class="flex space-x-2">
                        <p class="text-gray-500 text-sm">Tags:</p>
                        @foreach($article->tags as $tag)
                        <p class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs">{{ $tag->name }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
