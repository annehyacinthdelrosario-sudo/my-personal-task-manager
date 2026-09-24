<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Task::create([
            'task_name' => 'Finish Laravel Mini Project',
            'description' => 'Complete the Personal Task Manager and upload it to GitHub.',
            'status' => 'Pending',
            'due_date' => now()->addDays(7)->toDateString(),
        ]);

        Task::create([
            'task_name' => 'Study Laravel CRUD',
            'description' => 'Review Routes, Controller, Model, Database, and Blade.',
            'status' => 'Completed',
            'due_date' => now()->toDateString(),
        ]);
    }
}