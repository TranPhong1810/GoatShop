<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface RoleServiceInterface
{
    public function create($request);
    public function update($id, $request);
    public function delete($id);
    public function restore($id);
}
