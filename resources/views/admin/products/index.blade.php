@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('product.index') }}">User</a></div>
                    <div class="breadcrumb-item">Product List</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Quản lý Product</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Basic DataTables</h4>
                                    <a class="btn btn-info" href="{{ route('product.create') }}">
                                        Add Product</a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">
                                                        #
                                                    </th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td>{{ $product->id }}</td>
                                                        <td>{{ $product->name }}</td>
                                                        <td>
                                                            @if ($product->is_visible == 1)
                                                                <div class="badge badge-success">Hoạt động</div>
                                                            @else
                                                                <div class="badge badge-danger">Không hoạt động</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            {{-- <a href="{{ route('product.show',$product->id) }}"
                                                                class="btn btn-secondary">Detail product</a> --}}
                                                            <a href="{{ route('product.edit', $product->id) }}"
                                                                class="btn btn-success">Edit</a>
                                                            <button
                                                                onclick="if(confirm('Bạn chắc chắn muốn xóa {{ $product->name }}')){
                                                                document.getElementById('product->{{ $product->id }}').submit();
                                                                }"
                                                                class="btn btn-danger">Delete</button>
                                                            <form action="{{ route('product.delete', $product) }}"
                                                                id="product->{{ $product->id }}" method="post">
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
                        This is card footer
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
