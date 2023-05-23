<?php

namespace App\Repositories;

use App\Models\Lesson;
use App\Repositories\Interfaces\Base\BaseRepository;
use App\Repositories\Interfaces\LessonRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class LessonRepository extends BaseRepository implements LessonRepositoryInterface
{
    public function __construct(
        private readonly Lesson $lesson
    )
    {
        parent::__construct($lesson);
    }

    public function allByModule(string $moduleUuid): Collection
    {
        return $this->model->newQuery()
            ->where('module_id', '=', $moduleUuid)
            ->get();
    }

    public function updateByCourse(array $attributes, int $moduleId, string $uuid): ?Model
    {
        $fillable = Arr::only($attributes, $this->model->getFillableColumns());
        $model = $this->model->newQuery()
            ->where('module_id', '=', $moduleId)
            ->where('uuid', '=', $uuid)
            ->firstOrFail();
        $model->update($fillable);
        return $model->fresh();
    }
}
