<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cancer App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700">
    <link href="{{ asset('public/frontend/css/style.default.css') }}" rel="stylesheet">
    <link href="{{ asset('public/common/css/custom.css') }}" rel="stylesheet">


    <link rel="shortcut icon" href="favicon.png">
    @yield('frontend-css')

</head>

<body>
    <div id="loadingImage" style="display:none">
        <img src="{{ asset('public/images/ajax-loader.gif') }}">
    </div>

    <header class="header mb-5">
        <div id="top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 offer mb-3 mb-lg-0">

                    </div>
                    <div class="col-lg-6 text-center text-lg-right">
                        <ul class="menu list-inline mb-0">
                            <li class="list-inline-item"><a href="{{ route('doctor_login') }}"
                                    data-target="#login-modal">Login</a></li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="all">
        <div id="content">
            <div class="container">
