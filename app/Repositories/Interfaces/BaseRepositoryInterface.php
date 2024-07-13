<?php

namespace App\Repositories\Interfaces;

/**
 * Interface BaseRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface BaseRepositoryInterface
{
    public function All();
    public function create(array $payload);
    public function update(int $id = 0, array $payload = []);
    public function delete(int $id = 0);
    public function restore(int $id = 0);
    public function forceDelete(int $id = 0);
}
