<?php

namespace App\Services;

use App\Models\Lesson;
use App\Repositories\Interfaces\{
    ModuleRepositoryInterface,
    LessonRepositoryInterface
};
use Illuminate\Database\Eloquent\Collection;

class LessonService
{
    public function __construct(
        private readonly LessonRepositoryInterface  $lessonRepository,
        private readonly ModuleRepositoryInterface  $moduleRepository
    )
    {
    }

    public function listLessonByModule(string $moduleUuid): Collection
    {
        $module = $this->moduleRepository->findByUuid($moduleUuid);
        return $this->lessonRepository->allByModule($module->id);
    }

    public function createLesson(array $attributes): Lesson
    {
        $module = $this->moduleRepository->findByUuid($attributes['module']);
        $attributes['module_id'] = $module->id;
        return $this->lessonRepository->create($attributes);
    }

    public function updateByModule(array $attributes, string $uuid): ?Lesson
    {
        $module = $this->moduleRepository->findByUuid($attributes['module']);
        return $this->lessonRepository->updateByCourse($attributes, $module->id, $uuid);
    }
}
