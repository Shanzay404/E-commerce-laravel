
<style>
    .nav-treeview .nav-link.active {
      color: blue !important;
      background-color: transparent !important;
      font-weight: 700 !important;
    }
    </style>
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
          <img src="/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Project 2</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="/admin/dist/img/userLogo.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="{{route('admin.viewProfile',Auth()->user()->id)}}" class="d-block">E Commerce</a>
            </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Sidebar Menu -->
        <!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Dashboard Link -->
      <li class="nav-item">
        <a href="{{route('redirect')}}" class="nav-link">
          <i class="nav-icon fas fa-th"></i>
          <p>Dashboard</p>
        </a>
      </li>
      
       <!-- Users Dropdown -->
       <li class="nav-item dropdown {{ request()->routeIs('admin.viewUsers', 'admin.addUser') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-chart-pie"></i>
          <p>Users <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('admin.viewUsers') }}" class="nav-link {{ request()->routeIs('admin.viewUsers') ? 'active' : '' }}">
              <i class="far fa-user nav-icon"></i>
              <p>View</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.addUser') }}" class="nav-link {{ request()->routeIs('admin.addUser') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Add</p>
            </a>
          </li>
        </ul>
      </li>
      {{-- permission menu --}}
          
      <li class="nav-item">
        <a href="{{ url('permissions') }}" class="nav-link {{ request()->routeIs('permissions.index') ? 'active' : '' }}">
          <i class="far fa-user nav-icon"></i>
          <p>Permissions</p>
        </a>
      </li>
      {{-- roles menu --}}
          
      <li class="nav-item">
        <a href="{{ url('roles') }}" class="nav-link {{ request()->routeIs('roles.index') ? 'active' : '' }}">
          <i class="far fa-user nav-icon"></i>
          <p>Roles</p>
        </a>
      </li>
      <!-- Category Dropdown -->
      <li class="nav-item dropdown {{ request()->routeIs('admin.viewCategory', 'admin.addCategoryPage') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-chart-pie"></i>
          <p>Category <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('admin.viewCategory') }}" class="nav-link {{ request()->routeIs('admin.viewCategory') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>View</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.addCategoryPage') }}" class="nav-link {{ request()->routeIs('admin.addCategoryPage') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Add</p>
            </a>
          </li>
        </ul>
      </li>

      <!-- Products Dropdown -->
      <li class="nav-item dropdown {{ request()->routeIs('admin.viewProduct', 'admin.addProductPage') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon far fa-image"></i>
          <p>Products <i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('admin.viewProduct') }}" class="nav-link {{ request()->routeIs('admin.viewProduct') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>View</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.addProductPage') }}" class="nav-link {{ request()->routeIs('admin.addProductPage') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Add</p>
            </a>
          </li>
        </ul>
      </li>

      <!-- Settings Dropdown -->
      <li class="nav-item dropdown {{ request()->routeIs('admin.changePassword', 'admin.viewProfile') ? 'menu-open' : '' }}">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog"></i>
          <p>Settings <i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{ route('admin.changePassword') }}" class="nav-link {{ request()->routeIs('admin.changePassword') ? 'active' : '' }}">
              <i class="nav-icon fas fa-edit"></i>
              <p>Change Password</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('admin.viewProfile', Auth()->user()->id) }}" class="nav-link {{ request()->routeIs('admin.viewProfile') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Profile Edit</p>
            </a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
  <!-- /.sidebar-menu -->

          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>





