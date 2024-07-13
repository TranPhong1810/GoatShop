<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $fillable =[
        'name'
    ];
    protected $primaryKey = 'province_code';
    public function district(){
        return $this->hasMany(District::class,'province_code','code');
    }
}
