<?php

namespace App\Repositories\Interfaces\Base;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

abstract class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(
        protected readonly Model $model
    )
    {
    }

    public function all()
    {
        return $this->model->all();
    }

    public function create(array $attributes): Model
    {
        $fillable = Arr::only($attributes, $this->model->getFillableColumns());
        return $this->model->newQuery()->create($fillable)->fresh();
    }

    public function update(array $attributes, int $id): ?Model
    {
        $fillable = Arr::only($attributes, $this->model->getFillableColumns());
        $model = $this->model->newQuery()->findOrFail($id);
        $model->update($fillable);
        return $model->fresh();
    }

    public function delete(int $id): ?bool
    {
        $model = $this->model->newQuery()->findOrFail($id);
        return $model->delete();
    }

    public function find(int $id): ?Model
    {
        return $this->model->newQuery()->find($id);
    }

    public function findOrFail(int $id): Model
    {
        return $this->model->newQuery()->findOrFail($id);
    }

    public function findByUuid(string $uuid): Model
    {
        return $this->model->newQuery()->where('uuid', '=', $uuid)->firstOrFail();
    }

    public function deleteByUuid(string $uuid): bool
    {
        $model = $this->model->newQuery()->where('uuid', '=', $uuid)->firstOrFail();
        return $model->delete();
    }

    public function updateByUuid(array $attributes, string $uuid): Model
    {
        $fillable = Arr::only($attributes, $this->model->getFillableColumns());
        $model = $this->model->newQuery()->where('uuid', '=', $uuid)->firstOrFail();
        $model->update($fillable);
        return $model->fresh();
    }
}
