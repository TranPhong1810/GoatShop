@extends('admin.layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>COUPON</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Coupon</a></div>
                    <div class="breadcrumb-item">Coupon List</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Quản lý Coupon</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Basic DataTables</h4>
                                    <a class="btn btn-info" href="{{ route('coupon.create') }}">Add Coupon</a>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Code</th>
                                                    <th>Discount Amount</th>
                                                    <th>Discount Type</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                    <th>Usage Limit</th>
                                                    <th>Used Count</th>
                                                    <th>Active</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($coupons as $coupon)
                                                    <tr>
                                                        <td>{{ $coupon->id }}</td>
                                                        <td>{{ $coupon->code }}</td>
                                                        <td>{{ $coupon->discount_amount }}</td>
                                                        <td>{{ $coupon->discount_type }}</td>
                                                        <td>{{ $coupon->start_date }}</td>
                                                        <td>{{ $coupon->end_date }}</td>
                                                        <td>{{ $coupon->usage_limit }}</td>
                                                        <td>{{ $coupon->used_count }}</td>
                                                        <td>
                                                            @if ($coupon->is_active == 1)
                                                                <div class="badge badge-success">Hoạt động</div>
                                                            @else
                                                                <div class="badge badge-danger">Không hoạt động</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('coupon.edit', $coupon->id) }}" class="btn btn-success">Edit</a>
                                                            <button onclick="if(confirm('Bạn chắc chắn muốn xóa mã giảm giá {{ $coupon->code }}?')){
                                                                document.getElementById('coupon-{{ $coupon->id }}').submit();
                                                            }" class="btn btn-danger">Delete</button>
                                                            <form action="{{ route('coupon.delete', $coupon) }}" id="coupon-{{ $coupon->id }}" method="post">
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
    <script src="{{ asset('backend/assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('backend/assets/js/page/modules-datatables.js') }}"></script>
@endpush
