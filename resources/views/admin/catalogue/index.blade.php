@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>USER</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('user.index') }}">User</a></div>
                    <div class="breadcrumb-item">User List</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Quản lý User</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Basic DataTables</h4>
                                    <a class="btn btn-info" href="{{ route('user.create') }}">
                                        Add User</a>
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
                                                    <th>Phone</th>
                                                    <th>Email</th>
                                                    <th>Address</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($users as $user)
                                                    <tr>
                                                        <td>{{ $user->id }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>
                                                            {{ $user->phone }}
                                                        </td>
                                                        <td>{{ $user->email }}</td>

                                                        <td>
                                                            {{ $user->address }}
                                                        </td>
                                                        <td>
                                                            @if ($user->status == 1)
                                                                <div class="badge badge-success">Hoạt động</div>
                                                            @else
                                                                <div class="badge badge-danger">Không hoạt động</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('user.show',$user->id) }}"
                                                                class="btn btn-secondary">Detail User</a>
                                                            <a href="{{ route('user.edit', $user->id) }}"
                                                                class="btn btn-success">Edit</a>
                                                            <button
                                                                onclick="if(confirm('Bạn chắc chắn muốn xóa {{ $user->name }}')){
                                                                document.getElementById('user->{{ $user->id }}').submit();
                                                                }"
                                                                class="btn btn-danger">Delete</button>
                                                            <form action="{{ route('user.delete', $user) }}"
                                                                id="user->{{ $user->id }}" method="post">
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

    <!-- Sidebar -->
    <div id="userDetailSidebar" class="user-detail-sidebar">
        <div class="sidebar-content">
            <h4>User Detail</h4>
            <p><strong>Name:</strong> <span id="detailName"></span></p>
            <p><strong>Phone:</strong> <span id="detailPhone"></span></p>
            <p><strong>Email:</strong> <span id="detailEmail"></span></p>
            <p><strong>Address:</strong> <span id="detailAddress"></span></p>
            <p><strong>Status:</strong> <span id="detailStatus"></span></p>
            <button class="btn btn-icon btn-danger" onclick="closeSidebar()">Close</button>
        </div>
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
