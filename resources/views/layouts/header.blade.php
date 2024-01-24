<!-- Navbar -->
<style>
	.main-header { background-color: #1E3E33 !important };
	.dropdown-toggle::after {
    	display: none; /* Menghilangkan ikon segitiga kecil */
	}
	@media (max-width: 360px) {
		nav {
			font-size: 70%;
			/* height: 10%; */
			display: flex;
			flex-wrap: wrap;
		}

		.dropdown {
			width: 20%;
			display: flex;
			flex-wrap: wrap;
			position: relative;
			display: none;
		}
		.notification {
			left: 20%;
			display: none;
		}
	}
  </style>
<nav class="main-header navbar navbar-expand-lg navbar-dark fixed-top">
	<!-- Left navbar links -->
	<ul class="navbar-nav" >
		<li class="nav-item">
			<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			{{-- <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a> --}}
		</li>
		<li class="nav-item d-none d-sm-inline-block">
			{{-- <a href="{{ route('pengaturan') }}" class="nav-link">Pengaturan</a> --}}
		</li>
	</ul>
	
	<!-- Right navbar links -->
	<ul class="navbar-nav ml-auto">

		<!-- Notifications Dropdown Menu -->
		<li class="nav-item dropdown mt-1">
			<a class="nav-link notification" data-toggle="dropdown" href="#">
				<i class="far fa-bell"></i>
				<span class="badge badge-warning navbar-badge">15</span>
			</a>
			<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<span class="dropdown-item dropdown-header">15 Notifications</span>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-envelope mr-2"></i> 4 new messages
					<span class="text-muted float-right text-sm">3 mins</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-users mr-2"></i> 8 friend requests
					<span class="text-muted float-right text-sm">12 hours</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item">
					<i class="fas fa-file mr-2"></i> 3 new reports
					<span class="text-muted float-right text-sm">2 days</span>
				</a>
				<div class="dropdown-divider"></div>
				<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
			</div>
		</li>
		{{-- <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<img src="{{ asset('AdminLTE-3.2.0/dist/img/logo2.jpg') }}" class="img-circle elevation-2" alt="User Image" style="width: 30px; height: 30px;">
				<p class="d-none d-md-inline">{{Auth::user()->username}}</p>
			</a>
			<div class="dropdown-menu dropdown-menu-sm dropdown-menu-right border-0" style="border-radius: 10px">
				<!-- ... User Profile Dropdown Menu content ... -->
				<a class="dropdown-item" href="#"><i class="bx bx-user"></i><span>Profile</span></a>
				<div class="dropdown-divider"></div>
				<button class="dropdown-item" id="logout-button" type="submit"><i class='bx bx-log-out-circle'></i><span>Logout</span></button>
			</div>
		</li> --}}
		
	</ul>
</nav>
<!-- /.navbar -->
@push('scripts')
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('.dropdown-toggle').dropdown();
		$('#logout-button').click(function(e) {
			console.log('dsfsdf');
            e.preventDefault();

            $.ajax({
                url: "{{ route('logout') }}",
                type: "POST",
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Logout Berhasil',
                            // text: 'Anda akan diarahkan dalam 3 Detik',
                            timer: 2000,
                            showCancelButton: false,
                            showConfirmButton: false
                        }).then(function() {
                            window.location.href = "{{ route('home') }}"; // Ganti dengan URL setelah logout berhasil
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Logout Gagal',
                            text: 'Terjadi kesalahan saat logout.'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi Kesalahan',
                        text: 'Gagal melakukan logout.'
                    });
                }
            });
        });
        });
</script> --}}
@endpush

