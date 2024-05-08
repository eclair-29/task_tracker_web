<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create task']);
        Permission::create(['name' => 'edit task']);
        Permission::create(['name' => 'delete task']);
        Permission::create(['name' => 'view all tasks']); // view all users tasks
        Permission::create(['name' => 'view tasks']); // view only task for authenticated user

        // create roles and assign created permissions
        Role::create(['name' => 'admin'])
            ->givePermissionTo(['create task', 'edit task', 'delete task', 'view all tasks', 'view tasks']);

        Role::create(['name' => 'user'])
            ->givePermissionTo(['edit task', 'view tasks', 'delete task']);
    }
}
