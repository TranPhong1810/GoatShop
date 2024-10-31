<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'image',
        'sale',
        'price',
        'quantity',
        'is_visible'
    ];
    public function variant()
    {
        return $this->hasMany(Variant::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'size_product');
    }
    public function assignCategory($categoryIds)
    {
        if (count($categoryIds) > 0) {
            return $this->categories()->sync($categoryIds);
        }
        return null;
    }
    public function assignColor($colorIds)
    {
        if (count($colorIds) > 0) {
            return $this->colors()->sync($colorIds);
        }
        return null;
    }
    public function assignSize($sizeIds)
    {
        if (count($sizeIds) > 0) {
            return $this->sizes()->sync($sizeIds);
        }
        return null;
    }
    public function sale()
    {
        if ($this->sale > 0 && $this->sale <= 100) {
            return $this->price * (1 - $this->sale / 100);
        }
        return $this->price;
    }
}
