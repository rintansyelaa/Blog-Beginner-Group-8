<x-user-layout>
    <div class="py-12">

        <!-- Hero Section -->
        <div class="relative h-[600px] mb-5">
            <img src="{{ asset('hero.jpg') }}" alt="Hero Image" class="w-full h-full object-cover">
            <h1
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-white text-4xl font-bold p-5">
                Dive Into Engaging Articles with Our Blog WebApp
            </h1>
        </div>



        <!-- About Section -->
        <div class="bg-blue-600 text-white text-center py-12 mb-8">
            <h2 class="text-3xl font-semibold">About Our Blog WebApp</h2>
            <p class="max-w-4xl mx-auto text-lg mt-4">
                Our platform is dedicated to bringing you the latest articles on various topics. Whether you are looking
                to expand your knowledge or just enjoy some interesting reads, we’ve got it all covered. Explore our
                vast collection of articles and discover more!
            </p>
            <a href="{{ route('about') }}"
                class="mt-6 inline-block bg-white text-blue-600 py-2 px-6 rounded-full hover:bg-blue-700 hover:text-white transition duration-300">
                Learn More About Us
            </a>
        </div>

        <!-- Article Search Section -->
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10">
                <form action="{{ route('home') }}" class="flex mb-5">
                    <input type="text" placeholder="Search for article" class="rounded-xl w-2/5 mr-1" name="article"
                        value="{{ request('article') }}">
                    <input type="text" placeholder="Search by tag" class="rounded-xl w-1/5 mx-1" name="tag"
                        value="{{ request('tag') }}">
                    <select name="category" class="w-1/5 rounded-xl mx-1">
                        <option value="" class="hidden">All Category</option>
                        @foreach ($categoryList as $category)
                            <option value="{{ $category->name }}"
                                {{ request('category') == $category->name ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <button class="w-1/5 bg-blue-500 text-white rounded-xl ml-1" type="submit">Search</button>
                </form>

                <!-- Articles Display -->
                <div class="mt-5">
                    @if ($articleList->isEmpty())
                        <div class="flex justify-center items-center p-20">
                            <h1 class="text-3xl text-blue-500">Empty Articles</h1>
                        </div>
                    @else
                        <div class="grid lg:grid-cols-3 grid-cols-1 gap-5">
                            @foreach ($articleList as $article)
                            <div class="max-w-sm mx-auto rounded-lg overflow-hidden bg-white shadow-lg hover:bg-blue-500 group hover:shadow-xl transition duration-300 ease-in-out">
                                <!-- Article Image -->
                                <img src="{{ $article->image }}" alt="{{ $article->title }}" class="w-full h-56 object-cover group-hover:opacity-80 transition duration-200 ">

                                <!-- Card Body -->
                                <div class="p-6">
                                    <!-- Article Title -->
                                    <h5 class="text-2xl font-semibold text-blue-600 group-hover:text-white  transition duration-200">
                                        {{ $article->title }}
                                    </h5>
                                    <!-- Article Snippet -->
                                    <p class="text-sm text-gray-700 mt-2">
                                        {{ substr($article->full_text, 0, 120) }}...
                                    </p>

                                    <!-- Article Metadata: Date, Category -->
                                    <div class="mt-4 flex justify-between items-center">
                                        <p class="text-xs text-gray-500">
                                            {{ $article->created_at->format('M d, Y') }}
                                        </p>
                                        <p class="text-xs bg-blue-500 text-white px-3 py-1 rounded-md group-hover:bg-white group-hover:text-blue-600 transition duration-200">
                                            {{ $article->category->name }}
                                        </p>
                                    </div>

                                    <!-- Tags Section -->
                                    <div class="mt-3 flex items-center space-x-2">
                                        <p class="text-sm text-gray-700">Tags:</p>
                                        @foreach ($article->tags as $tag)
                                            <p class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs group-hover:bg-white group-hover:text-blue-600 transition duration-200">
                                                {{ $tag->name }}
                                            </p>
                                        @endforeach
                                    </div>

                                    <!-- Card Action Buttons -->
                                    <div class="mt-6 flex justify-between items-center">
                                        <a href="{{ route('articles.detail', $article->id) }}"
                                            class="inline-block bg-blue-600 text-white py-2 px-4 rounded-md text-sm font-semibold hover:bg-blue-700 transition duration-200">
                                            Read More
                                        </a>

                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Pagination -->
                {!! $articleList->links() !!}
            </div>
        </div>
    </div>
</x-user-layout>
