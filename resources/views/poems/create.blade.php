@extends('layouts.app')

@section('title', 'Create New Poem')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-gray-900">Write a New Poem</h1>
        <p class="text-gray-600 mt-2">Share your creativity with the world</p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('poems.store') }}" class="bg-white rounded-lg shadow-md p-8">
        @csrf

        <div class="mb-6">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Poem Title</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                value="{{ old('title') }}"
                placeholder="Give your poem a beautiful title"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                required>
        </div>

        <div class="mb-8">
            <label for="body" class="block text-sm font-medium text-gray-700 mb-2">Your Poem</label>
            <textarea 
                id="body" 
                name="body" 
                rows="15"
                placeholder="Pour your soul into your poem..."
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent font-serif text-base"
                required>{{ old('body') }}</textarea>
        </div>

        <div class="flex gap-4">
            <button 
                type="submit" 
                class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                Publish Poem
            </button>
            <a 
                href="{{ route('poems.index') }}" 
                class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                Cancel
            </a>
</div>
@endsection
