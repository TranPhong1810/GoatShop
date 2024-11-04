<?php

namespace Database\Seeders; // Thêm dòng này

use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray(); // Lấy các user_id hiện có

        for ($i = 1; $i <= 3000; $i++) {
            $orderCode = 'ORD' . strtoupper(uniqid());

            Order::create([
                'user_id' => $userIds[array_rand($userIds)], // Chọn user_id ngẫu nhiên từ các user_id hợp lệ
                'order_code' => $orderCode, // Đảm bảo mỗi order_code là duy nhất
                'total_amount' => rand(100, 1000),
                'status' => ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'][array_rand(['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'returned'])],
                'order_date' => Carbon::now()->subDays(rand(0, 365)),
                'payment_method' => ['cash', 'credit', 'paypal'][array_rand(['cash', 'credit', 'paypal'])],
                'shipping_address' => '123 Main St, City ' . $i,
                'recipient_name' => 'Recipient ' . $i,
                'phone_number' => '0123456789' . $i,
                'email' => 'recipient' . $i . '@example.com',
                'notes' => 'Order note for order ' . $i
            ]);
        }
    }
}
