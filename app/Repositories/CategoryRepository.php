<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Subcategory;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserService
 * @package App\Services
 */
class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    protected $model;

    public function __construct(Category $model){
        $this->model = $model;
    }
    public function createSubcategory(array $data)
    {
        return Subcategory::create($data); // Sử dụng model Subcategory để tạo danh mục con
    }
    public function getCategoriesWithSubcategories()
    {
        return $this->model::with('subcategories')->whereNull('category_id')->get();
    }
}
