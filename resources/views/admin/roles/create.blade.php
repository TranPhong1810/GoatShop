@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>ROLE</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('role.index') }}">Role</a></div>
                    <div class="breadcrumb-item">Create Role</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Create Role</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Add New Role</h4>
                                    <a class="btn btn-info" href="{{ route('role.index') }}">
                                        Role List</a>
                                </div>
                                <form class="" action="{{ route('role.store') }}" method="POST"
                                    enctype="multipart/form-data" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="ho-ten">Name<span class="text-danger">(*)</span></label>
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control" id="ho-ten" required>
                                                    @error('name')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="display_name">Display Name<span
                                                            class="text-danger">(*)</span></label>
                                                    <input type="text" name="display_name"
                                                        value="{{ old('display_name') }}" class="form-control"
                                                        id="display_name" required>
                                                    @error('display_name')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        @php
                                                            $columnCounter = 0;
                                                            $columnLimit = 1;
                                                        @endphp
                                                        @foreach ($permissions as $groupName => $permission)
                                                            @if ($columnCounter % $columnLimit == 0)
                                                                <div class="col-md-4">
                                                            @endif

                                                            <label class="d-block font-weight-bold mt-3" for="display_name">{{ $groupName }}<span class="text-danger">(*)</span></label>
                                                            <div class="form-check">
                                                                @foreach ($permission as $item)
                                                                    <div class="custom-control custom-checkbox">
                                                                        <input type="checkbox" name="permission_ids[]" value="{{ $item->id }}" id="permission_{{ $item->id }}" class="custom-control-input">
                                                                        <label class="custom-control-label" for="permission_{{ $item->id }}">{{ $item->display_name }}</label>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                            @php
                                                                $columnCounter++;
                                                            @endphp

                                                            @if ($columnCounter % $columnLimit == 0)
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        @if ($columnCounter % $columnLimit != 0)
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
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
    </div>
    </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/assets/modules/dropzonejs/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/page/components-multiple-upload.js') }}"></script>
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
