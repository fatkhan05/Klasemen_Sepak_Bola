@extends('layouts.master')

@section('content')
	<div class="card main-page mt-5">
		<div class="card-header" style="background-color: #1A4237; color: #ffffff;">
			<h3 class="card-title">Data Klasemen Sepak Bola</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body table-responsive">
			<a href="javascript:void(0)" onclick="addRow()" class="btn btn-success">
				<i class="fas fa-plus"></i> Tambah Baru
			</a>
			<br><br>
			<table id="datagrid" class="table-bordered table-striped table dataTable dtr-inline" style="width: 100%">
				<thead>
					<tr>
						<th>No</th>
						<th>KLUB</th>
						<th>MAIN</th>
						<th>MENANG</th>
						<th>SERI</th>
						<th>KALAH</th>
						<th>GOAL MENANG</th>
						<th>GOAL KALAH</th>
						<th>POINT</th>
						<th>AKSI</th>
					</tr>
				</thead>
			</table>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="other-page"></div>
@endsection

@push('scripts')
<script type="text/javascript">
	var table = $('#datagrid').DataTable({
		processing: true,
		serverSide: true,
		"pageLength": 25,
		language: {
			searchPlaceholder: "Ketikkan yang dicari"
		},
		
		ajax: "{{ route('data-klasemen') }}",
		columns: [{
			data: 'DT_RowIndex',
			name: 'DT_RowIndex',
			render: function(data, type, row) {
				return '<p style="color:black">' + data + '</p>';
			}
		},
		{
			data: 'data_club.nama_club',
			name: 'data_club.nama_club',
			render: function(data, type, row) {
				return '<p style="color:black">' + data + '</p>';
			}
		},
		{
			data: 'main',
			name: 'main',
			render: function(data, type, row) {
				return '<p style="color:black">' + data + '</p>';
			}
		},
		{
			data: 'menang',
			name: 'menang',
			render: function(data, type, row) {
				return '<p style="color:black">' + data + '</p>';
			}
		},
		{
			data: 'seri',
			name: 'seri',
			render: function(data, type, row) {
				return '<p style="color:black">' + data + '</p>';
			}
		},
		{
			data: 'kalah',
			name: 'kalah',
			render: function(data, type, row) {
				return '<p style="color:black">' + data + '</p>';
			}
		},
		{
			data: 'goal_menang',
			name: 'goal_menang',
			render: function(data, type, row) {
				return '<p style="color:black">' + data + '</p>';
			}
		},
		{
			data: 'goal_kalah',
			name: 'goal_kalah',
			render: function(data, type, row) {
				return '<p style="color:black">' + data + '</p>';
			}
		},
		{
			data: 'total_point',
			name: 'total_point',
			render: function(data, type, row) {
				return '<p style="color:black">' + data.points + '</p>';
			}
		},
		{
			data: 'action',
			name: 'action',
			
		}]
	});
	function addRow(){
		console.log('form');
		$('.main-page').hide();
		$.post("{!! route('form-tambah-data') !!}").done(function(data){
			if(data.status == 'success'){
				// $('.preloader').hide();
				$('.other-page').html(data.content).fadeIn();
			} else {
				$('.main-page').show();
			}
		});
	}

	function deleteRow(id) {
				// console.log(id);
		Swal.fire({
			title: 'Apakah Anda Yakin Akan Menghapus Data Ini?',
			text: 'Data akan Dihapus, dan Tidak dapat diperbaharui kembali !!',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#1A4237',
			confirmButtonText: 'Ya, Hapus Data',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: '{{ route("klasemen-destroy") }}', 
					method: 'POST', 
					data: {
						_method: 'POST', 
						_token: '{{ csrf_token() }}', 
						id: id 
					},
					success: function(response) {
						if (response.success) {
							Swal.fire({
								icon: 'success',
								title: 'Deleted!',
								timer: 1500,
								confirmButtonColor: '#1A4237',
								text: response.success
							});
							location.reload();
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Error',
								timer: 1500,
								confirmButtonColor: '#1A4237',
								text: response.error
							});
						}
					},
					error: function() {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							timer: 1500,
							confirmButtonColor: '#1A4237',
							text: 'Data Gagal Dihapus!!.'
						});
					}
				});
			}
		});
	}
</script>
@endpush