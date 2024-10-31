@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Danh mục</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('variant.index') }}">Danh mục</a></div>
                    <div class="breadcrumb-item">Thêm mới biến thể</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Thêm mới biến thể</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <span></span>
                                    <a class="btn btn-info" href="{{ route('variant.index') }}">Bảng biến thể</a>
                                </div>

                                {{-- Form thêm biến thể --}}
                                <form action="{{ route('variant.store') }}" method="POST" enctype="multipart/form-data"
                                    novalidate>
                                    @csrf
                                    <div class="card-body">
                                        <h4>Thêm Màu</h4>
                                        <div class="form-group">
                                            <label for="variant-name">Tên Màu<span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" id="name" required>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="variant-name">Mã Màu<span
                                                    class="text-danger">(*)</span></label>
                                            <input type="color" name="code" value="{{ old('code') }}"
                                                class="form-control" id="code" required>
                                            @error('code')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Thêm Màu</button>
                                    </div>
                                </form>

                                {{-- Form thêm danh mục con --}}
                                <form action="{{ route('variant.store') }}" method="POST" enctype="multipart/form-data"
                                    novalidate>
                                    @csrf
                                    <div class="card-body">
                                        <h4>Thêm kích cỡ</h4>
                                        <div class="form-group">
                                            <label for="subvariant-name">Tên kích cỡ<span
                                                    class="text-danger">(*)</span></label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" id="subvariant-name" required>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">Thêm kích cỡ</button>
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
