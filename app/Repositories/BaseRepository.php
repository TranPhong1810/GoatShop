<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface as Bases;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Services
 */
class BaseRepository implements Bases
{
    protected $model;

    public function __construct(Model $model){
        $this->model = $model;
    }
    public function all(){
        return $this->model->all();
    }
    public function create(array $payload = []){
        $model = $this->model->create($payload);
        return $model->fresh();
    }
    public function update(int $id = 0, array $payload = [])
    {
        $model = $this->model->findOrFail($id);
        return $model->update($payload);
    }
    public function delete(int $id = 0)
    {
        $model = $this->model->findOrFail($id);
        return $model->delete($id);
    }
    public function restore(int $id = 0){
        return $this->model->onlyTrashed()->findOrFail($id)->restore();
    }
    public function forceDelete(int $id = 0){
        return $this->model->onlyTrashed()->findOrFail($id)->forceDelete();
    }
}
