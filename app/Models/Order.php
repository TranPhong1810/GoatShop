<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'order_code',
        'total_amount',
        'status',
        'order_date',
        'payment_method',
        'shipping_address',
        'notes',
    ];

    // Định nghĩa mối quan hệ với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
