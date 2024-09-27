<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Subcategory;
use App\Repositories\CategoryRepository;
use App\Services\Interfaces\CategoryServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService
 * @package App\Services
 */
class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    public function create($request)
    {
        DB::beginTransaction();
        try {
            $dataCreate = $request->except('_token');
            // dd($dataCreate);
            if (isset($dataCreate['category_id']) && !empty($dataCreate['category_id'])) {
                // Tạo danh mục con
                $subcategory = $this->categoryRepository->createSubcategory($dataCreate);
            } else {
                // Tạo danh mục cha
                $category = $this->categoryRepository->create($dataCreate);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e->getMessage());
            echo $e->getMessage();
            return false;
        }
    }

    public function update($id,$request)
    {
        DB::beginTransaction();
        try {
            $category = Category::find($id);
            $subcategory = Subcategory::find($id);
            if ($category) {
                $dataUpdate = $request->all();
                $category->update($dataUpdate);
            } elseif ($subcategory) {
                // Đây là danh mục con
                $dataUpdate = $request->all();
                $subcategory->update($dataUpdate);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            echo $e->getMessage(); // Xử lý lỗi
            return false;
        }
    }


    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

}
