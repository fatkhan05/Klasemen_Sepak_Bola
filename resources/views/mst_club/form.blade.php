<div class="card card-default mt-5">
    <div class="card-header" style="background-color: #1A4237; color: #ffffff;">
        <h3 class="card-title">{{ $data ? 'Edit' : 'Tambah' }} Data Club</h3>          
    </div>
    <form class="form-save">
        <input type="hidden" name="id" id="id" value="{{ $data->id_club }}">
        <div class="card-body">
            <div class="container row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="namaClub" class="form-label">Nama Club</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $data ? $data->nama_club : ''}}" name="nama_club" id="nama_club">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="kotaKlub" class="form-label">Kota Club</label>
                        <div class="input-group">
                            <input type="text" class="form-control" value="{{ $data ? $data->kota_club : ''}}" name="kota_club" id="kota_club">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="card-footer">
        <button type="button" id="button-submit" class="btn float-right btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary btn-cancel ">Kembali</button>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('.btn-cancel').click(function(e){
            e.preventDefault();
            $('.other-page').fadeOut(function(){
                $('.other-page').empty();
                $('.main-page').fadeIn();
                $('#datagrid').DataTable().ajax.reload();
            });
        });

        $('#button-submit').click(function() {
            console.log('save-data');
            var data = new FormData($('.form-save')[0]);
            $.ajax({
                data: data,
                url: "{{ route('club-store') }}",
                type: "post",
                processData: false,
                contentType: false,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                },
            }).done(function(result) {
                if (result.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message, 
                        timer: 1000,
                        confirmButtonColor: '#1A4237',
                    });
                    $('.other-page').fadeOut(function() {
                        $('.other-page').empty();
                        $('.main-page').fadeIn();
                        $('#datagrid').DataTable().ajax.reload();
                    });
                } else if (result.status === 'error') {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Whoops!',
                        text: result.message.join('\n'), 
                        confirmButtonColor: '#1A4237',
                    });
                }
            });
        });
    });
</script>