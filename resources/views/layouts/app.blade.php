<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Poetry Haven')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Elegant Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,700|inter:400,500,600" rel="stylesheet" />
</head>

<body class="bg-gray-50 text-gray-900 antialiased min-h-screen flex flex-col font-[Inter]">

    <!-- NAVIGATION -->
    <header class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <a href="{{ route('home') }}"
                   class="text-2xl font-[Playfair_Display] font-bold text-indigo-700 hover:text-indigo-800 transition">
                    Poetry Haven
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center space-x-8">

                    <a href="{{ route('poems.index') }}"
                       class="hover:text-indigo-700 transition font-medium">
                        Discover
                    </a>

                    @auth
                        <a href="{{ route('poems.create') }}"
                           class="hover:text-indigo-700 transition font-medium">
                            Write
                        </a>

                        <a href="{{ route('poems.my') }}"
                           class="hover:text-indigo-700 transition font-medium">
                            My Poems
                        </a>
                    @endauth
                </nav>

                <!-- Right Section -->
                <div class="flex items-center space-x-4">

                    @guest
                        <a href="{{ route('login') }}"
                           class="hover:text-indigo-700 font-medium">
                            Log in
                        </a>

                        <a href="{{ route('register') }}"
                           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                            Sign up
                        </a>
                    @else
                        <!-- User Dropdown -->
                        <div class="relative">
                            <button onclick="toggleUserMenu()"
                                class="flex items-center space-x-2 focus:outline-none hover:text-indigo-700 transition">
                                <span class="font-medium">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div id="userMenu"
                                 class="hidden absolute right-0 mt-3 w-48 bg-white rounded-xl shadow-lg border border-gray-200 py-2 z-50">

                                <a href="{{ route('poems.my') }}"
                                   class="block px-4 py-2 text-sm hover:bg-gray-100">
                                    My Poems
                                </a>

                                <a href="{{ route('poems.create') }}"
                                   class="block px-4 py-2 text-sm hover:bg-gray-100">
                                    Write Poem
                                </a>

                                <hr class="my-2">

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                        Log out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endguest

                    <!-- Mobile Menu Button -->
                    <button onclick="toggleMobileMenu()"
                        class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu"
             class="hidden md:hidden bg-white border-t border-gray-200 px-4 py-4 space-y-3">

            <a href="{{ route('poems.index') }}"
               class="block hover:text-indigo-700">
                Discover
            </a>

            @auth
                <a href="{{ route('poems.create') }}"
                   class="block hover:text-indigo-700">
                    Write
                </a>

                <a href="{{ route('poems.my') }}"
                   class="block hover:text-indigo-700">
                    My Poems
                </a>
            @endauth
        </div>
    </header>

    <!-- MAIN -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-gray-400 py-10 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm">
                © {{ date('Y') }} Poetry Haven. Crafted with passion for poets.
            </p>
            <p class="text-xs mt-2 opacity-60">
                Where words become timeless.
            </p>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        function toggleUserMenu() {
            document.getElementById('userMenu').classList.toggle('hidden');
        }

        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const userMenu = document.getElementById('userMenu');
            if (!e.target.closest('.relative')) {
                if(userMenu) userMenu.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
