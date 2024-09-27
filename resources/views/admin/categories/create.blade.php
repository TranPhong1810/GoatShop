@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Danh mục</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('category.index') }}">Danh mục</a></div>
                    <div class="breadcrumb-item">Thêm mới danh mục</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Thêm mới danh mục</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Thêm mới danh mục</h4>
                                    <a class="btn btn-info" href="{{ route('category.index') }}">Bảng Danh mục</a>
                                </div>

                                {{-- Form thêm danh mục --}}
                                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data"
                                    novalidate>
                                    @csrf
                                    <div class="card-body">
                                        <h4>Thêm danh mục</h4>
                                        <div class="form-group">
                                            <label for="category-name">Tên danh mục <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" id="category-name" required>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                                    </div>
                                </form>

                                {{-- Form thêm danh mục con --}}
                                <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data"
                                    novalidate>
                                    @csrf
                                    <div class="card-body">
                                        <h4>Thêm danh mục con</h4>
                                        <div class="form-group">
                                            <label for="parent-category">Danh mục cha <span
                                                    class="text-danger">(*)</span></label>
                                            <select class="form-control" name="category_id" id="parent-category" required>
                                                <option value="">Chọn danh mục cha</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="subcategory-name">Tên danh mục con <span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" id="subcategory-name" required>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Thêm danh mục con</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke"></div>
            </div>
        </section>
    </div>
@endsection
