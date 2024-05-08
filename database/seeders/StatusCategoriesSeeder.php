<?php

namespace Database\Seeders;

use App\Models\StatusCategory;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now();
        $categories = [
            ['description' => 'user', 'created_at' => $date, 'updated_at' => $date],
            ['description' => 'task', 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($categories as $category) {
            StatusCategory::create($category);
        }
    }
}
