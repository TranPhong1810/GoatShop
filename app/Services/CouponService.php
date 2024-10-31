<?php

namespace App\Services;

use App\Models\Coupon;
use App\Repositories\CouponRepository;
use App\Services\Interfaces\CouponServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService
 * @package App\Services
 */
class CouponService implements CouponServiceInterface
{
    protected $couponRepository;

    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }


    public function create($request)
    {

        DB::beginTransaction();
        try {
            $dataCreate = $request->all();
            $dataCreate['is_active'] = $request->has('is_active') ? 1 : 0;
            // dd($dataCreate);
            $coupon = $this->couponRepository->create($dataCreate);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $coupon = Coupon::findOrFail($id);
            $dataUpdate = $request->all();
            $dataUpdate['is_active'] = $request->has('is_active') ? 1 : 0;
            $coupon = $this->couponRepository->update($id,$dataUpdate);
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
            $coupon = $this->couponRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }
}
