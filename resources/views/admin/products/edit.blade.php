@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>USER</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></div>
                    <div class="breadcrumb-item">Edit User</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Edit Product</h2>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>Cập nhật sản phẩm</h4>
                        <a class="btn btn-info" href="{{ route('product.index') }}">Danh Sách Sản Phẩm</a>
                    </div>
                    <form action="{{ route('product.update', $product) }}" method="POST" enctype="multipart/form-data"
                        novalidate>
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <h4>Thông tin sản phẩm</h4>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="name">Tên sản phẩm<span class="text-danger">(*)</span></label>
                                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                        class="form-control" id="name" required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="quantity">Số lượng</label>
                                    <input type="text" class="form-control"
                                        value="{{ old('quantity', $product->quantity) }}" name="quantity" id="quantity">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="price">Giá</label>
                                    <input type="text" class="form-control" value="{{ old('price', $product->price) }}"
                                        name="price" id="price">
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="sale">Giảm giá<span class="text-danger">(*)</span></label>
                                    <input type="text" name="sale" value="{{ old('sale', $product->sale) }}"
                                        class="form-control" id="sale" required>
                                    @error('sale')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <div class="form-group">
                                        <label class="form-label">Size</label>
                                        <div class="selectgroup selectgroup-pills">
                                            @foreach ($sizes as $size)
                                                <label class="selectgroup-item">
                                                    <input type="checkbox" name="size_ids[]" value="{{ $size->id }}"
                                                        class="selectgroup-input"
                                                        {{ in_array($size->id, $product->sizes->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                    <span class="selectgroup-button">{{ $size->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label class="form-label">Color</label>
                                    <div class="selectgroup selectgroup-pills">
                                        @foreach ($colors as $color)
                                            <label class="selectgroup-item">
                                                <input type="checkbox" name="color_ids[]" value="{{ $color->id }}"
                                                    class="selectgroup-input"
                                                    {{ in_array($color->id, $product->colors->pluck('id')->toArray()) ? 'checked' : '' }}>
                                                <span class="selectgroup-button">{{ $color->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="description">Mô tả</label>
                                    <textarea name="description" id="editor" class="form-control" rows="5">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="size">Danh mục</label>
                                    <select name="category_ids[]" id="" class="form-control form-control-lg">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->categories->contains($category->id) ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 form-group">
                                    <label for="image">Hình ảnh</label>
                                    <input type="file" class="form-control" accept="image/*" name="image"
                                        id="image">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('backend/assets/img/avatar/avatar-1.png') }}"
                                        class="img-thumbnail" id="show-image" width="200px" alt="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <div class="control-label">Hiển thị</div>
                                    <label class="custom-switch mt-2">
                                        <input type="checkbox" name="is_visible" class="custom-switch-input"
                                            {{ $product->is_visible ? 'checked' : '' }}>
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.2.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.2.0/"
        }
    }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font
        } from 'ckeditor5';
        ClassicEditor
            .create(document.querySelector('#editor'), {
                plugins: [Essentials, Paragraph, Bold, Italic, Font],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <!-- A friendly reminder to run on a server, remove this during the integration. -->
    <script>
        window.onload = function() {
            if (window.location.protocol === 'file:') {
                alert('This sample requires an HTTP server. Please serve this file with a web server.');
            }
        };
    </script>
    <script>
        $(document).ready(function() {
            $("#image").change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#show-image').attr('src', e.target.result);
                };
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
