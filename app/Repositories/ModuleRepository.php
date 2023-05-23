<?php

namespace App\Repositories;

use App\Models\Module;
use App\Repositories\Interfaces\Base\BaseRepository;
use App\Repositories\Interfaces\ModuleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class ModuleRepository extends BaseRepository implements ModuleRepositoryInterface
{
    public function __construct(
        private readonly Module $module
    )
    {
        parent::__construct($module);
    }

    public function allByCourse(string $courseUuid): Collection
    {
        return $this->model->newQuery()
            ->where('course_id', '=', $courseUuid)
            ->get();
    }

    public function updateByCourse(array $attributes, int $courseId, string $uuid): ?Model
    {
        $fillable = Arr::only($attributes, $this->model->getFillableColumns());
        $model = $this->model->newQuery()
            ->where('course_id', '=', $courseId)
            ->where('uuid', '=', $uuid)
            ->firstOrFail();
        $model->update($fillable);
        return $model->fresh();
    }
}
