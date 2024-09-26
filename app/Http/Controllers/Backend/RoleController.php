<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Services\RoleService;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $role;
    protected $roleService;
    protected $permission;

    public function __construct(
        Role $role,
        Permission $permission,
        RoleService $roleService
    )
    {
        $this->role = $role;
        $this->roleService = $roleService;
        $this->permission = $permission;
    }

    public function index(Request $request) {
        $roles = $this->role->all();
        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permission->all()->groupBy('group');
        // dd($permissions);
        return view('admin.roles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($this->roleService->create($request)){
            return redirect()->route('role.index')->with('success','Thêm mới vai trò thành công!');
        }
        return redirect()->route('role.index')->with('error','Thêm mới vai trò thất bại!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->role->with('permissions')->findOrFail($id);
        $permissions = $this->permission->all()->groupBy('group');
        // dd($permissions);
        return view('admin.roles.edit',compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($this->roleService->update($id, $request)){
            return redirect()->route('role.index')->with('success','Sửa vai trò thành công!');
        }
        return redirect()->route('role.index')->with('error','Sửa vai trò thất bại!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->roleService->delete($id)) {
            return redirect()->route('role.index')->with('success', 'Xóa vai trò thành công');
        }
        return redirect()->route('role.index')->with('error', 'Xóa vai trò thất bại');
    }
}
