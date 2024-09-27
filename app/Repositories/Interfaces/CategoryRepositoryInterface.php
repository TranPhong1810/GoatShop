<?php

namespace App\Repositories\Interfaces;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface CategoryRepositoryInterface
{
    public function getCategoriesWithSubcategories();
    public function createSubcategory(array $data);
}
