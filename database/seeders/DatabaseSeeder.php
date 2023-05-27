<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $local = [
            CourseSeeder::class
        ];

        $prod = [

        ];

        $this->call(
            app()->environment('local') ? $local : $prod
        );
    }
}
