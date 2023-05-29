<?php

namespace App\Repositories\Interfaces;

interface CourseRepositoryInterface
{
    public function all();

    public function create(array $attributes);

    public function findByUuid(string $uuid, bool $relathionship = true);

    public function deleteByUuid(string $uuid);

    public function updateByUuid(array $data, string $uuid);
}
