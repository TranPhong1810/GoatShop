<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $order;

    public function __construct(
        Order $order
    ) {
        $this->order = $order;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = $this->order->All();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function updateStatus(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled,returned',
        ]);

        // Tìm đơn hàng theo ID
        $order = Order::find($request->order_id);

        // Xác định trạng thái hiện tại
        $currentStatus = $order->status;

        // Kiểm tra quy tắc chuyển đổi trạng thái
        if (!$this->canChangeStatus($currentStatus, $request->status)) {
            return response()->json(['success' => false, 'message' => 'Không thể thay đổi trạng thái đơn hàng.']);
        }

        // Cập nhật trạng thái
        $order->status = $request->status;
        $order->save();  // Lưu vào database

        return response()->json(['success' => true]);
    }


    private function canChangeStatus($currentStatus, $newStatus)
    {
        $validTransitions = [
            'pending' => ['processing','cancelled'],
            'processing' => ['shipped', 'cancelled'],
            'shipped' => ['delivered'],
            'delivered' => ['returned'],
            'cancelled' => [],
            'returned' => [],
        ];

        return in_array($newStatus, $validTransitions[$currentStatus]);
    }
}
