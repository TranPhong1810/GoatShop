<?php

namespace App\Repositories;

use App\Models\Role;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Services
 */
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{

    protected $model;

    public function __construct(Role $model){
        $this->model = $model;
    }
}
