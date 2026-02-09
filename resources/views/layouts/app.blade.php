<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Poetry Haven - Share Your Verses')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- If you want Google Fonts (optional elegant serif font for poem) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,700|inter:400,500,600" rel="stylesheet" />
</head>

<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col">

    <!-- Navigation -->
    <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo / Brand -->
                <a href="{{ route('home') }}" class="text-2xl font-serif font-bold text-indigo-700 hover:text-indigo-800 transition">
                    Poetry Haven
                </a>

                <!-- Nav Links -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('poems.index') }}"
                       class="text-gray-700 hover:text-indigo-700 font-medium transition">
                        Discover
                    </a>

                    @auth
                        <a href="{{ route('poems.create') }}"
                           class="text-gray-700 hover:text-indigo-700 font-medium transition">
                            Write Poem
                        </a>
                        <a href="{{ route('poems.my') }}"
                           class="text-gray-700 hover:text-indigo-700 font-medium transition">
                            My Poems
                        </a>
                    @endauth
                </nav>

                <!-- Auth Buttons / User Menu -->
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-700 font-medium">
                            Log in
                        </a>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 transition">
                            Sign up
                        </a>
                    @else
                        <div class="relative group">
                            <button class="flex items-center space-x-2 focus:outline-none">
                                <span class="font-medium">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 hidden group-hover:block z-50">
                                <a href="{{ route('poems.my') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    My Poems
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-sm">
                &copy; {{ date('Y') }} Poetry Haven. Made with ❤️ for poets.
            </p>
            <p class="text-xs mt-2 opacity-70">
                A place to share your soul through words.
            </p>
        </div>
    </footer>

</body>
</html>