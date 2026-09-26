# Personal Task Manager

A simple Laravel-based Personal Task Manager built for the WST21 mini project.
It applies the Route → Controller → Model → Database → Blade flow to manage
day-to-day tasks: create them, view them, edit them, delete them, and flip
their status between Pending and Completed.

Project Code: WST21-PM-2026-SF
Student Name: AUXIL JAY MOROÑA
Course & Year: BSIT-2, SECTION 10
Database Used: SQLite

Features:
- Add Task
- View Tasks
- Edit Task
- Delete Task
- Update Status

## Tech Stack

- Laravel 11 (PHP)
- Blade templating
- Tailwind CSS (via CDN, no build step required)
- MySQL / SQLite (see Database Used above)

## How It Works

- **Model** — `app/Models/Task.php` represents a row in the `tasks` table
  (`task_name`, `description`, `status`, `due_date`).
- **Migration** — `database/migrations/..._create_tasks_table.php` defines
  the table schema.
- **Controller** — `app/Http/Controllers/TaskController.php` handles all
  CRUD logic (`index`, `create`, `store`, `edit`, `update`, `destroy`) plus
  a dedicated `updateStatus` action for toggling Pending/Completed.
- **Routes** — `routes/web.php` maps URLs to controller actions using
  `Route::resource()` for the standard CRUD verbs, and a `PATCH` route for
  status updates.
- **Views** — `resources/views/tasks/*.blade.php` render the task list,
  the add-task form, and the edit-task form, all sharing one layout
  (`resources/views/layouts/app.blade.php`) and one form partial
  (`tasks/_form.blade.php`) so the create/edit markup isn't duplicated.

## Screens

- **Task List (`/tasks`)** — cards showing each task's name, description,
  due date, and a status badge (Pending / Completed / Overdue), with
  quick actions to mark status, edit, or delete. Includes filter tabs
  (All / Pending / Completed).
- **Add Task (`/tasks/create`)** — form for task name, description,
  due date, and initial status.
- **Edit Task (`/tasks/{id}/edit`)** — same form, pre-filled, for updating
  an existing task.

## Setup

See [SETUP.md](SETUP.md) for full step-by-step installation instructions
(installing Laravel, copying in these files, configuring the database,
running migrations, and serving the app locally).

Quick version if you already have a Laravel app scaffolded with these
files in place:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Then visit `http://127.0.0.1:8000`.
