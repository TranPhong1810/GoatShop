<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;

class DashboardService
{
    protected $orders;
    protected $products;

    public function __construct(
        Order $orders,
        Product $products
        )
    {
        $this->orders = $orders;
    }

    public function orderQuantity($month = null, $year = null)
    {
        // Nếu tháng và năm không được truyền vào, sử dụng tháng và năm hiện tại
        $month = $month ?? Carbon::now()->month;
        $year = $year ?? Carbon::now()->year;

        $statuses = [
            'totalOrders' => null, // Đối với tổng số đơn hàng
            'pendingOrders' => 'pending',
            'successOrders' => 'processing',
            'shippingOrders' => 'shipped',
            'completedOrders' => 'delivered',
            'cancelOrders' => 'cancelled',
            'returnedOrders' => 'returned',
        ];

        $orderCounts = [];

        foreach ($statuses as $key => $status) {
            $query = $this->orders->whereMonth('order_date', $month)
                ->whereYear('order_date', $year);

            if ($status !== null) {
                $query->where('status', $status);
            }

            $orderCounts[$key] = $query->count();
        }

        return $orderCounts; // Trả về mảng kết quả
    }
}
