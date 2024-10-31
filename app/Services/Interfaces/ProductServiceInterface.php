<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface ProductServiceInterface
{
    public function create($request);
    public function update($id, $request);
    public function delete($id);
    public function restore($id);
    public function forceDelete($id);
}
