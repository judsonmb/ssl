<?php

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
        $this->call(InstitutionsTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
