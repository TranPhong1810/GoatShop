@extends('admin.layout.app')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Danh mục</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('category.index') }}">Danh mục</a></div>
                <div class="breadcrumb-item">Chỉnh sửa danh mục</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Chỉnh sửa danh mục</h2>
            <div class="card">
                <div class="card-header">
                    <h4>Chỉnh sửa danh mục</h4>
                </div>
                <div class="card-body">
                    {{-- Form chỉnh sửa danh mục --}}
                    @if($category)
                        <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="category-name">Tên danh mục <span class="text-danger">(*)</span></label>
                                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="form-control" id="category-name" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
                        </form>
                    @endif

                    {{-- Form chỉnh sửa danh mục con --}}
                    @if($subcategory)
                        <form action="{{ route('category.update', $subcategory->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="parent-category">Danh mục cha <span class="text-danger">(*)</span></label>
                                <select class="form-control" name="category_id" id="parent-category" required>
                                    <option value="">Chọn danh mục cha</option>
                                    @foreach ($categories as $parentCategory)
                                        <option value="{{ $parentCategory->id }}" {{ $parentCategory->id == $subcategory->category_id ? 'selected' : '' }}>{{ $parentCategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="subcategory-name">Tên danh mục con <span class="text-danger">(*)</span></label>
                                <input type="text" name="name" value="{{ old('name', $subcategory->name) }}" class="form-control" id="subcategory-name" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật danh mục con</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
