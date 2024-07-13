<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\EditUserRequest;
use App\Http\Requests\Users\StoreUserRequest;
use App\Models\District;
use App\Models\User;
use App\Models\Ward;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Services\Interfaces\UserServiceInterface as UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $user;
    protected $userService;
    protected $provinceRepository;


    public function __construct(
        User $user,
        UserService $userService,
        ProvinceRepository $provinceRepository
    ) {
        $this->user = $user;
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
    }


    public function index(Request $request)
    {
        // $users = $this->userService->paginate();
        $users = $this->user->all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $provinces = $this->provinceRepository->All();
        return view('admin.users.create', compact('provinces'));
    }
    public function getDistricts($province_code)
    {
        $districts = District::where('province_code', $province_code)->get();
        return response()->json($districts);
    }

    public function getWards($district_code)
    {
        $wards = Ward::where('district_code', $district_code)->get();
        return response()->json($wards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if ($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'Thêm mới người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Thêm mới người dùng thất bại');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = $this->user->findOrFail($id);
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->user->findOrFail($id);
        $provinces = $this->provinceRepository->All();
        return view('admin.users.edit',compact('user','provinces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, string $id)
    {
        if ($this->userService->update($id,$request)) {
            return redirect()->route('user.index')->with('success', 'Cập nhật người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Cập nhật người dùng thất bại');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if ($this->userService->delete($id)) {
            return redirect()->route('user.index')->with('success', 'Xóa mềm người dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Xóa mềm người dùng thất bại');
    }

    public function indexSoftDelete(){
        $users = $this->user->onlyTrashed()->get();

        return view('admin.users.indexSoftDelete',compact('users'));
    }
    public function restore($id)
    {
        if ($this->userService->restore($id)) {
            return redirect()->route('user.index')->with('success', 'Khôi phục dùng thành công');
        }
        return redirect()->route('user.index')->with('error', 'Khôi phục dùng thất bại');
    }
    public function forceDelete($id)
    {
        if ($this->userService->forceDelete($id)) {
            return redirect()->route('user.indexSoftDelete')->with('success', 'Xóa người dùng thành công');
        }
        return redirect()->route('user.indexSoftDelete')->with('error', 'Xóa người dùng thất bại');
    }
}
