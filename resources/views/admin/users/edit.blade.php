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
                <h2 class="section-title">Edit User</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Edit New User</h4>
                                    <a class="btn btn-info" href="{{ route('user.index') }}">
                                        User List</a>
                                </div>
                                <form class="" action="{{ route('user.update', $user) }}" method="POST"
                                    enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="card-header">
                                                <h4>Thông tin chung</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label for="ho-ten">Họ Tên <span
                                                                class="text-danger">(*)</span></label>
                                                        <input type="text" name="name"
                                                            value="{{ old('name') ?? $user->name }}" class="form-control"
                                                            id="ho-ten" required>
                                                        @error('name')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="email">Email <span
                                                                class="text-danger">(*)</span></label>
                                                        <input type="email" name="email"
                                                            value="{{ old('email') ?? $user->email }}" class="form-control"
                                                            id="email" required>
                                                        @error('email')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <?php
                                                    $userCatalogue = ['Nhóm thành viên', 'Quản trị viên', 'Cộng tác viên'];

                                                    ?>
                                                    <div class="col-md-6 form-group">
                                                        <label for="nhom-thanh-vien">Nhóm Thành viên <span
                                                                class="text-danger">(*)</span></label>
                                                        <select name="user_catalogue_id" class="form-control"
                                                            id="nhom-thanh-vien" value="" required>
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
                                                    <div class="col-md-6 form-group">
                                                        <label for="ngay-sinh">Ngày sinh</label>
                                                        <input type="text" name="birthday"
                                                            value="{{ old('birthday') ?? ($user->birthday ? date('Y-m-d', strtotime($user->birthday)) : '') }}"
                                                            class="form-control datepicker" id="ngay-sinh">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label for="ngay-sinh">hình ảnh</label>
                                                        <div class="card-body">
                                                            <form action="#" class="dropzone" id="mydropzone">
                                                                <div class="fallback">
                                                                    <input type="file" class="form-control"
                                                                           accept="image/*" name="image" id="image-input"
                                                                           id="inputGroupFile01">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <img src="{{ asset('backend/assets/img/avatar/avatar-2.png') }}" class="img-thumbnail" id="show-image" width="200px" alt="">
                                                        <input type="hidden" id="old-image" value="...">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <div class="control-label">Trạng thái</div>
                                                        <label class="custom-switch mt-2">
                                                            <input type="checkbox" name="status"
                                                                class="custom-switch-input"
                                                                {{ $user->status == 1 ? 'checked' : '' }}>
                                                            <span class="custom-switch-indicator"></span>
                                                            <span class="custom-switch-description">Hiển thị</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card-header">
                                                <h4>Thông tin liên hệ</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-4 form-group">
                                                        <label for="thanh-pho">Thành Phố</label>
                                                        <select class="form-control location" name="province_id"
                                                            id="thanh-pho">
                                                            <option value="">Chọn Thành Phố</option>
                                                            @foreach ($provinces as $province)
                                                                <option value="{{ $province->code }}"
                                                                    {{ old('province_id') == $province->code ? 'selected' : '' }}>
                                                                    {{ $province->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="quan-huyen">Quận/Huyện</label>
                                                        <select class="form-control location" name="district_id"
                                                            id="quan-huyen">
                                                            <option value="" selected>Chọn Quận/Huyện</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 form-group">
                                                        <label for="phuong-xa">Phường/Xã</label>
                                                        <select class="form-control location" name="ward_id"
                                                            id="phuong-xa">
                                                            <option value="" selected>Chọn Phường/Xã</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 form-group">
                                                        <label for="dia-chi">Địa chỉ</label>
                                                        <input type="text" name="address"
                                                            value="{{ old('address') ?? $user->address }}"
                                                            class="form-control" id="dia-chi">
                                                    </div>
                                                    <div class="col-md-6 form-group">
                                                        <label for="so-dien-thoai">Số điện thoại</label>
                                                        <input type="text" name="phone"
                                                            value="{{ old('phone') ?? $user->phone }}"
                                                            class="form-control" id="so-dien-thoai">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 form-group">
                                                        <label for="ghi-chu">Ghi chú</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ old('description') ?? $user->description }}"
                                                            name="description" id="ghi-chu">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end">
                                            <button class="mx-4 btn btn-primary">Edit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-whitesmoke">
                    This is card footer
                </div>
                <script>
                    var old_province_id = '{{ $user->province_id }}';
                    var old_district_id = '{{ $user->district_id }}';
                    var old_ward_id = '{{ $user->ward_id }}';
                </script>

            </div>
    </div>
    </section>
    </div>
@endsection

@push('scripts')
    <script>
        'use strict';

        $(document).ready(function() {
            function sendDataTogetLocation(option) {
                console.log('Sending data to location service:', option);
            }

            $(document).on('change', '.location', function() {
                let _this = $(this);
                let option = {
                    data: {
                        location_id: _this.val(),
                    },
                    target: _this.attr('data-target'),
                };
                sendDataTogetLocation(option);
            });

            $('#thanh-pho').change(function() {
                var province_id = $(this).val();
                if (province_id) {
                    $.ajax({
                        url: '{{ route('getDistricts', '') }}/' + province_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#quan-huyen').empty();
                            $('#quan-huyen').append(
                                '<option value="" selected>Chọn Quận/Huyện</option>');
                            $.each(data, function(key, value) {
                                var selected = value.code == old_district_id ?
                                    'selected' : '';
                                $('#quan-huyen').append('<option value="' + value.code +
                                    '" ' + selected + '>' + value.name + '</option>'
                                );
                            });

                            // Trigger change event to load districts
                            $('#quan-huyen').trigger('change');
                        }
                    });
                }
            });

            $('#quan-huyen').change(function() {
                var district_id = $(this).val();
                if (district_id) {
                    $.ajax({
                        url: '{{ url('user/wards') }}/' + district_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#phuong-xa').empty();
                            $('#phuong-xa').append(
                                '<option value="" selected>Chọn Phường/Xã</option>');
                            $.each(data, function(key, value) {
                                var selected = value.code == old_ward_id ? 'selected' :
                                    '';
                                $('#phuong-xa').append('<option value="' + value.code +
                                    '" ' + selected + '>' + value.name + '</option>'
                                );
                            });
                        }
                    });
                } else {
                    $('#phuong-xa').empty();
                }
            });

            // Load province and trigger change event to load districts and wards
            function loadCity() {
                var province_id = old_province_id;
                if (province_id) {
                    $('#thanh-pho').val(province_id).trigger('change');
                }
            }
            loadCity();
            $(document).ready(function() {
                $("#image-input").change(function() {
                    readURL(this);
                });

                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#show-image').attr('src', e.target.result);
                        };
                        console.log(input.files[0]);
                        reader.readAsDataURL(input.files[0]);
                    }
                }
            });

            function restoreOldImage() {
                var oldImage = $('#old-image').val();
                $('#show-image').attr('src', oldImage);
            }
        });
    </script>
    <!-- JS Libraies -->
    <script src="{{ asset('backend/assets/modules/cleave-js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/cleave-js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/assets/modules/jquery-selectric/jquery.selectric.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/page/forms-advanced-forms.js') }}"></script>
@endpush
