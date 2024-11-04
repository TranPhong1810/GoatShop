<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\DashboardService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $users;
    protected $products;
    protected $orders;
    protected $categories;
    protected $dashboardService;

    public function __construct(
        User $users,
        Product $products,
        Order $orders,
        Category $categories,
        DashboardService $dashboardService
    ) {
        $this->users = $users;
        $this->products = $products;
        $this->orders = $orders;
        $this->categories = $categories;
        $this->dashboardService = $dashboardService;
    }
    public function index(Request $request)
    {
        $user = Auth::user();
        $users = $this->users->all();
        $products = $this->products->all();
        $orders = $this->orders->all();
        $categories = $this->categories->all();
        $orderInvoices = $this->orders->where('order_date', '>=', Carbon::now()->subDays(1))->get();
        // Tính tổng doanh thu

        // $month = $request->input('month', date('m')); // Định dạng tháng từ 01 đến 12
        $month = $request->input('month');
        if ($month === 'null' || !is_numeric($month) || $month < 1 || $month > 12) {
            $month = 1; // Gán giá trị mặc định
        }
        $year = date('Y'); // Lấy năm hiện tại

        $orderStats = $this->dashboardService->orderQuantity($month, $year);
        $totalOrders = $orderStats['totalOrders'];
        $pendingOrders = $orderStats['pendingOrders'];
        $successOrders = $orderStats['successOrders'];
        $shippingOrders = $orderStats['shippingOrders'];
        $completedOrders = $orderStats['completedOrders'];
        $cancelOrders = $orderStats['cancelOrders'];
        $returnedOrders = $orderStats['returnedOrders'];

        // Tổng doanh thu theo tháng
        $totalSales = $this->orders
            ->where('status', 'delivered') // Hoặc trạng thái mà bạn định nghĩa là "hoàn thành"
            ->whereMonth('order_date', $month)
            ->whereYear('order_date', $year)
            ->sum('total_amount');
        $totalSalesAmountFormatted = number_format($totalSales, 0, ',', ',') . '$';
        // Lấy dữ liệu bán hàng trong tháng hiện tại
        $dailySales = $this->orders
            ->selectRaw('DAY(order_date) as day, SUM(total_amount) as total_sales') // Tổng doanh thu hàng ngày
            ->whereMonth('order_date', $month)
            ->whereYear('order_date', $year)
            ->groupBy('day')
            ->orderBy('day')
            ->get();
        // Chuyển đổi dữ liệu thành định dạng mảng cho việc hiển thị
        $salesData = [];
        foreach ($dailySales as $sale) {
            $salesData[$sale->day] = $sale->total_sales;
        }

        // Đảm bảo rằng mỗi ngày trong tháng đều có dữ liệu, nếu không có thì gán 0
        for ($day = 1; $day <= 31; $day++) {
            if (!isset($salesData[$day])) {
                $salesData[$day] = 0; // Gán 0 nếu không có doanh thu
            }
        }
        // Chuyển đổi mảng về định dạng mong muốn (nếu cần)
        $salesData = array_values($salesData); // Chỉ lấy giá trị

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Tạo mảng chứa các ngày trong tháng hiện tại
        $daysInMonth = [];
        $daysCount = Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth;

        for ($day = 1; $day <= $daysCount; $day++) {
            $daysInMonth[] = sprintf('%02d-%02d-%d', $day, $currentMonth, $currentYear);
        }

        return view('admin.dashboard.index', compact(
            'user',
            'users',
            'products',
            'orders',
            'categories',
            'orderInvoices',
            'totalOrders',
            'pendingOrders',
            'successOrders',
            'shippingOrders',
            'month',
            'completedOrders',
            'cancelOrders',
            'returnedOrders',
            'totalSalesAmountFormatted',
            'salesData',
            'daysInMonth'
        ));
    }
    public function indexNav() {
        $userNav = Auth::user();
        return view('admin.layout.navbar',compact('userNav'));
    }

}
