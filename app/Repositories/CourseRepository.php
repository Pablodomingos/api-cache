<?php

namespace App\Repositories;

use App\Models\Course;
use App\Repositories\Interfaces\Base\BaseRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    public function __construct(
        private readonly Course $course
    )
    {
        parent::__construct($course);
    }

    public function all()
    {
        return Cache::remember('courses', now()->addSeconds(120), fn () =>
            $this->model
                ->with('modules.lessons')
                ->get()
        );
    }

    public function create(array $attributes): Model
    {
        if (Cache::has('courses')) {
            Cache::forget('courses');
        }

        $fillable = Arr::only($attributes, $this->model->getFillableColumns());
        return $this->model->newQuery()->create($fillable)->fresh();
    }

    public function findByUuid(string $uuid, bool $relathionship = true): Model
    {
        return $this->model
            ->newQuery()
            ->where('uuid', '=', $uuid)
            ->with([$relathionship ? 'modules.lessons' : ''])
            ->firstOrFail();
    }
}
