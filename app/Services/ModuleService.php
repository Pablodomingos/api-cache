<?php

namespace App\Services;

use App\Models\Module;
use App\Repositories\Interfaces\{
    ModuleRepositoryInterface,
    CourseRepositoryInterface
};
use Illuminate\Database\Eloquent\Collection;

class ModuleService
{
    public function __construct(
        private readonly ModuleRepositoryInterface  $moduleRepository,
        private readonly CourseRepositoryInterface  $courseRepository
    )
    {
    }

    public function listModulesByCourse(string $courseUuid): Collection
    {
        $course = $this->courseRepository->findByUuid($courseUuid, false);
        return $this->moduleRepository->allByCourse($course->id);
    }

    public function createModule(array $attributes): Module
    {
        $course = $this->courseRepository->findByUuid($attributes['course'], false);
        $attributes['course_id'] = $course->id;
        return $this->moduleRepository->create($attributes);
    }

    public function updateByCourse(array $attributes, string $uuid): ?Module
    {
        $course = $this->courseRepository->findByUuid($attributes['course'], false);
        return $this->moduleRepository->updateByCourse($attributes, $course->id, $uuid);
    }
}
