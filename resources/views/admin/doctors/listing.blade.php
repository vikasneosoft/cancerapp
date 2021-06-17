@extends('admin.layout')
@section('title')
    Manage Doctors
@endsection

@section('admin-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Doctors</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                        class="fa fa-dashboard"></i> Dashboard</a></li>
                            <li class="breadcrumb-item active">Doctors</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <a href="{{ route('admin.viewAddDoctor') }}" class="btn btn-block btn-primary">Add</a>
                                </h3>
                            </div>

                            <div class="card-body">
                                @include('flash::message')
                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example1"
                                                class="table table-bordered table-striped dataTable dtr-inline">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc">Sr No.</th>
                                                        <th class="sorting">Name</th>
                                                        <th class="sorting">Email</th>
                                                        <th class="sorting">Specialization</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($doctors as $key => $value)
                                                        <tr role="row" class="{{ $key }}">
                                                            <td class="sorting_1" tabindex="0">{{ $key + 1 }}</td>
                                                            <td><a
                                                                    href="{{ route('admin.viewEditDoctor', ['id' => $value['id']]) }}">{{ $value['name'] }}</a>
                                                            </td>
                                                            <td>{{ $value['email'] }}</td>
                                                            <td>
                                                                @if (isset($value['cancer_type']['name']))
                                                                    {{ $value['cancer_type']['name'] }}
                                                                @else -- @endif

                                                            </td>
                                                            <td>
                                                                @if ($value['status'] == 1)
                                                                    <button class="btn btn-info change-status"
                                                                        data-id="{{ $value['id'] }}"
                                                                        data-status="0">Active</button>
                                                                @else
                                                                    <button class="btn btn-danger change-status"
                                                                        data-id="{{ $value['id'] }}"
                                                                        data-status="1">Inactive</button>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="input-group input-group-lg">
                                                                    <div class="input-group-btn">
                                                                        <button type="button"
                                                                            class="btn btn-danger-t dropdown-toggle"
                                                                            data-toggle="dropdown" aria-expanded="false">
                                                                            <span style="color:#337ab7" title="View"
                                                                                class="fa fa-cog" aria-hidden="true"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item"
                                                                                    href="{{ route('admin.viewEditDoctor', ['id' => $value['id']]) }}">Edit</a>
                                                                            </li>
                                                                            <li class="divider"></li>
                                                                            <li><a class="delete dropdown-item" href="#"
                                                                                    data-id="{{ $value['id'] }}">Delete</a>
                                                                            </li>
                                                                            <li class="divider"></li>

                                                                        </ul>
                                                                    </div>
                                                                </div>
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
                </div>
            </div>
        </section>
    </div>

@endsection
@section('admin-js')
    <script src="{{ asset('public/common/js/bootbox.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#example1').DataTable()




            $(document).on("click", ".change-status", function() {
                var id = $(this).attr('data-id');
                var status = $(this).attr('data-status');
                var token = "{{ csrf_token() }}";
                bootbox.confirm("Are you sure you want to change the status?", function(result) {
                    if (result) {
                        $.ajax({
                            url: '{{ route('admin.changeDoctorStatus') }}',
                            type: "POST",
                            data: {
                                id: id,
                                status: status,
                                _token: token
                            },
                            beforeSend: function() {
                                $("#loadingImage").show();
                            },
                            success: function(data) {
                                $("#loadingImage").hide();
                                location.reload();
                            },
                        });
                    }
                });
            });
            /** Delete Product **/
            $(document).on("click", ".delete", function() {
                var id = $(this).attr('data-id');
                var token = "{{ csrf_token() }}";
                bootbox.confirm("Are you sure you want to delete?", function(result) {
                    if (result) {
                        $.ajax({
                            url: '{{ route('admin.deleteDoctor') }}',
                            type: "POST",
                            data: {
                                id: id,
                                _token: token
                            },
                            beforeSend: function() {
                                $("#loadingImage").show();
                            },
                            success: function(data) {
                                $("#loadingImage").hide();
                                location.reload();
                            },
                        });
                    }
                });
            });
        });

    </script>
@endsection