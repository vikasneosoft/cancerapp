@include('admin.header')
@include('admin.sidebar')

<div class="page-content-wrapper">
    <div class="page-content">
        @yield('admin-content')
    </div>
</div>
@include('admin.footer')
