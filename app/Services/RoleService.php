<?php

namespace App\Services;

use App\Models\Role;
use App\Repositories\RoleRepository;
use App\Services\Interfaces\RoleServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService
 * @package App\Services
 */
class RoleService implements RoleServiceInterface
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }


    public function create($request)
    {
        DB::beginTransaction();
        try {
            $dataCreate = $request->except('_token');
            $dataCreate['guard_name'] = 'web';
            $dataCreate['group'] = 'system';
            // dd($dataCreate);
            $role = $this->roleRepository->create($dataCreate);
            $role->permissions()->attach($dataCreate['permission_ids']);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $role = Role::findOrFail($id);
            $dataUpdate = $request->all();
            $role->update($dataUpdate);
            $role->permissions()->sync($dataUpdate['permission_ids']);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            echo $e->getMessage(); // Xử lý lỗi
            return false;
        }
    }


    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function restore($id)
    {
        DB::beginTransaction();
        try {

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function forceDelete($id)
    {
        DB::beginTransaction();
        try {

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
}
