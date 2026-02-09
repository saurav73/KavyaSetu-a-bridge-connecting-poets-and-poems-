@extends('layouts.app')

@section('title', $poem->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Poem Header -->
    <div class="mb-8 border-b border-gray-200 pb-8">
        <h1 class="text-4xl font-serif font-bold text-gray-900 mb-4">{{ $poem->title }}</h1>
        
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div>
                    <p class="font-medium text-gray-900">{{ $poem->user->name }}</p>
                    <p class="text-sm text-gray-500">
                        {{ $poem->created_at->format('F j, Y') }}
                        @if ($poem->created_at->ne($poem->updated_at))
                            <span class="ml-2">(edited {{ $poem->updated_at->format('F j, Y') }})</span>
                        @endif
                    </p>
                </div>
            </div>

            @if ($poem->isOwnedByCurrentUser())
                <div class="flex gap-2">
                    <a 
                        href="{{ route('poems.edit', $poem->slug) }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Edit
                    </a>
                    <form 
                        method="POST" 
                        action="{{ route('poems.destroy', $poem->slug) }}"
                        onsubmit="return confirm('Are you sure you want to delete this poem?');"
                        class="inline">
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit"
                            class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                            Delete
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <!-- Poem Content -->
    <div class="prose prose-lg max-w-none mb-12">
        <div class="font-serif text-xl leading-relaxed text-gray-800 whitespace-pre-line">
            {{ $poem->body }}
        </div>
    </div>

    <!-- Poem Stats -->
    <div class="bg-gray-50 rounded-lg p-6 flex gap-8">
        <div>
            <p class="text-sm text-gray-600">Reading Time</p>
            <p class="text-2xl font-bold text-gray-900">{{ $poem->reading_time }} min</p>
        </div>
        <div>
            <p class="text-sm text-gray-600">Word Count</p>
            <p class="text-2xl font-bold text-gray-900">{{ str_word_count(strip_tags($poem->body)) }}</p>
        </div>
    </div>

    <!-- Back Link -->
    <div class="mt-8">
        <a 
            href="{{ route('poems.index') }}"
            class="text-indigo-600 hover:text-indigo-700 transition font-medium">
            ← Back to All Poems
        </a>
    </div>
</div>
@endsection