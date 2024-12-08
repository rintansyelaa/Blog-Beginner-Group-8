<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-blue-500">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold text-blue-600">
                        Welcome back, {{ auth()->user()->name }}!
                    </h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                        @foreach($stats as $d)
                        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                            <h2 class="text-5xl font-semibold text-blue-500">{{ $d['total'] }}</h2>
                            <p class="mt-2 text-lg text-gray-600">{{ $d['label'] }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
