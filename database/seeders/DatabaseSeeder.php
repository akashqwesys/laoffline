<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CreatePermissionsSeeder::class,
            CreateEmployeesSeeder::class,
            CreateUserGroupSeeder::class,
            CreateUsersSeeder::class,
            CreateCountriesSeeder::class,
            CreateStatesSeeder::class,
        ]);
    }
}
