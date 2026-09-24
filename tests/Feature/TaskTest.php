<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_tasks_page_can_be_viewed(): void
    {
        $response = $this->get('/tasks');

        $response->assertStatus(200);
        $response->assertSee('My Tasks');
    }

    public function test_task_can_be_created(): void
    {
        $response = $this->post('/tasks', [
            'task_name' => 'Test Task',
            'description' => 'Testing task creation.',
            'status' => 'Pending',
            'due_date' => '2026-12-31',
        ]);

        $response->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'task_name' => 'Test Task',
            'status' => 'Pending',
        ]);
    }

    public function test_task_status_can_be_toggled(): void
    {
        $task = Task::create([
            'task_name' => 'Toggle Me',
            'description' => null,
            'status' => 'Pending',
            'due_date' => null,
        ]);

        $this->patch("/tasks/{$task->id}/status")
            ->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'Completed',
        ]);
    }

    public function test_task_can_be_updated(): void
    {
        $task = Task::create([
            'task_name' => 'Old Name',
            'description' => 'Old description',
            'status' => 'Pending',
            'due_date' => null,
        ]);

        $this->put("/tasks/{$task->id}", [
            'task_name' => 'New Name',
            'description' => 'New description',
            'status' => 'Completed',
            'due_date' => '2026-12-31',
        ])->assertRedirect('/tasks');

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'task_name' => 'New Name',
            'status' => 'Completed',
        ]);
    }

    public function test_task_can_be_deleted(): void
    {
        $task = Task::create([
            'task_name' => 'Delete Me',
            'description' => null,
            'status' => 'Pending',
            'due_date' => null,
        ]);

        $this->delete("/tasks/{$task->id}")
            ->assertRedirect('/tasks');

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}