<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_amount',
        'discount_type',
        'start_date',
        'end_date',
        'usage_limit',
        'used_count',
        'is_active',
    ];
    public function isValid()
    {
        $currentDate = now();
        return $this->is_active &&
               $this->start_date <= $currentDate &&
               $this->end_date >= $currentDate &&
               ($this->usage_limit === null || $this->used_count < $this->usage_limit);
    }
    public function incrementUsage()
    {
        $this->increment('used_count');
    }
}
