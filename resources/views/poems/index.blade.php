@extends('layouts.app')

@section('title', 'Discover Poems')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-4xl font-serif font-bold text-gray-900">Latest Poems</h1>
            @auth
                <a href="{{ route('poems.create') }}"
                   class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Write New
                </a>
            @endauth
        </div>

        @if ($poems->isEmpty())
            <p class="text-center text-gray-500 py-20 text-xl">No poems yet... be the first to share yours!</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($poems as $poem)
                    @include('poems.components.poem-card')
                @endforeach
            </div>

            <div class="mt-12">
                {{ $poems->links() }}
            </div>
        @endif
    </div>
@endsection