<?php

namespace Database\Seeders;

use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now();
        $statuses = [
            ['category_id' => getStatusCategoryByDescription('user')->id, 'description' => 'active',  'created_at' => $date, 'updated_at' => $date],
            ['category_id' => getStatusCategoryByDescription('user')->id, 'description' => 'inactive',  'created_at' => $date, 'updated_at' => $date],
            ['category_id' => getStatusCategoryByDescription('task')->id, 'description' => 'pending',  'created_at' => $date, 'updated_at' => $date],
            ['category_id' => getStatusCategoryByDescription('task')->id, 'description' => 'in progress',  'created_at' => $date, 'updated_at' => $date],
            ['category_id' => getStatusCategoryByDescription('task')->id, 'description' => 'done',  'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
