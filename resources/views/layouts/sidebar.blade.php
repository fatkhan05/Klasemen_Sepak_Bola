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
    {{-- <a href="{{ route('dashboard') }}" class="brand-link" style="height: 50px;">
      <img src="{{ asset('AdminLTE-3.2.0/dist/img/logo2.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">YPP. Al - Azhar</span>
    </a> --}}
    
    <!-- Sidebar -->
    <div class="sidebar" style="background-color: #4C432A;">
      <div class="brand-loggo" style="height: 65px">
        <a href="">
          <h5 class="ms-2 pt-4"><strong>KLASEMEN SEPAK BOLA</strong></h5>
          {{-- <img src="{{ asset('AdminLTE-3.2.0/dist/img/loggo_sidebar.png')}}" alt="AdminLTE Logo" class="brand-image m-2" width="220" height="58" style="margin-bottom: -100px; margin-left: -50rem;"> --}}
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
          {{-- <li class="nav-item ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-coins"></i>
              <p>
                Penggajian
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class=" nav-item">
                <a href="" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pegawai</p>
                </a>
              </li> --}}
              {{-- @php                
                  // var_dump(Auth::user()->getRoleNames())
              @endphp
              @role('admin')
              <li class="nav-item">
                <a href="" class="nav-link {{ $data['submnActive'] == 'yayasan' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Keluarga Yayasan</p>
                </a>
              </li>
              @endrole
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('rekapabsen') }}" class="nav-link {{ $data['menuActive'] == 'absensi' ? 'active' : '' }}">
              <i class="nav-icon fas fa-calendar-check"></i>
              <p>
                Rekap Absensi
              </p>
            </a>
          </li>
          <li class="nav-item {{ $data['menuActive'] == 'dataMaster' ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ $data['menuActive'] == 'dataMaster' ? 'active' : '' }}">
              <i class="nav-icon fas fa-server"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @role('admin')
              <li class="nav-item">
                <a href="{{ route('pengguna' ) }}" class="nav-link {{ $data['submnActive'] == 'pengguna' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pengguna</p>
                </a>
              </li>
              @endrole
              <li class="nav-item">
                <a href="{{ route('pegawai.main') }}" class="nav-link {{ $data['submnActive'] == 'dataPegawai' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pegawai</p>
                </a>
              </li>
              @role('admin')
              <li class="nav-item">
                <a href="{{ route('yayasan') }}" class="nav-link {{ $data['submnActive'] == 'keluargaYayasan' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Kel. Yayasan</p>
                </a>
              </li>
              @endrole
              <li class="nav-item">
                <a href="{{ route('jamkerja') }}" class="nav-link {{ $data['submnActive'] == 'jamKerja' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jam Kerja</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('index') }}" class="nav-link {{ $data['submnActive'] == 'jabatan' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Jabatan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('tunjangan' ) }}" class="nav-link {{ $data['submnActive'] == 'tunjangan' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Tunjangan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('potongan-gaji' ) }}" class="nav-link {{ $data['submnActive'] == 'potongan' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Potongan Gaji</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{ $data['menuActive'] == 'pinjaman' ? 'menu-is-opening menu-open' : '' }}">
            <a href="#" class="nav-link {{ $data['menuActive'] == 'pinjaman' ? 'active' : '' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Pinjaman
                <i class="right fas fa-angle-right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('pinjaman') }}" class="nav-link {{ $data['menuActive'] == 'pinjaman' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pinjaman</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ route('pengaturan') }}" class="nav-link {{ $data['menuActive'] == 'pengaturan' ? 'active' : '' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Pengaturan
              </p>
            </a>
          </li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
