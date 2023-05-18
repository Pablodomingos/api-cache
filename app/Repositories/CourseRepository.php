<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\Base\BaseRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function __construct(
        private readonly Course $course
    )
    {
        parent::__construct($course);
    }
}
