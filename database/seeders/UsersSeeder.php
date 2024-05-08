<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = Carbon::now();

        $users = [
            ['status_id' => getUserStatusByDescription('active')->id, 'name' => 'Admin', 'email' => 'root031@yopmail.com', 'username' => 'root', 'password' => Hash::make('12345678'), 'created_at' => $date, 'updated_at' => $date],
            ['status_id' => getUserStatusByDescription('active')->id, 'name' => 'Miguel De Chavez', 'email' => 'user033@yopmail.com', 'username' => 'mdechavez', 'password' => Hash::make('12345678'), 'created_at' => $date, 'updated_at' => $date],
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        User::find(1)->assignRole('admin');
        User::find(2)->assignRole('user');
    }
}
