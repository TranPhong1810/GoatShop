<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use App\Services\VariantService;
use Illuminate\Http\Request;

class VariantController extends Controller
{

    protected $variantService;
    protected $colors;
    protected $sizes;

    public function __construct(
        VariantService $variantService,
        Color $color,
        Size $size
    ) {
        $this->variantService = $variantService;
        $this->colors = $color;
        $this->sizes = $size;
    }

    /**
     * Display a listing of colors.
     */
    public function index()
    {
        $colors = $this->colors->all();
        $sizes = $this->sizes->all();
        return view('admin.variants.index', compact('colors','sizes'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.variants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($this->variantService->create($request)){
            return redirect()->route('variant.index')->with('success','Thêm biến thể thành công');
        }
        return redirect()->route('variant.index')->with('success', 'Thêm biến thể thất bại');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteColor(string $id)
    {
        if($this->variantService->deleteColor($id, 'color')){
            return redirect()->route('variant.index')->with('success', 'Xóa Màu sắc thành công');
        }
        return redirect()->route('variant.index')->with('error', 'Xóa Màu sắc thất bại');
    }

    public function deleteSize(string $id)
    {
        if($this->variantService->deleteSize($id, 'size')){
            return redirect()->route('variant.index')->with('success', 'Xóa kích cỡ thành công');
        }
        return redirect()->route('variant.index')->with('error', 'Xóa kích cỡ thất bại');
    }
}
