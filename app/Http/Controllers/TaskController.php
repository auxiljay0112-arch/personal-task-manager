<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    /**
     * Display a listing of all tasks (View Tasks).
     */
    public function index(Request $request): View
    {
        $status = $request->query('status'); // optional filter: pending / completed

        $tasks = Task::query()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->orderBy('due_date')
            ->orderByDesc('created_at')
            ->get();

        return view('tasks.index', [
            'tasks' => $tasks,
            'currentFilter' => $status,
        ]);
    }

    /**
     * Show the form for creating a new task (Add Task).
     */
    public function create(): View
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created task in the database.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateTask($request);

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task added successfully.');
    }

    /**
     * Show the form for editing the specified task (Edit Task).
     */
    public function edit(Task $task): View
    {
        return view('tasks.edit', ['task' => $task]);
    }

    /**
     * Update the specified task in the database.
     */
    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $this->validateTask($request);

        $task->update($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified task from the database (Delete Task).
     */
    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }

    /**
     * Toggle / set the status of a task between Pending and Completed.
     */
    public function updateStatus(Task $task): RedirectResponse
    {
        $task->update([
            'status' => $task->isCompleted() ? Task::STATUS_PENDING : Task::STATUS_COMPLETED,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task status updated.');
    }

    /**
     * Shared validation rules for store() and update().
     */
    private function validateTask(Request $request): array
    {
        return $request->validate([
            'task_name'   => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status'      => ['required', 'in:pending,completed'],
            'due_date'    => ['nullable', 'date'],
        ]);
    }
}
