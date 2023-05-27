<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Course::factory()
            ->has(
                Module::factory()
                    ->has(
                        Lesson::factory()
                            ->count(2)
                    )
                    ->count(5)
            )
            ->count(20)
            ->create();
    }
}
