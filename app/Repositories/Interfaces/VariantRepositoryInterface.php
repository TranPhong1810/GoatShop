<?php

namespace App\Repositories\Interfaces;

/**
 * Interface VariantRepositoryInterface
 * @package App\Repositories\Interfaces
 */
interface VariantRepositoryInterface
{
    public function createSize(array $data);

    public function createColor(array $data);

    public function allColors();

    public function allSizes();

    public function deleteVariant($id, $type);
}
