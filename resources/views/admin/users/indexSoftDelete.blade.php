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
                                                        </td>
                                                        <td>
                                                            @if ($user->status == 1)
                                                                <div class="badge badge-success">Hoạt động</div>
                                                            @else
                                                                <div class="badge badge-danger">Không hoạt động</div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <button
                                                                onclick="if(confirm('Bạn chắc chắn muốn khôi phục {{ $user->name }}')) {
                                                                event.preventDefault();
                                                                document.getElementById('restore-form-{{ $user->id }}').submit();
                                                            }"
                                                                class="btn btn-secondary">Restore</button>
                                                            <form id="restore-form-{{ $user->id }}"
                                                                action="{{ route('user.restore', ['id' => $user->id]) }}"
                                                                method="post" style="display: none;">
                                                                @csrf
                                                                @method('post')
                                                            </form>
                                                            <button
                                                                onclick="if(confirm('Bạn chắc chắn muốn xóa {{ $user->name }}')){
                                                                document.getElementById('user->{{ $user->id }}').submit();
                                                                }"
                                                                class="btn btn-danger">Delete</button>
                                                            <form action="{{ route('user.forceDelete', $user) }}"
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
