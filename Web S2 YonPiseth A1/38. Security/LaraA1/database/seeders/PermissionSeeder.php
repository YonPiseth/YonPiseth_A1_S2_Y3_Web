<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $manageUsers = \App\Models\Permission::firstOrCreate(['name' => 'manage_users', 'description' => 'Manage users']);
        $viewReports = \App\Models\Permission::firstOrCreate(['name' => 'view_reports', 'description' => 'View reports']);

        $adminRole = \App\Models\Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminRole->permissions()->syncWithoutDetaching([$manageUsers->id, $viewReports->id]);
        }
    }
}
