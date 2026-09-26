@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900">My Tasks</h1>
            <p class="text-sm text-slate-500 mt-1">
                {{ $tasks->count() }} total &middot;
                {{ $tasks->where('status', 'pending')->count() }} pending &middot;
                {{ $tasks->where('status', 'completed')->count() }} completed
            </p>
        </div>

        <div class="flex gap-2 text-sm">
            <a href="{{ route('tasks.index') }}"
               class="px-3 py-1.5 rounded-lg font-medium border {{ !$currentFilter ? 'bg-indigo-600 text-white border-indigo-600' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
                All
            </a>
            <a href="{{ route('tasks.index', ['status' => 'pending']) }}"
               class="px-3 py-1.5 rounded-lg font-medium border {{ $currentFilter === 'pending' ? 'bg-amber-500 text-white border-amber-500' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
                Pending
            </a>
            <a href="{{ route('tasks.index', ['status' => 'completed']) }}"
               class="px-3 py-1.5 rounded-lg font-medium border {{ $currentFilter === 'completed' ? 'bg-green-600 text-white border-green-600' : 'bg-white text-slate-600 border-slate-200 hover:bg-slate-50' }}">
                Completed
            </a>
        </div>
    </div>

    @if ($tasks->isEmpty())
        <div class="bg-white rounded-2xl border border-dashed border-slate-300 p-12 text-center">
            <p class="text-4xl mb-3">🗒️</p>
            <p class="text-slate-600 font-medium">No tasks here yet.</p>
            <a href="{{ route('tasks.create') }}" class="inline-block mt-4 text-indigo-600 font-semibold hover:underline">
                Add your first task &rarr;
            </a>
        </div>
    @else
        <div class="grid gap-4">
            @foreach ($tasks as $task)
                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 flex flex-col sm:flex-row sm:items-center gap-4">

                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 flex-wrap">
                            <h2 class="font-semibold text-slate-900 {{ $task->isCompleted() ? 'line-through text-slate-400' : '' }}">
                                {{ $task->task_name }}
                            </h2>

                            @if ($task->isCompleted())
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-green-100 text-green-700">Completed</span>
                            @elseif ($task->isOverdue())
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-700">Overdue</span>
                            @else
                                <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-amber-100 text-amber-700">Pending</span>
                            @endif
                        </div>

                        @if ($task->description)
                            <p class="text-sm text-slate-500 mt-1 line-clamp-2">{{ $task->description }}</p>
                        @endif

                        @if ($task->due_date)
                            <p class="text-xs text-slate-400 mt-2">
                                📅 Due {{ $task->due_date->format('M d, Y') }}
                            </p>
                        @endif
                    </div>

                    <div class="flex items-center gap-2 shrink-0">
                        <form action="{{ route('tasks.status', $task) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="text-xs font-semibold px-3 py-2 rounded-lg border transition
                                    {{ $task->isCompleted()
                                        ? 'border-slate-200 text-slate-600 hover:bg-slate-50'
                                        : 'border-green-200 text-green-700 hover:bg-green-50' }}">
                                {{ $task->isCompleted() ? 'Mark Pending' : 'Mark Completed' }}
                            </button>
                        </form>

                        <a href="{{ route('tasks.edit', $task) }}"
                           class="text-xs font-semibold px-3 py-2 rounded-lg border border-slate-200 text-slate-600 hover:bg-slate-50 transition">
                            Edit
                        </a>

                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                              onsubmit="return confirm('Delete this task? This cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-xs font-semibold px-3 py-2 rounded-lg border border-red-200 text-red-600 hover:bg-red-50 transition">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

@endsection
