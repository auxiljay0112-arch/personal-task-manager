@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

    <div class="max-w-xl mx-auto">
        <h1 class="text-2xl font-extrabold text-slate-900 mb-6">Edit Task</h1>

        <form action="{{ route('tasks.update', $task) }}" method="POST" class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6 space-y-5">
            @csrf
            @method('PUT')

            @include('tasks._form', ['task' => $task])

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('tasks.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Cancel
                </a>
                <button type="submit" class="px-5 py-2 rounded-lg text-sm font-semibold bg-indigo-600 hover:bg-indigo-700 text-white shadow-sm">
                    Update Task
                </button>
            </div>
        </form>
    </div>

@endsection
