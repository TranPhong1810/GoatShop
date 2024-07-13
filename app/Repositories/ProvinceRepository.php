<?php

namespace App\Repositories;

use App\Models\Province;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as Provinces;
use App\Repositories\BaseRepository;

/**
 * Class ProvincesRepository
 * @package App\Repositories
 */
class ProvinceRepository extends BaseRepository implements Provinces
{
    protected $model;
    public function __construct(Province $model){
        $this->model = $model;
    }
}
