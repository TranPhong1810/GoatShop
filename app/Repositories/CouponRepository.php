<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Repositories\Interfaces\CouponRepositoryInterface as InterfacesCouponRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Services
 */
class CouponRepository extends BaseRepository implements InterfacesCouponRepositoryInterface
{

    protected $model;

    public function __construct(Coupon $model){
        $this->model = $model;
    }
    public function all(){
        return $this->model->all();
    }
}
