<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface as InterfacesUserRepositoryInterface;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Services
 */
class UserRepository extends BaseRepository implements InterfacesUserRepositoryInterface
{

    protected $model;

    public function __construct(User $model){
        $this->model = $model;
    }
    public function all(){
        return $this->model->all();
    }
    public function getAllPaginate()
    {
        return User::paginate(100);
    }
}
