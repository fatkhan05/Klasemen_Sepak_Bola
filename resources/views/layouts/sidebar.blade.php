<!-- Main Sidebar Container -->
<style>
	.main-sidebar { background-color: #4C432A !important };
  a .brand-image {
      width: 300px;
      height: 100rem;
  }
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #4C432A">
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #4C432A;">
      <div class="brand-loggo" style="height: 65px">
        <a href="">
          <h5 class="ms-2 pt-4"><strong>KLASEMEN SEPAK BOLA</strong></h5>
        </a>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline mt-3" >
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" style="background-color: transparent">
          <div class="input-group-append">
            <button class="btn btn-sidebar" style="background-color: transparent">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item ">
            <a href="{{ route('data-club') }}" class="nav-link ">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Data Club
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{ route('data-klasemen') }}" class="nav-link ">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Data Klasemen
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
