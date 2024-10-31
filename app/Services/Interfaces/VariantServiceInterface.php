<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface VariantServiceInterface
{
    public function create($request);
    public function update($id, $request);
    public function deleteColor($id);
    public function deleteSize($id);

}
