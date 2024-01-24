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
		</li>
		<li class="nav-item d-none d-sm-inline-block">
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
	</ul>
</nav>
<!-- /.navbar -->

