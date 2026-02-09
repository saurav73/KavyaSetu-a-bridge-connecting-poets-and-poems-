@extends('layouts.app')

@section('title', 'My Todo List')

@section('content')
<div class="card">
    <div class="header">
        <h1> My Todo List</h1>
        <div class="user-info">
            <span> {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm">Logout</button>
            </form>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div style="margin-bottom: 25px; display: flex; gap: 10px;">
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">
            Add New Task
        </a>
        <a href="{{ route('tasks.global') }}" class="btn btn-secondary">
            View Global Tasks
        </a>
    </div>

    @if($tasks->count() > 0)
        <div class="task-list">
            @foreach ($tasks as $task)
                <div class="task-item">
                    <h3>{{ $task->title }}</h3>
                    <p>{{ $task->description }}</p>
                    <div class="task-actions">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-success btn-sm">
                            Edit
                        </a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                    onclick="return confirm('Are you sure you want to delete this task?')">
                            Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <h2>No tasks yet!</h2>
            <p>Start by creating your first task above.</p>
        </div>
    @endif
</div>
@endsection
