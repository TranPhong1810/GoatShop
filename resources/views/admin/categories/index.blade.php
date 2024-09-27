@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>USER</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('category.index') }}">User</a></div>
                    <div class="breadcrumb-item">User List</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Quản lý Danh Mục</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Bảng Danh mục</h4>
                                    <a class="btn btn-info" href="{{ route('category.create') }}">
                                        Thêm Danh mục</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>Tên</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($categories as $category)
                                                    <tr>
                                                        <td>{{ $category->id }}</td>
                                                        <td>{{ $category->name }}</td>
                                                        <td>
                                                            <a href="{{ route('category.edit', $category->id) }}"
                                                                class="btn btn-success">Edit</a>
                                                            <button
                                                                onclick="if(confirm('Bạn chắc chắn muốn xóa {{ $category->name }}')){
                                                                document.getElementById('category->{{ $category->id }}').submit();
                                                                }"
                                                                class="btn btn-danger">Delete</button>
                                                            <form action="{{ route('category.delete', $category) }}"
                                                                id="category->{{ $category->id }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Bảng Danh mục con</h4>
                                    <a class="btn btn-info" href="{{ route('category.create') }}">
                                        Thêm Danh mục con</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>Danh mục cha</th>
                                                    <th>Tên danh mục con</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($subcategories as $subcategory)
                                                    <tr>
                                                        <td>{{ $subcategory->id }}</td>
                                                        <td>{{ $subcategory->category->name }}</td>
                                                        <td>{{ $subcategory->name }}</td>
                                                        <td>
                                                            <a href="{{ route('category.edit', $subcategory->id) }}"
                                                                class="btn btn-success">Edit</a>
                                                            <button
                                                                onclick="if(confirm('Bạn chắc chắn muốn xóa {{ $subcategory->name }}')){
                                                                document.getElementById('category->{{ $subcategory->id }}').submit();
                                                                }"
                                                                class="btn btn-danger">Delete</button>
                                                            <form action="{{ route('category.delete', $subcategory) }}"
                                                                id="category->{{ $subcategory->id }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-whitesmoke">
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('table')
    <script src="{{ asset('backend/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('backend/assets/js/page/modules-datatables.js') }}"></script>
@endpush
