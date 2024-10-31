<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    protected $coupon;
    protected $couponService;

    public function __construct(
        Coupon $coupon,
        CouponService $couponService
    ) {
        $this->coupon = $coupon;
        $this->couponService = $couponService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = $this->coupon->all();
        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($this->couponService->create($request)) {
            return redirect()->route('coupon.index')->with('success', 'Tạo mã giảm giá thành công');
        }
        return redirect()->route('coupon.index')->with('error', 'Tạo mã giảm giá thất bại');
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
        $coupon = $this->coupon->findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($this->couponService->update($id,$request)) {
            return redirect()->route('coupon.index')->with('success', 'Sửa mã giảm giá thành công');
        }
        return redirect()->route('coupon.index')->with('error', 'Sửa mã giảm giá thất bại');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->couponService->delete($id)) {
            return redirect()->route('coupon.index')->with('success', 'Xóa mã giảm giá thành công');
        }
        return redirect()->route('coupon.index')->with('error', 'Xóa mã giảm giá thất bại');
    }
}
