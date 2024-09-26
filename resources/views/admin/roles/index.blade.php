@extends('admin.layout.app')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Role</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('dashboard.index') }}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('role.index') }}">Role</a></div>
                    <div class="breadcrumb-item">Role List</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Quản lý Role</h2>
                <div class="card">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4>Basic DataTables</h4>
                                    <a class="btn btn-info" href="{{ route('role.create') }}">
                                        Add Role</a>
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
                                                    <th>Display Name</th>
                                                    <th>Group</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($roles as $role)
                                                    <tr>
                                                        <td>{{ $role->id }}</td>
                                                        <td>{{ $role->name }}</td>
                                                        <td>{{ $role->display_name }}</td>
                                                        <td>{{ $role->group }}</td>
                                                        <td>
                                                            <a href="{{ route('role.edit', $role->id) }}"
                                                                class="btn btn-success">Edit</a>
                                                            <button
                                                                onclick="if(confirm('Bạn chắc chắn muốn xóa {{ $role->name }}')){
                                                                document.getElementById('role->{{ $role->id }}').submit();
                                                                }"
                                                                class="btn btn-danger">Delete</button>
                                                            <form action="{{ route('role.delete', $role) }}"
                                                                id="role->{{ $role->id }}" method="post">
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
