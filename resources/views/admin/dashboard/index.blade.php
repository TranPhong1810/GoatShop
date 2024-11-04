@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-stats">
                            <div class="card-stats-title">Order Statistics -
                                <div class="dropdown d-inline">
                                    <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#"
                                        id="orders-month">
                                        {{ isset($month) ? date('F', mktime(0, 0, 0, intval($month), 1)) : 'Chọn tháng' }}
                                        <!-- Hiển thị tháng đã chọn -->
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-sm" id="month-dropdown">
                                        <li class="dropdown-title">Select Month</li>
                                        @foreach (range(1, 12) as $monthOption)
                                            <li>
                                                <a href="#" id="di" class="dropdown-item"
                                                    data-month="{{ str_pad($monthOption, 2, '0', STR_PAD_LEFT) }}">
                                                    {{ date('F', mktime(0, 0, 0, $monthOption, 1)) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <input type="hidden" id="month-input" value="">
                                </div>
                            </div>
                            <div class="card-stats-items">
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $pendingOrders }}</div>
                                    <div class="card-stats-item-label">Pending</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $successOrders }}</div>
                                    <div class="card-stats-item-label">Success</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $shippingOrders }}</div>
                                    <div class="card-stats-item-label">Shipping</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $completedOrders }}</div>
                                    <div class="card-stats-item-label">Completed</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $cancelOrders }}</div>
                                    <div class="card-stats-item-label">Cancel</div>
                                </div>
                                <div class="card-stats-item">
                                    <div class="card-stats-item-count">{{ $returnedOrders }}</div>
                                    <div class="card-stats-item-label">Returned</div>
                                </div>
                            </div>
                        </div>

                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-archive"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Orders</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalOrders }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="card card-statistic-2">
                        <div class="card-chart">
                            <canvas id="sales-chart" height="80"></canvas>
                        </div>
                        <div class="card-icon shadow-primary bg-primary">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Sales</h4>
                            </div>
                            <div class="card-body">
                                {{ $totalSalesAmountFormatted }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Budget vs Sales</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="158"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card gradient-bottom">
                        <div class="card-header">
                            <h4>Top 5 Products</h4>
                            <div class="card-header-action dropdown">
                                <a href="#" data-toggle="dropdown" class="btn btn-danger dropdown-toggle">Month</a>
                                <ul class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                    <li class="dropdown-title">Select Period</li>
                                    <li><a href="#" class="dropdown-item">Today</a></li>
                                    <li><a href="#" class="dropdown-item">Week</a></li>
                                    <li><a href="#" class="dropdown-item active">Month</a></li>
                                    <li><a href="#" class="dropdown-item">This Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body" id="top-5-scroll">
                            <ul class="list-unstyled list-unstyled-border">
                                <li class="media">
                                    <img class="mr-3 rounded" width="55"
                                        src="{{ asset('backend/assets/img/products/product-3-50.png') }}" alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">86 Sales</div>
                                        </div>
                                        <div class="media-title">oPhone S9 Limited</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary" data-width="64%"></div>
                                                <div class="budget-price-label">$68,714</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger" data-width="43%"></div>
                                                <div class="budget-price-label">$38,700</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded" width="55"
                                        src="{{ asset('backend/assets/img/products/product-4-50.png') }}" alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">67 Sales</div>
                                        </div>
                                        <div class="media-title">iBook Pro 2018</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary" data-width="84%"></div>
                                                <div class="budget-price-label">$107,133</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger" data-width="60%"></div>
                                                <div class="budget-price-label">$91,455</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded" width="55"
                                        src="{{ asset('backend/assets/img/products/product-1-50.png') }}" alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">63 Sales</div>
                                        </div>
                                        <div class="media-title">Headphone Blitz</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary" data-width="34%"></div>
                                                <div class="budget-price-label">$3,717</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger" data-width="28%"></div>
                                                <div class="budget-price-label">$2,835</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded" width="55"
                                        src="{{ asset('backend/assets/img/products/product-3-50.png') }}" alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">28 Sales</div>
                                        </div>
                                        <div class="media-title">oPhone X Lite</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary" data-width="45%"></div>
                                                <div class="budget-price-label">$13,972</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger" data-width="30%"></div>
                                                <div class="budget-price-label">$9,660</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="media">
                                    <img class="mr-3 rounded" width="55"
                                        src="{{ asset('backend/assets/img/products/product-5-50.png') }}" alt="product">
                                    <div class="media-body">
                                        <div class="float-right">
                                            <div class="font-weight-600 text-muted text-small">19 Sales</div>
                                        </div>
                                        <div class="media-title">Old Camera</div>
                                        <div class="mt-1">
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-primary" data-width="35%"></div>
                                                <div class="budget-price-label">$7,391</div>
                                            </div>
                                            <div class="budget-price">
                                                <div class="budget-price-square bg-danger" data-width="28%"></div>
                                                <div class="budget-price-label">$5,472</div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="card-footer pt-3 d-flex justify-content-center">
                            <div class="budget-price justify-content-center">
                                <div class="budget-price-square bg-primary" data-width="20"></div>
                                <div class="budget-price-label">Selling Price</div>
                            </div>
                            <div class="budget-price justify-content-center">
                                <div class="budget-price-square bg-danger" data-width="20"></div>
                                <div class="budget-price-label">Budget Price</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Best Products</h4>
                        </div>
                        <div class="card-body">
                            <div class="owl-carousel owl-theme" id="products-carousel">
                                <div>
                                    <div class="product-item pb-3">
                                        <div class="product-image">
                                            <img alt="image"
                                                src="{{ asset('backend/assets/img/products/product-4-50.png') }}"
                                                class="img-fluid">
                                        </div>
                                        <div class="product-details">
                                            <div class="product-name">iBook Pro 2018</div>
                                            <div class="product-review">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <div class="text-muted text-small">67 Sales</div>
                                            <div class="product-cta">
                                                <a href="#" class="btn btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="product-item">
                                        <div class="product-image">
                                            <img alt="image"
                                                src="{{ asset('backend/assets/img/products/product-3-50.png') }}"
                                                class="img-fluid">
                                        </div>
                                        <div class="product-details">
                                            <div class="product-name">oPhone S9 Limited</div>
                                            <div class="product-review">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half"></i>
                                            </div>
                                            <div class="text-muted text-small">86 Sales</div>
                                            <div class="product-cta">
                                                <a href="#" class="btn btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="product-item">
                                        <div class="product-image">
                                            <img alt="image"
                                                src="{{ asset('backend/assets/img/products/product-1-50.png') }}"
                                                class="img-fluid">
                                        </div>
                                        <div class="product-details">
                                            <div class="product-name">Headphone Blitz</div>
                                            <div class="product-review">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <div class="text-muted text-small">63 Sales</div>
                                            <div class="product-cta">
                                                <a href="#" class="btn btn-primary">Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Top Countries</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="text-title mb-2">July</div>
                                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                        <li class="media">
                                            <img class="img-fluid mt-1 img-shadow"
                                                src="{{ asset('backend/assets/modules/flag-icon-css/flags/4x3/id.svg') }}"
                                                alt="image" width="40">
                                            <div class="media-body ml-3">
                                                <div class="media-title">Indonesia</div>
                                                <div class="text-small text-muted">3,282 <i
                                                        class="fas fa-caret-down text-danger"></i></div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img class="img-fluid mt-1 img-shadow"
                                                src="{{ asset('backend/assets/modules/flag-icon-css/flags/4x3/my.svg') }}"
                                                alt="image" width="40">
                                            <div class="media-body ml-3">
                                                <div class="media-title">Malaysia</div>
                                                <div class="text-small text-muted">2,976 <i
                                                        class="fas fa-caret-down text-danger"></i></div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img class="img-fluid mt-1 img-shadow"
                                                src="{{ asset('backend/assets/modules/flag-icon-css/flags/4x3/us.svg') }}"
                                                alt="image" width="40">
                                            <div class="media-body ml-3">
                                                <div class="media-title">United States</div>
                                                <div class="text-small text-muted">1,576 <i
                                                        class="fas fa-caret-up text-success"></i></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-sm-6 mt-sm-0 mt-4">
                                    <div class="text-title mb-2">August</div>
                                    <ul class="list-unstyled list-unstyled-border list-unstyled-noborder mb-0">
                                        <li class="media">
                                            <img class="img-fluid mt-1 img-shadow"
                                                src="{{ asset('backend/assets/modules/flag-icon-css/flags/4x3/id.svg') }}"
                                                alt="image" width="40">
                                            <div class="media-body ml-3">
                                                <div class="media-title">Indonesia</div>
                                                <div class="text-small text-muted">3,486 <i
                                                        class="fas fa-caret-up text-success"></i></div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img class="img-fluid mt-1 img-shadow"
                                                src="{{ asset('backend/assets/modules/flag-icon-css/flags/4x3/ps.svg') }}"
                                                alt="image" width="40">
                                            <div class="media-body ml-3">
                                                <div class="media-title">Palestine</div>
                                                <div class="text-small text-muted">3,182 <i
                                                        class="fas fa-caret-up text-success"></i></div>
                                            </div>
                                        </li>
                                        <li class="media">
                                            <img class="img-fluid mt-1 img-shadow"
                                                src="{{ asset('backend/assets/modules/flag-icon-css/flags/4x3/de.svg') }}"
                                                alt="image" width="40">
                                            <div class="media-body ml-3">
                                                <div class="media-title">Germany</div>
                                                <div class="text-small text-muted">2,317 <i
                                                        class="fas fa-caret-down text-danger"></i></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Invoices</h4>
                            <div class="card-header-action">
                                <a href="#" class="btn btn-danger">View More <i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <thead>
                                                <tr>
                                                    <th>Invoice ID</th>
                                                    <th>Customer</th>
                                                    <th>Status</th>
                                                    <th>Due Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orderInvoices as $order)
                                                    <tr>
                                                        <td><a href="#">{{ $order->order_code }}</a></td>
                                                        <td class="font-weight-600">{{ $order->user->name ?? 'N/A' }}
                                                        </td>
                                                        <td>
                                                            <div
                                                                class="badge {{ $order->status == 'Paid' ? 'badge-success' : 'badge-warning' }}">
                                                                {{ $order->status }}</div>
                                                        </td>
                                                        <td>{{ \Carbon\Carbon::parse($order->order_date)->format('F j, Y') }}
                                                        </td>
                                                        <td>
                                                            <a href="#" class="btn btn-primary">Detail</a>
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
                </div>
                <div class="col-md-4">
                    <div class="card card-hero">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="far fa-question-circle"></i>
                            </div>
                            <h4>14</h4>
                            <div class="card-description">Customers need help</div>
                        </div>
                        <div class="card-body p-0">
                            <div class="tickets-list">
                                <a href="#" class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>My order hasn't arrived yet</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>Laila Tazkiah</div>
                                        <div class="bullet"></div>
                                        <div class="text-primary">1 min ago</div>
                                    </div>
                                </a>
                                <a href="#" class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>Please cancel my order</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>Rizal Fakhri</div>
                                        <div class="bullet"></div>
                                        <div>2 hours ago</div>
                                    </div>
                                </a>
                                <a href="#" class="ticket-item">
                                    <div class="ticket-title">
                                        <h4>Do you see my mother?</h4>
                                    </div>
                                    <div class="ticket-info">
                                        <div>Syahdan Ubaidillah</div>
                                        <div class="bullet"></div>
                                        <div>6 hours ago</div>
                                    </div>
                                </a>
                                <a href="features-tickets.html" class="ticket-item ticket-more">
                                    View All <i class="fas fa-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownItems = document.querySelectorAll('#di');
            const monthDisplay = document.getElementById('orders-month');
            const monthInput = document.getElementById('month-input');

            dropdownItems.forEach(item => {
                item.addEventListener('click', function(event) {
                    event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

                    // Lấy tên tháng từ văn bản của mục
                    const selectedMonth = this.textContent;
                    const monthValue = this.getAttribute('data-month');

                    // Cập nhật tiêu đề dropdown với tháng đã chọn
                    monthDisplay.textContent = selectedMonth;

                    // Gán giá trị của tháng đã chọn vào input
                    monthInput.value = monthValue;

                    // Cập nhật URL nhưng không ảnh hưởng đến chức năng logout
                    const currentUrl = new URL(window.location.href);
                    currentUrl.searchParams.set('month', monthValue);
                    window.location.href = currentUrl.toString();
                });
            });
        });

        var salesData = @json($salesData);
        var daysInMonth = @json($daysInMonth);
    </script>
@endsection
