<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $productService;
    protected $category;
    protected $color;
    protected $size;

    public function __construct(
        Product $product,
        ProductService $productService,
        Category $category,
        Color $color,
        Size $size
    ) {
        $this->product = $product;
        $this->productService = $productService;
        $this->category = $category;
        $this->color = $color;
        $this->size = $size;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->product->all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->all();
        $colors = $this->color->all();
        $sizes = $this->size->all();
        return view('admin.products.create',compact('categories','colors','sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($this->productService->create($request)) {
            return redirect()->route('product.index')->with('success', 'Thêm sản phẩm thành công');
        }
        return redirect()->route('product.index')->with('error', 'Thêm sản phẩm thất bại');
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
    public function edit(string $id)
    {
        $product = $this->product->findOrFail($id);
        $categories = $this->category->all();
        $colors = $this->color->all();
        $sizes = $this->size->all();
        return view('admin.products.edit',compact('product','categories','colors','sizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($this->productService->update($id,$request)) {
            return redirect()->route('product.index')->with('success', 'Sửa sản phẩm thành công');
        }
        return redirect()->route('product.index')->with('error', 'Sửa sản phẩm thất bại');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if ($this->productService->delete($id)) {
            return redirect()->route('product.index')->with('success', 'Xóa mềm sản phẩm thành công');
        }
        return redirect()->route('product.index')->with('error', 'Xóa mềm sản phẩm thất bại');
    }

    public function indexSoftDelete(){
        $products = $this->product->onlyTrashed()->get();

        return view('admin.products.indexSoftDelete',compact('products'));
    }
    public function restore($id)
    {
        if ($this->productService->restore($id)) {
            return redirect()->route('product.index')->with('success', 'Khôi phục sản phẩm thành công');
        }
        return redirect()->route('product.index')->with('error', 'Khôi phục sản phẩm thất bại');
    }
    public function forceDelete($id)
    {
        if ($this->productService->forceDelete($id)) {
            return redirect()->route('product.indexSoftDelete')->with('success', 'Xóa sản phẩm thành công');
        }
        return redirect()->route('product.indexSoftDelete')->with('error', 'Xóa sản phẩm thất bại');
    }
}
