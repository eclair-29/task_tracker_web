<?php

namespace Database\Seeders;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TasksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now();
        $tasks = [
            ['description' => 'Deploy Project 007 to production', 'status_id' => getTaskStatusByDescription('Pending')->id, 'ticket_id' => 'TASK_0524_0001', 'assigned_to' => 2, 'created_by' => 1, 'updated_by' => 1, 'priority_id' => 2, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Support: Debug production application known issue no. 1', 'status_id' => getTaskStatusByDescription('In progress')->id, 'ticket_id' => 'TASK_0524_0002', 'assigned_to' => 2, 'created_by' => 2, 'updated_by' => 2, 'priority_id' => 3, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Meet with Project 007 stakeholders for new feature request', 'status_id' => getTaskStatusByDescription('Done')->id, 'ticket_id' => 'TASK_0524_0003', 'assigned_to' => 2, 'created_by' => 2, 'updated_by' => 2, 'priority_id' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Write test cases for Project 007 user authentication', 'status_id' => getTaskStatusByDescription('Pending')->id, 'ticket_id' => 'TASK_0524_0004', 'assigned_to' => 3, 'created_by' => 1, 'updated_by' => 1, 'priority_id' => 2, 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
