@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')

<div class="dashboard">

    <!-- Hero -->
    <section class="hero">

        <div class="hero-content">

            <div class="eyebrow">
                <span class="eyebrow-dot"></span>
                TASK DASHBOARD
            </div>

            <h1>
                Stay on top of
                <span class="gradient-text">your tasks.</span>
            </h1>

            <p class="hero-text">
                Plan your day, organize your work, and keep track of everything
                that matters.
            </p>

            <!-- Only New Task button -->
            <a href="{{ route('tasks.create') }}" class="btn btn-primary btn-large">
                ＋ New Task
            </a>

        </div>

        <div class="hero-decoration">
            <div class="decoration-circle circle-one"></div>
            <div class="decoration-circle circle-two"></div>
            <div class="decoration-check">✓</div>
        </div>

    </section>


    <!-- Statistics -->
    <section class="stats">

        <div class="stat-card">
            <div class="stat-icon total-icon">☷</div>

            <div>
                <span class="stat-label">Total Tasks</span>
                <strong>{{ $totalTasks }}</strong>
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-icon pending-icon">◷</div>

            <div>
                <span class="stat-label">Pending</span>
                <strong>{{ $pendingTasks }}</strong>
            </div>
        </div>


        <div class="stat-card">
            <div class="stat-icon completed-icon">✓</div>

            <div>
                <span class="stat-label">Completed</span>
                <strong>{{ $completedTasks }}</strong>
            </div>
        </div>

    </section>


    <!-- Tasks heading -->
    <section class="section-heading">

        <div>
            <p class="section-eyebrow">YOUR WORKSPACE</p>

            <h2>My Tasks</h2>

            <p>
                Manage your tasks and keep your progress organized.
            </p>
        </div>

        @if (!$tasks->isEmpty())
            <span class="task-count">
                {{ $totalTasks }}
                {{ $totalTasks === 1 ? 'task' : 'tasks' }}
            </span>
        @endif

    </section>


    <!-- Empty state -->
    @if ($tasks->isEmpty())

        <div class="empty-state">

            <div class="empty-icon">✓</div>

            <h3>Your task list is empty</h3>

            <p>
                You don't have any tasks yet.
                Click <strong>New Task</strong> above to create one.
            </p>

        </div>


    @else

        <!-- Task grid -->
        <div class="task-grid">

            @foreach ($tasks as $task)

                <article
                    class="task-card {{ $task->status === 'Completed' ? 'is-completed' : '' }}"
                >

                    <!-- Task top -->
                    <div class="task-top">

                        <span class="badge {{ strtolower($task->status) }}">

                            @if ($task->status === 'Completed')
                                ✓
                            @else
                                ◷
                            @endif

                            {{ $task->status }}

                        </span>


                        @if ($task->due_date)

                            <span class="due-date">
                                📅 {{ $task->due_date->format('M d, Y') }}
                            </span>

                        @endif

                    </div>


                    <!-- Task title -->
                    <h3>
                        {{ $task->task_name }}
                    </h3>


                    <!-- Description -->
                    <p class="description">
                        {{ $task->description ?: 'No description provided.' }}
                    </p>


                    <!-- Task actions -->
                    <div class="task-actions">

                        <!-- Complete / Reopen -->
                        <form
                            method="POST"
                            action="{{ route('tasks.status', $task) }}"
                        >
                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                class="btn btn-status"
                            >
                                @if ($task->status === 'Pending')
                                    ✓ Complete
                                @else
                                    ↩ Reopen
                                @endif
                            </button>

                        </form>


                        <!-- Edit -->
                        <a
                            href="{{ route('tasks.edit', $task) }}"
                            class="btn btn-secondary"
                        >
                            ✎ Edit
                        </a>


                        <!-- Delete -->
                        <form
                            method="POST"
                            action="{{ route('tasks.destroy', $task) }}"
                            onsubmit="return confirm('Are you sure you want to delete this task?');"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger"
                            >
                                🗑 Delete
                            </button>

                        </form>

                    </div>

                </article>

            @endforeach

        </div>

    @endif

</div>

@endsection