<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Repositories\ProductRepository;
use App\Services\Interfaces\ProductServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

/**
 * Class UserService
 * @package App\Services
 */
class ProductService implements ProductServiceInterface
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    protected $path = 'uploads';

    private function verify($request)
    {
        return $request->hasFile('image');
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');
            $payload['is_visible'] = $request->has('is_visible') ? 1 : 0;

            if ($this->verify($request)) {
                $image = $request->file('image');
                $path = $image->store('images', 'public');
                $payload['image'] = $path;
            }

            $product = $this->productRepository->create($payload);

            $product->assignCategory($payload['category_ids']);
            $product->assignColor($payload['color_ids']);
            $product->assignSize($payload['size_ids']);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return false;
        }
    }


    public function update($id, $request)
    {
        DB::beginTransaction();
        try {
            $payload = $request->except('_token');
            $payload['is_visible'] = $request->has('is_visible') ? 1 : 0;
            $product = Product::find($id);

            // Kiểm tra và xóa hình ảnh cũ
            if ($request->hasFile('image')) {
                $oldImagePath = $product->image;

                if ($oldImagePath) {
                    Storage::disk('public')->delete($oldImagePath);
                }

                // Lưu hình ảnh mới vào storage và cập nhật đường dẫn mới trong cơ sở dữ liệu
                $image = $request->file('image');
                $path = $image->store('images', 'public');
                $payload['image'] = $path;
            }

            $product->update($payload);

            $product->assignCategory($payload['category_ids']);
            $product->assignColor($payload['color_ids']);
            $product->assignSize($payload['size_ids']);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); // Xử lý lỗi
            return false;
        }
    }


    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->delete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }

    public function restore($id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->restore($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
    public function forceDelete($id)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->forceDelete($id);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return false;
        }
    }
}
