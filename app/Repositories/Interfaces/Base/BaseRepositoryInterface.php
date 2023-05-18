<?php

namespace App\Repositories\Interfaces\Base;

interface BaseRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);

    public function find(int $id);

    public function findOrFail(int $id);
}
