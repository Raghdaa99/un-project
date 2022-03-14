<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();
        // \App\Models\Admin::factory(5)->create();

        Permission::create(['name' => 'Create-Specialty', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Specialties', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Specialty', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Specialty', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Read-Specialties', 'guard_name' => 'web']);
    }
}
