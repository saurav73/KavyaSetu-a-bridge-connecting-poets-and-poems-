<?php

namespace App\Http\Controllers;

use App\Http\Requests\PoemStoreRequest;
use App\Http\Requests\PoemUpdateRequest;
use App\Models\Poem;
use Illuminate\Http\Request;

class PoemController extends Controller
{
    public function index()
    {
        $poems = Poem::latest()
            ->with('user:id,name')
            ->where('is_published', true)
            ->simplePaginate(12);

        return view('poems.index', compact('poems'));
    }

    public function show(Poem $poem)
    {
        if (!$poem->is_published && $poem->user_id !== auth()->id()) {
            abort(404);
        }

        $poem->load('user:id,name');
        return view('poems.show', compact('poem'));
    }

    public function create()
    {
        return view('poems.create');
    }

    public function store(PoemStoreRequest $request)
    {
        $poem = auth()->user()->poems()->create($request->validated());

        return redirect()
            ->route('poems.show', $poem->slug)
            ->with('success', 'Your poem has been published.');
    }

    public function edit(Poem $poem)
    {
        $this->authorize('update', $poem);
        return view('poems.edit', compact('poem'));
    }

    public function update(PoemUpdateRequest $request, Poem $poem)
    {
        $this->authorize('update', $poem);
        $poem->update($request->validated());

        return redirect()
            ->route('poems.show', $poem->slug)
            ->with('success', 'Poem updated.');
    }

    public function destroy(Poem $poem)
    {
        $this->authorize('delete', $poem);
        $poem->delete();

        return redirect()->route('poems.my')->with('success', 'Poem deleted.');
    }

    public function myPoems()
    {
        $poems = auth()->user()->poems()->latest()->simplePaginate(10);
        return view('poems.my', compact('poems'));
    }
}