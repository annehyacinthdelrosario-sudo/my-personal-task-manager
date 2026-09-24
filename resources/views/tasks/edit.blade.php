@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')
    <div class="form-page">
        <div class="form-header">
            <a href="{{ route('tasks.index') }}" class="back-link">← Back to tasks</a>
            <p class="eyebrow">EDIT TASK</p>
            <h1>Update Task</h1>
            <p>Change the information for this task.</p>
        </div>

        <form method="POST" action="{{ route('tasks.update', $task) }}" class="task-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="task_name">Task Name <span>*</span></label>
                <input type="text" id="task_name" name="task_name"
                       value="{{ old('task_name', $task->task_name) }}" required maxlength="255">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="status">Status <span>*</span></label>
                    <select id="status" name="status" required>
                        <option value="Pending" @selected(old('status', $task->status) === 'Pending')>Pending</option>
                        <option value="Completed" @selected(old('status', $task->status) === 'Completed')>Completed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" id="due_date" name="due_date"
                           value="{{ old('due_date', optional($task->due_date)->format('Y-m-d')) }}">
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Update Task</button>
            </div>
        </form>
    </div>
@endsection