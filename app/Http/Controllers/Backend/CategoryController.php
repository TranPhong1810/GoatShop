<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CreateCatagoryRequest;
use App\Http\Requests\Category\UpdateCatagoryRequest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    protected $subcategory;
    protected $categoryService;

    public function __construct(
        Category $category,
        Subcategory $subcategory,
        CategoryService $categoryService
    ) {
        $this->category = $category;
        $this->subcategory = $subcategory;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->category->all();
        $subcategories = $this->subcategory->all();
        return view('admin.categories.index', compact('categories', 'subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->all();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCatagoryRequest $request)
    {
        if ($this->categoryService->create($request)) {
            return redirect()->route('category.index')->with('success', 'Thêm mới danh mục thành công!');
        }
        return redirect()->route('category.index')->with('error', 'Thêm mới danh mục thất bại!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Tìm danh mục hoặc danh mục con theo ID
        $category = $this->category->with('subcategories')->find($id);
        $subcategory = $this->subcategory->with('category')->find($id);

        // Kiểm tra loại
        if ($category) {
            // Đây là danh mục cha
            return view('admin.categories.edit', [
                'category' => $category,
                'subcategory' => null, // không có danh mục con
                'categories' => $this->category->all(), // danh mục cha khác để chọn làm danh mục cha khi tạo danh mục con
            ]);
        } elseif ($subcategory) {
            // Đây là danh mục con
            return view('admin.categories.edit', [
                'category' => null, // không có danh mục cha
                'subcategory' => $subcategory,
                'categories' => $this->category->all(), // danh mục cha để chọn
            ]);
        }
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCatagoryRequest $request, string $id)
    {
        if ($this->categoryService->update($id, $request)) {
            return redirect()->route('category.index')->with('success', 'Sửa đổi danh mục thành công!');
        }
        return redirect()->route('category.index')->with('error', 'Sửa đổi danh mục thất bại!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($this->categoryService->delete($id)) {
            return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công');
        }
        return redirect()->route('category.index')->with('error', 'Xóa danh mục thất bại');
    }
}
