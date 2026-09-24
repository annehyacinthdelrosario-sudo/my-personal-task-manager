@extends('layouts.app')

@section('title', 'Add Task')

@section('content')
    <div class="form-page">
        <div class="form-header">
            <a href="{{ route('tasks.index') }}" class="back-link">← Back to tasks</a>
            <p class="eyebrow">NEW TASK</p>
            <h1>Create a Task</h1>
            <p>Add a new task to your personal task list.</p>
        </div>

        <form method="POST" action="{{ route('tasks.store') }}" class="task-form">
            @csrf

            <div class="form-group">
                <label for="task_name">Task Name <span>*</span></label>
                <input type="text" id="task_name" name="task_name"
                       value="{{ old('task_name') }}" required maxlength="255"
                       placeholder="e.g. Finish database assignment">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="5"
                          placeholder="Add some details about this task...">{{ old('description') }}</textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="status">Status <span>*</span></label>
                    <select id="status" name="status" required>
                        <option value="Pending" @selected(old('status', 'Pending') === 'Pending')>Pending</option>
                        <option value="Completed" @selected(old('status') === 'Completed')>Completed</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}">
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Task</button>
            </div>
        </form>
    </div>
@endsection