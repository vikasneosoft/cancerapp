@extends('doctor.layout')
@section('title')
    Manage Inquries
@endsection

@section('doctor-content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3>Inquries</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('doctor.dashboard') }}"><i
                                        class="fa fa-dashboard"></i> Dashboard</a></li>
                            <li class="breadcrumb-item active">Inquries</li>
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
                            <div class="card-body">
                                @include('flash::message')
                                @if (session()->has('message'))
                                    <div class="alert alert-danger">
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
                                                        <th class="sorting">Contact number</th>
                                                        <th class="sorting">Cancer Type</th>
                                                        <th class="sorting">Document</th>
                                                        <th>Address</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($inquries as $key => $value)
                                                        <tr role="row" class="{{ $key }}">
                                                            <td class="sorting_1" tabindex="0">{{ $key + 1 }}</td>
                                                            <td><a
                                                                    href="{{ route('doctor.get_detail_inquiry_by_id', ['id' => $value['id']]) }}">{{ $value['name'] }}</a>
                                                            </td>
                                                            <td>{{ $value['email'] }}</td>
                                                            <td>{{ $value['contact_number'] }}</td>
                                                            <td>
                                                                @if (isset($value['cancer_type']['name']))
                                                                    {{ $value['cancer_type']['name'] }}
                                                                @else -- @endif

                                                            </td>
                                                            <td>
                                                                <a target="_blank"
                                                                    href="{{ URL::asset('/public/documents/' . $value['document']) }}">See</a>


                                                            </td>
                                                            <td>
                                                                <p>{{ $value['city'] }}</p>
                                                                <p>{{ $value['state'] }}</p>
                                                                <p>{{ $value['pincode'] }}</p>
                                                                <p>{{ $value['address'] }}</p>
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
@section('doctor-js')
@endsection
