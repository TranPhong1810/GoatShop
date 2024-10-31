@extends('admin.layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Orders</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('order.index') }}">Orders</a></div>
                    <div class="breadcrumb-item">Order List</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Quản lý Order</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Order List</h4>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th>Order Code</th>
                                                    <th>Total Amount</th>
                                                    <th>Status</th>
                                                    <th>Order Date</th>
                                                    <th>Payment Method</th>
                                                    <th>Shipping Address</th>
                                                    <th>Notes</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $order->id }}</td>
                                                        <td>{{ $order->order_code }}</td>
                                                        <td>{{ number_format($order->total_amount, 2) }}</td>
                                                        <td>
                                                            <select class="form-control order-status" data-order-id="{{ $order->id }}" name="status">
                                                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                                <option value="returned" {{ $order->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                                            </select>
                                                        </td>
                                                        <td>{{ $order->order_date }}</td>
                                                        <td>{{ ucfirst($order->payment_method) }}</td>
                                                        <td>{{ $order->shipping_address }}</td>
                                                        <td>{{ $order->notes }}</td>

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

@push('scripts')
    <script>
        $(document).on('change', '.order-status', function() {
            const orderId = $(this).data('order-id');
            const newStatus = $(this).val();

            $.ajax({
                url: '{{ route('order.updateStatus') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    order_id: orderId,
                    status: newStatus,
                },
                success: function(response) {
                    if (response.success) {
                        alert('Cập nhật trạng thái thành công');
                    } else {
                        alert(response.message || 'Cập nhật trạng thái thất bại');
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi cập nhật trạng thái');
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const orderStatusSelects = document.querySelectorAll('.order-status');

            orderStatusSelects.forEach(select => {
                const currentStatus = select.value;

                // Các quy tắc chuyển đổi
                const validTransitions = {
                    'pending': ['processing'],
                    'processing': ['shipped', 'cancelled'],
                    'shipped': ['delivered'],
                    'delivered': ['returned'],
                    'cancelled': [],
                    'returned': [],
                };

                // Lấy các trạng thái hợp lệ từ trạng thái hiện tại
                const validStates = validTransitions[currentStatus];

                // Duyệt qua tất cả các tùy chọn và vô hiệu hóa các tùy chọn không hợp lệ
                for (let option of select.options) {
                    if (!validStates.includes(option.value)) {
                        option.disabled = true;
                    } else {
                        option.disabled = false; // Bật lại các tùy chọn hợp lệ
                    }
                }
            });
        });
    </script>
@endpush
