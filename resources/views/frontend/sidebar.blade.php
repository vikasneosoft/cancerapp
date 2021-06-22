  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
          <img alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"
              src="{{ asset('public/admin/img/AdminLTELogo.png') }}">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img alt="User Image" class="img-circle elevation-2"
                      src="{{ asset('public/admin/img/user2-160x160.jpg') }}">
              </div>
              <div class="info">
                  <a href="#" class="d-block">
                      <?php echo Auth::guard('admin')->user()->name; ?> </a>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  <li class="nav-item ">
                      <a href="{{ route('admin_dashboard') }}" class="nav-link @if (isset($active) && $active=='dashboard' ) active @endif">
                          <i class="nav-icon fas fa-tachometer-alt"></i>
                          <p>
                              Dashboard
                          </p>
                      </a>
                  </li>



                  <li class="nav-item ">
                      <a href="{{ route('admin.getCancerTypes') }}" class="nav-link @if (isset($active) && $active=='cancerType' ) active @endif">
                          <i class="nav-icon fas fa-tree"></i>
                          <p>
                              Cancer Types
                          </p>
                      </a>
                  </li>

                  <li class="nav-item has-treeview @if (isset($active) && $active=='events' ) menu-open @endif">
                      <a href="#" class="nav-link @if (isset($active) && $active=='events' ) active @endif">
                          <i class="nav-icon fas fa-copy"></i>
                          <p>
                              Manage Doctors
                              <i class="fas fa-angle-left right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('admin.getDoctors') }}" class="nav-link @if (isset($active) && $active=='events' ) active @endif">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Doctors </p>
                              </a>
                          </li>
                      </ul>
                  </li>
              </ul>
          </nav>
      </div>
  </aside>
