@extends('admin.layout.app')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Coupon</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('coupon.index') }}">Coupon</a></div>
                    <div class="breadcrumb-item">Create Coupon</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Create Coupon</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Add New Coupon</h4>
                                    <a class="btn btn-info" href="{{ route('coupon.index') }}">Coupon List</a>
                                </div>
                                <form action="{{ route('coupon.store') }}" method="POST" novalidate>
                                    @csrf
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label class="form-label">Coupon Code</label>
                                                <input type="text" name="code" class="form-control" required>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label class="form-label">Discount Amount</label>
                                                <input type="number" name="discount_amount" class="form-control" required step="0.01">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label class="form-label">Discount Type</label>
                                                <select name="discount_type" class="form-control" required>
                                                    <option value="fixed">Fixed Amount</option>
                                                    <option value="percentage">Percentage</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label class="form-label">Start Date</label>
                                                <input type="date" name="start_date" id="start_date" class="form-control" required min="<?= date('Y-m-d'); ?>">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label class="form-label">End Date</label>
                                                <input type="date" name="end_date" id="end_date" class="form-control" required>
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <label class="form-label">Usage Limit</label>
                                                <input type="number" name="usage_limit" class="form-control" placeholder="Optional">
                                            </div>

                                            <div class="col-md-6 form-group">
                                                <div class="control-label">Hiển thị</div>
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="is_active" class="custom-switch-input">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 d-flex justify-content-end">
                                            <button class="mx-4 btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

