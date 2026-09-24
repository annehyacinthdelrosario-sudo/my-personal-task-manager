<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->orderBy('due_date')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalTasks = $tasks->count();
        $completedTasks = $tasks->where('status', 'Completed')->count();
        $pendingTasks = $tasks->where('status', 'Pending')->count();

        return view('tasks.index', compact(
            'tasks',
            'totalTasks',
            'completedTasks',
            'pendingTasks'
        ));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:Pending,Completed'],
            'due_date' => ['nullable', 'date'],
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'task_name' => $validated['task_name'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'due_date' => $validated['due_date'] ?? null,
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task added successfully!');
    }

    public function edit(Task $task)
    {
        $task = $this->getUserTask($task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $task = $this->getUserTask($task);

        $validated = $request->validate([
            'task_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:Pending,Completed'],
            'due_date' => ['nullable', 'date'],
        ]);

        $task->update($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully!');
    }

    public function destroy(Task $task)
    {
        $task = $this->getUserTask($task);

        $task->delete();

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task deleted successfully!');
    }

    public function updateStatus(Task $task)
    {
        $task = $this->getUserTask($task);

        $task->update([
            'status' => $task->status === 'Pending'
                ? 'Completed'
                : 'Pending',
        ]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task status updated!');
    }

    private function getUserTask(Task $task)
    {
        return Task::where('user_id', Auth::id())
            ->where('id', $task->id)
            ->firstOrFail();
    }
}