@extends('admin.layout')
@section('title')
	Manage Email templates
@endsection

@section('admin-content')
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h3>Email templates</h3>
                  </div>
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                        <li class="breadcrumb-item active">Email templates</li>
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
                                    <a href="{{route('admin.viewAddEmailTemplate')}}" class="btn btn-block btn-primary">Add</a></h3>
                            </div>

                            <div class="card-body">
                                @include('flash::message')
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="example1" class="table table-bordered table-striped dataTable dtr-inline">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc">Sr No.</th>
                                                        <th class="sorting">Title</th>
                                                        <th class="sorting">Type</th>
                                                        <th class="sorting">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($templates as $key=> $value)
                                                        <tr role="row" class="{{ $key }}">
                                                            <td class="sorting_1" tabindex="0">{{ $key+1 }}</td>
                                                            <td><a href="{{ route('admin.viewEditEmailTemplate', ['id' => $value['id']]) }}">{{ $value['title'] }}</a></td>
                                                            <td>{{ $value['type'] }}</td>
                                                            <td><a data-type="{{ $value['type'] }}" class="btn btn-primary checkMail">Click </a></td>
                                                            {{-- <td>
                                                                <div class="input-group input-group-lg">
                                                                    <div class="input-group-btn">
                                                                        <button type="button" class="btn btn-danger-t dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <span style="color:#337ab7" title="View" class="fa fa-cog" aria-hidden="true"></span>
                                                                        </button>
                                                                        <ul class="dropdown-menu">
                                                                            <li><a class="dropdown-item" href="{{route('admin.viewEditEmailTemplate',['id' =>$value['id']])}}">Edit</a></li>
                                                                            <li class="divider"></li>
                                                                            <li><a class="delete-template dropdown-item" href="#" data-id="{{$value['id']}}">Delete</a></li><li class="divider"></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </td> --}}
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

        $(document).on( "click", ".delete-template", function () {
            var id = $(this).attr('data-id');
            var token ="{{csrf_token()}}";
            bootbox.confirm("Are you sure you want to delete?", function (result) {
                if (result) {
                    $.ajax({
                        url: '{{route('admin.deleteCurrency')}}',
                        type: "POST",
                        data: {id: id,_token:token},
                        beforeSend : function() {
                            $("#loadingImage").show();
                        },
                        success  : function(data) {
                            $("#loadingImage").hide();
                            location.reload();
                        },
                    });
                }
            });
        });


        $(document).on( "click", ".checkMail", function () {
            var type = $(this).attr('data-type');
            var token ="{{csrf_token()}}";
            $.ajax({
                url: '{{route('checkMail')}}',
                type: "POST",
                data: {type: type,_token:token},
                beforeSend : function() {
                    $("#loadingImage").show();
                },
                success  : function(data) {
                   
                    $("#loadingImage").hide();
                    location.reload();
                },
            });
                
            
        });

    });
</script>
@endsection

