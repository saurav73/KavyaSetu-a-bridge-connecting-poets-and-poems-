@extends('layouts.app')

@section('title', 'Edit Task - Todo List')

@section('content')
<div class="card">
    <div class="header">
        <h1> Edit Task</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">← Back to List</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul style="list-style: none; margin: 0; padding: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $task->title) }}" 
                   placeholder="Enter task title" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" 
                      placeholder="Enter task description" required>{{ old('description', $task->description) }}</textarea>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-success">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
