<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Admin | @yield('title') </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('public/admin/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/ionicons.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/admin/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/admin/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/admin/css/icheck-bootstrap.min.css') }}" rel="stylesheet">
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
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">

            <ul class="navbar-nav ml-auto">


                <li class="nav-item dropdown">
                    <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"
                        class="nav-link dropdown-toggle"><?php echo Auth::guard('admin')->user()->name;
                        ?></a>
                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"
                        style="left: 0px; right: inherit;">
                        <li><a href="#" class="dropdown-item">Some action </a></li>

                        <li><a href="{{ route('adminLogout') }}" class="dropdown-item">Logout</a></li>
                    </ul>
                </li>
            </ul>

        </nav>
