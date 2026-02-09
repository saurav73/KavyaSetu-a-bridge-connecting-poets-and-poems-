<article class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 border border-gray-100">
    <div class="p-6">
        <h2 class="text-2xl font-serif font-semibold text-gray-900 mb-3 line-clamp-2">
            <a href="{{ route('poems.show', $poem->slug) }}" class="hover:text-indigo-700 transition">
                {{ $poem->title }}
            </a>
        </h2>

        <div class="prose prose-sm text-gray-700 line-clamp-5 mb-5">
            {!! nl2br(e($poem->body)) !!}
        </div>

        <div class="flex items-center justify-between text-sm text-gray-500">
            <div class="flex items-center">
                <span>by</span>
                <a href="#" class="ml-1.5 font-medium text-indigo-700 hover:underline">
                    {{ $poem->user->name }}
                </a>
            </div>
            <time datetime="{{ $poem->created_at }}" class="text-gray-500">
                {{ $poem->created_at->diffForHumans() }}
            </time>
        </div>
    </div>
</article>