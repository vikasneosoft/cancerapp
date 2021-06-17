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

 <script>
     $.widget.bridge('uibutton', $.ui.button)

 </script>
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

 @yield('doctor-js')
 </body>

 </html>
