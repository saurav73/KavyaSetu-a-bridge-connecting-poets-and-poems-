@extends('layouts.app')

@section('title', 'My Poems')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex justify-between items-center mb-10">
        <h1 class="text-4xl font-serif font-bold text-gray-900">My Poems</h1>
        <a 
            href="{{ route('poems.create') }}"
            class="inline-flex items-center px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Write New
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if ($poems->isEmpty())
        <div class="text-center py-20 bg-gray-50 rounded-lg">
            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747 0-6.002-4.5-10.747-10-10.747z" />
            </svg>
            <p class="text-gray-600 text-xl">No poems yet. Start writing your first poem!</p>
            <a 
                href="{{ route('poems.create') }}"
                class="inline-block mt-4 px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                Write Your First Poem
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach ($poems as $poem)
                <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-grow">
                            <a 
                                href="{{ route('poems.show', $poem->slug) }}"
                                class="text-2xl font-serif font-bold text-gray-900 hover:text-indigo-700 transition">
                                {{ $poem->title }}
                            </a>
                            <p class="text-gray-600 mt-2">{{ $poem->excerpt }}</p>
                            <div class="flex items-center gap-4 mt-4 text-sm text-gray-500">
                                <span>{{ $poem->created_at->format('M d, Y') }}</span>
                                <span>{{ $poem->reading_time }} min read</span>
                                <span class="px-2 py-1 rounded-full {{ $poem->is_published ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $poem->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </div>
                        </div>
                        <div class="flex gap-2 ml-4">
                            <a 
                                href="{{ route('poems.edit', $poem->slug) }}"
                                class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                                Edit
                            </a>
                            <form 
                                method="POST" 
                                action="{{ route('poems.destroy', $poem->slug) }}"
                                onsubmit="return confirm('Delete this poem?');"
                                class="inline">
                                @csrf
                                @method('DELETE')
                                <button 
                                    type="submit"
                                    class="px-3 py-1.5 bg-red-600 text-white text-sm rounded hover:bg-red-700 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $poems->links() }}
        </div>
    @endif
</div>
@endsection