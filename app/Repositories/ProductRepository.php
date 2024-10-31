<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface as InterfacesProductRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Services
 */
class ProductRepository extends BaseRepository implements InterfacesProductRepositoryInterface
{

    protected $model;

    public function __construct(Product $model){
        $this->model = $model;
    }
    public function all(){
        return $this->model->all();
    }
}
