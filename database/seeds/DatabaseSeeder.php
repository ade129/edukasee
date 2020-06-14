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
        $this->call(UsersTableSeeders::class);
        // $this->call(TagTableSeeder::class);
        // $this->call(UniversitiesTableSeeder::class);

    }
}
