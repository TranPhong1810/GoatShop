@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">{{ $user->name }}</h2>
                <p class="section-lead">
                    Change information about yourself on this page.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img alt="image"
                                    src="{{ $user->image ? asset('storage/' . $user->image) : asset('backend/assets/img/avatar/avatar-1.png') }}"
                                    class="rounded-circle profile-widget-picture">

                            </div>
                            <div class="profile-widget-description">
                                <div class="profile-widget-name">{{ $user->name }} <div
                                        class="text-muted d-inline font-weight-normal">
                                        <div class="slash"></div>
                                        {{ $user->user_catalogue_id == 1 ? 'Quản trị viên' : 'Cộng tác viên' }} <div
                                            class="slash"></div>
                                        @if ($user->status == 1)
                                            <div class="badge badge-success">Hoạt động</div>
                                        @else
                                            <div class="badge badge-danger">Không hoạt động</div>
                                        @endif
                                    </div>

                                </div>
                                {{ $user->description }}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form method="post" class="needs-validation" novalidate="">
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <form class="" action="{{ route('user.update', $user) }}" method="POST"
                                        enctype="multipart/form-data" novalidate>
                                        <div class="row">
                                            <div class="form-group col-md-6 col-12">
                                                <label for="ho-ten">Họ Tên <span class="text-danger">(*)</span></label>
                                                <input type="text" name="name"
                                                    value="{{ old('name') ?? $user->name }}" class="form-control"
                                                    id="ho-ten" required>
                                                @error('name')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6 col-12">
                                                <?php
                                                $userCatalogue = ['Nhóm thành viên', 'Quản trị viên', 'Cộng tác viên'];
                                                ?>
                                                <label for="nhom-thanh-vien">Nhóm Thành viên <span
                                                        class="text-danger">(*)</span></label>
                                                <select name="user_catalogue_id" class="form-control" id="nhom-thanh-vien"
                                                    value="" required>
                                                    @foreach ($userCatalogue as $key => $value)
                                                        <option value="{{ $key }}"
                                                            {{ old('user_catalogue_id', $user->user_catalogue_id) == $key ? 'selected' : '' }}>
                                                            {{ $value }}</option>
                                                    @endforeach
                                                </select>
                                                @error('user_catalogue_id')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-7 col-12">
                                                <label for="email">Email <span class="text-danger">(*)</span></label>
                                                <input type="email" name="email"
                                                    value="{{ old('email') ?? $user->email }}" class="form-control"
                                                    id="email" required>
                                                @error('email')
                                                    <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-5 col-12">
                                                <label for="so-dien-thoai">Số điện thoại</label>
                                                <input type="text" name="phone"
                                                    value="{{ old('phone') ?? $user->phone }}" class="form-control"
                                                    id="so-dien-thoai">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-12">
                                                <label>Bio</label>
                                                <textarea class="form-control summernote-simple">{{ $user->description }}</textarea>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row">
                                        <div class="form-group mb-0 col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="remember" class="custom-control-input"
                                                    id="newsletter">
                                                <label class="custom-control-label" for="newsletter">Subscribe to
                                                    newsletter</label>
                                                <div class="text-muted form-text">
                                                    You will get new information about products, offers and promotions
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
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
