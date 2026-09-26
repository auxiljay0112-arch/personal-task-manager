<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Redirect the home page straight to the task list.
Route::redirect('/', '/tasks');

// Standard RESTful CRUD routes for tasks:
// GET    /tasks              -> index    (View Tasks)
// GET    /tasks/create        -> create   (show Add Task form)
// POST   /tasks               -> store    (Add Task)
// GET    /tasks/{task}/edit   -> edit     (show Edit Task form)
// PUT    /tasks/{task}        -> update   (Edit Task)
// DELETE /tasks/{task}        -> destroy  (Delete Task)
Route::resource('tasks', TaskController::class)->except(['show']);

// Dedicated route for the Update Status feature (Pending <-> Completed toggle).
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])
    ->name('tasks.status');
