@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Variant</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('role.index') }}">Role</a></div>
                    <div class="breadcrumb-item">Role List</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Variant</h2>
                <div class="row">
                    <!-- Colors Table -->
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Colors</h4>
                                <a class="btn btn-info" href="{{ route('variant.create') }}">Thêm Màu</a>
                            </div>
                            <div class="card-body" id="color-form" style="display: none;">
                                <form id="color-input-form">
                                    <div class="form-group">
                                        <label for="color-name">Tên màu</label>
                                        <input type="text" name="color_name" id="color-name" class="form-control"
                                            placeholder="Nhập tên màu">
                                    </div>
                                    <div class="form-group">
                                        <label for="color-code">Mã màu</label>
                                        <input type="color" name="color_code" id="color-code" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Lưu màu sắc</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Color Code</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($colors as $color)
                                            <tr>
                                                <td>{{ $color->id }}</td>
                                                <td>{{ $color->name }}</td>
                                                <td>
                                                    <input type="color" value="{{ $color->code }}" class="form-control"
                                                        disabled>
                                                </td>
                                                <td>
                                                    <button
                                                        onclick="if(confirm('Bạn chắc chắn muốn xóa màu {{ $color->name }}?'))
                                                        {document.getElementById('color-variant-{{ $color->id }}').submit();}"
                                                        class="btn btn-danger">Xóa</button>
                                                    <form action="{{ route('variant.delete.color', $color->id) }}"
                                                        id="color-variant-{{ $color->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sizes Table -->
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Sizes</h4>
                                <a class="btn btn-info" href="{{ route('variant.create') }}">Thêm kích thước</a>
                            </div>
                            <div class="card-body" id="size-form" style="display: none;">
                                <form id="size-input-form">
                                    <div class="form-group">
                                        <label for="size-name">Tên kích thước</label>
                                        <input type="text" name="size_name" id="size-name" class="form-control"
                                            placeholder="Nhập tên kích thước">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Lưu kích thước</button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-md">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($sizes as $size)
                                            <tr>
                                                <td>{{ $size->id }}</td>
                                                <td>{{ $size->name }}</td>
                                                <td>
                                                    <button
                                                        onclick="if(confirm('Bạn chắc chắn muốn xóa kích thước {{ $size->name }}?'))
                                                        {document.getElementById('size-variant-{{ $size->id }}').submit();}"
                                                        class="btn btn-danger">Xóa</button>
                                                    <form action="{{ route('variant.delete.size', $size->id) }}"
                                                        id="size-variant-{{ $size->id }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('table')
    <script src="{{ asset('backend/assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('backend/assets/js/page/modules-datatables.js') }}"></script>
@endpush
