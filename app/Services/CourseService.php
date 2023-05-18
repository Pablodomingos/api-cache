<?php

namespace App\Services;

use App\Repositories\Interfaces\CourseRepositoryInterface;

class CourseService
{
    public function __construct(
        private readonly CourseRepositoryInterface $courseRepository
    )
    {
    }
}
