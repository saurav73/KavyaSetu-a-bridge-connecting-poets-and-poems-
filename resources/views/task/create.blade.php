@extends('layouts.app')

@section('title', 'Create Task - Todo List')

@section('content')
<div class="card">
    <div class="header">
        <h1>Create New Task</h1>
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

    <form method="POST" action="{{ route('tasks.store') }}">
        @csrf

        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" 
                   placeholder="Enter task title" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" 
                      placeholder="Enter task description" required>{{ old('description') }}</textarea>
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" class="btn btn-primary">Create Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
