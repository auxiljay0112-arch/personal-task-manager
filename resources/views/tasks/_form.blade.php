<div>
    <label for="task_name" class="block text-sm font-semibold text-slate-700 mb-1">Task Name</label>
    <input type="text" name="task_name" id="task_name"
           value="{{ old('task_name', $task->task_name ?? '') }}"
           placeholder="e.g. Finish Laravel project"
           class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
           required>
</div>

<div>
    <label for="description" class="block text-sm font-semibold text-slate-700 mb-1">Description</label>
    <textarea name="description" id="description" rows="4"
              placeholder="Task details (optional)"
              class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $task->description ?? '') }}</textarea>
</div>

<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="due_date" class="block text-sm font-semibold text-slate-700 mb-1">Due Date</label>
        <input type="date" name="due_date" id="due_date"
               value="{{ old('due_date', isset($task, $task->due_date) ? $task->due_date->format('Y-m-d') : '') }}"
               class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
    </div>

    <div>
        <label for="status" class="block text-sm font-semibold text-slate-700 mb-1">Status</label>
        <select name="status" id="status"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <option value="pending" {{ old('status', $task->status ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ old('status', $task->status ?? 'pending') === 'completed' ? 'selected' : '' }}>Completed</option>
        </select>
    </div>
</div>
