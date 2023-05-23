<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ModuleRepositoryInterface
{
    public function allByCourse(string $courseUuid): Collection;

    public function create(array $data): Model;

    public function findByUuid(string $uuid): ?Model;

    public function deleteByUuid(string $uuid): bool;

    public function updateByCourse(array $attributes, int $courseId, string $uuid): ?Model;
}
