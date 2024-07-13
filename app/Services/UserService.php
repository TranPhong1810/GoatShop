<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Interfaces\UserServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function paginate()
    {
        $users = $this->userRepository->getAllPaginate();
        return $users;
    }

    private function convertBirthdayDate($birthday = '')
    {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $birthday);
        $birthday = $carbonDate->format('Y-m-d H:i:s');
        return $birthday;
    }
    protected $path = 'uploads';

    private function verify($request)
    {
        return $request->hasFile('image');
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token', 're_password');
            $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
            $payload['password'] = Hash::make($payload['password']);

            if ($this->verify($request)) {
                $image = $request->file('image');
                $path = $image->store('images', 'public');
                $payload['image'] = $path; // Lưu đường dẫn hình ảnh trong cơ sở dữ liệu
            }

            $user = $this->userRepository->create($payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');
            $payload['birthday'] = $this->convertBirthdayDate($payload['birthday']);
            $payload['status'] = $request->has('status') ? 1 : 0;

            // Tìm người dùng theo ID
            $user = User::find($id);

            if (!$user) {
                throw new \Exception('User not found');
            }

            // Kiểm tra và xóa hình ảnh cũ
            if ($request->hasFile('image')) {
                $oldImagePath = $user->image;

                if ($oldImagePath) {
                    Storage::disk('public')->delete($oldImagePath);
                }

                // Lưu hình ảnh mới vào storage và cập nhật đường dẫn mới trong cơ sở dữ liệu
                $image = $request->file('image');
                $path = $image->store('images', 'public');
                $payload['image'] = $path;
            }

            // Cập nhật thông tin người dùng
            $user->update($payload);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); // Xử lý lỗi
            return false;
        }
    }


    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->delete($id);
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
            $user = $this->userRepository->restore($id);
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
            $user = $this->userRepository->forceDelete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
}
