<nav x-data="{ open: false }" class="bg-blue-600 text-white">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <x-application-logo class="h-9 w-auto fill-current text-white" />
                    <span class="text-xl font-semibold">Web Article 8</span>
                </a>
            </div>

            <!-- Navigation Links (Desktop) -->
            <div class="hidden md:flex space-x-6">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-blue-300">
                    Home
                </x-nav-link>
                <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-white hover:text-blue-300">
                    About Us
                </x-nav-link>
                @if(auth()->user())
                <x-nav-link :href="route('dashboard')" class="text-white hover:text-blue-300">
                    Dashboard
                </x-nav-link>
                @else
                <x-nav-link :href="route('login')" class="text-white hover:text-blue-300">
                    Login
                </x-nav-link>
                <x-nav-link :href="route('register')" class="text-white hover:text-blue-300">
                    Register
                </x-nav-link>
                @endif
            </div>

            <!-- Mobile Hamburger Menu -->
            <div class="sm:hidden flex items-center">
                <button @click="open = !open" class="text-white focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden bg-blue-600 text-white">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:bg-blue-500">
                Home
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-white hover:bg-blue-500">
                About Us
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('login')" class="text-white hover:bg-blue-500">
                Login
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')" class="text-white hover:bg-blue-500">
                Register
            </x-responsive-nav-link>
        </div>
    </div>
</nav>
