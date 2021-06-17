<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Public </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('public/admin/css/all.min.css') }}" rel="stylesheet">



    <link href="{{ asset('public/admin/css/adminlte.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/OverlayScrollbars.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="{{ asset('public/common/css/custom.css') }}" rel="stylesheet">
    @yield('admin-css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="loadingImage" class="d-none">
        <img src="{{ asset('public/images/ajax-loader.svg') }}">
    </div>
    <div class="wrapper">

        <!-- Navbar -->

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">Add Form Detail </li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="offset-md-3 col-md-6">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Doctor</h3>
                            </div>
                            @if (session()->has('error'))
                                <div class="alert alert-danger danger-message">
                                    {{ session()->get('error') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('name', 'Name: ', ['class' => 'control-label']) }}
                                                <span class="star">*</span>
                                                {{ Form::text('name', null, ['id' => 'name', 'class' => 'form-control', 'maxlength' => '100']) }}
                                                <label class="help-block errormsges"></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('email', 'Email: ', ['class' => 'control-label']) }}
                                                <span class="star">*</span>
                                                {{ Form::text('email', null, ['id' => 'email', 'class' => 'form-control', 'maxlength' => '100']) }}
                                                <label class="help-block errormsges"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-offset-2 col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('specialization', 'Specialization: ', ['class' => 'control-label']) }}
                                                <span class="star">*</span>
                                                @if (count($cancerTypes))
                                                    {{ Form::select('specialization', array_replace(['' => 'Select'], $cancerTypes), null, ['class' => 'form-control', 'id' => 'specialization']) }}
                                                @else
                                                    {{ Form::select('specialization', ['' => 'Empty'], null, ['class' => 'form-control', 'id' => 'specialization']) }}
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('status', 'Status: ', ['class' => 'control-label']) }}
                                                {{ Form::select('status', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control']) }}
                                                <label class="help-block errormsges"></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?php echo date('Y'); ?></strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b></b>
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <script src="{{ asset('public/admin/js/jquery.min.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset( 'public/admin/js/jquery-ui.min.js') }}" type="text/javascript"></script> --}}


    <script src="{{ asset('public/admin/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/sparkline.js') }}" type="text/javascript"></script>

    <script src="{{ asset('public/admin/js/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/responsive.bootstrap4.min.js') }}" type="text/javascript"></script>

    {{-- <script src="{{ asset( 'public/admin/js/tempusdominus-bootstrap-4.min.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('public/admin/js/jquery.overlayScrollbars.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/adminlte.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/dashboard.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/admin/js/demo.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert-success').fadeOut('fast');
                $('.alert-danger').fadeOut('slow');
            }, 5000);

            setTimeout(function() {
                $('.flashMessage').fadeOut('slow');
            }, 3000);
        });

    </script>

    @yield('admin-js')
</body>

</html>
