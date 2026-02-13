@extends('layouts.app')

@section('title', 'My Poems')

@section('content')
<div class="max-w-2xl mx-auto px-4 py-10">

    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-serif font-bold text-gray-900">
            My Poems
        </h1>

        <a href="{{ route('poems.create') }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            + Write
        </a>
    </div>

    <!-- Success Message -->
    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Empty State -->
    @if ($poems->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-xl">
            <p class="text-gray-600 text-lg">
                No poems yet. Start writing your first poem!
            </p>
            <a href="{{ route('poems.create') }}"
               class="inline-block mt-4 px-5 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Write Your First Poem
            </a>
        </div>
    @else

        <div class="space-y-6">

            @foreach ($poems as $poem)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 relative">

                <!-- Post Header -->
                <div class="flex items-center justify-between p-4">

                    <div class="flex items-center space-x-3">
                        <img 
                            src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}" 
                            class="w-10 h-10 rounded-full"
                            alt="avatar">

                        <div>
                            <p class="font-semibold text-gray-900">
                                {{ auth()->user()->name }}
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $poem->created_at->diffForHumans() }}
                                • {{ $poem->reading_time }} min read
                            </p>
                        </div>
                    </div>

                    <!-- 3 Dot Menu -->
                    <div class="relative">
                        <button onclick="toggleMenu({{ $poem->id }})"
                            class="p-2 rounded-full hover:bg-gray-100">
                            <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M6 10a2 2 0 110-4 2 2 0 010 4zm4 0a2 2 0 110-4 2 2 0 010 4zm4 0a2 2 0 110-4 2 2 0 010 4z"/>
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div id="menu-{{ $poem->id }}"
                            class="hidden absolute right-0 mt-2 w-32 bg-white border rounded-lg shadow-md z-10">

                            <a href="{{ route('poems.edit', $poem->slug) }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Edit
                            </a>

                            <form method="POST" 
                                action="{{ route('poems.destroy', $poem->slug) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Delete this poem?');"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="px-4 pb-5">
                    <a href="{{ route('poems.show', $poem->slug) }}">
                        <h2 class="text-xl font-bold text-gray-900 hover:text-indigo-600 transition">
                            {{ $poem->title }}
                        </h2>
                    </a>

                    <p class="text-gray-700 mt-3 leading-relaxed">
                        {{ $poem->excerpt }}
                    </p>

                    <div class="mt-4 text-xs">
                        <span class="px-3 py-1 rounded-full 
                            {{ $poem->is_published ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $poem->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                </div>

            </div>
            @endforeach

        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $poems->links() }}
        </div>

    @endif

</div>

<!-- Dropdown Script -->
<script>
    function toggleMenu(id) {
        const menu = document.getElementById('menu-' + id);

        document.querySelectorAll('[id^="menu-"]').forEach(el => {
            if (el !== menu) el.classList.add('hidden');
        });

        menu.classList.toggle('hidden');
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative')) {
            document.querySelectorAll('[id^="menu-"]').forEach(el => {
                el.classList.add('hidden');
            });
        }
    });
</script>

@endsection
