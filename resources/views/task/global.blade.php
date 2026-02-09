@extends('layouts.app')

@section('title', 'Global Tasks')

@section('content')
<div class="card">
    <div class="header">
        <h1>Global Tasks</h1>
        <div class="user-info">
            <span> {{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-secondary btn-sm">Logout</button>
            </form>
        </div>
    </div>

    <div style="margin-bottom: 25px;">
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">
            My Tasks
        </a>
        <a href="{{ route('tasks.global') }}" class="btn btn-secondary">
            Global Tasks
        </a>
    </div>

    @if($tasks->count() > 0)
        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <h3 style="margin: 0; font-size: 1.2rem;">Total Tasks: <strong>{{ $tasks->count() }}</strong></h3>
        </div>
        <div class="task-list">
            @foreach ($tasks as $task)
                <div style="background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-left: 5px solid #667eea; padding: 20px; margin-bottom: 20px; border-radius: 8px; position: relative;">
                    <div style="font-style: italic; color: #667eea; font-size: 1.3rem; line-height: 1.8; white-space: pre-wrap; word-wrap: break-word; font-family: 'Georgia', serif;">{{ $task->title }}</div>
                    <div style="margin-top: 15px; padding-top: 15px; border-top: 2px dashed #667eea; font-size: 0.95rem; line-height: 1.6; color: #333; white-space: pre-wrap; word-wrap: break-word;">{{ $task->description }}</div>
                    <div style="text-align: right; margin-top: 15px; font-style: italic; color: #666; font-size: 0.9rem;">
                        — {{ $task->user->name }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <h2>No global tasks yet!</h2>
            <p>Other users haven't created any tasks to share.</p>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Auto-refresh page every 10 seconds
    setInterval(function() {
        location.reload();
    }, 10000);
</script>
@endsection
