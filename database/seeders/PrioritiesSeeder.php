<?php

namespace Database\Seeders;

use App\Models\Priority;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrioritiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now();
        $priorities = [
            ['description' => 'Low', 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'Medium', 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'High', 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($priorities as $priority) {
            Priority::create($priority);
        }
    }
}
