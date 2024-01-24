<div class="card card-default mt-5">
    <div class="card-header" style="background-color: #1A4237; color: #ffffff;">
        <h3 class="card-title">Tambah Data Baru</h3>          
    </div>
    <form class="form-save">
        <div class="card-body">
            <div class="container row">
                <input type="hidden" name="id" id="id">
                {{-- Radio Button --}}
                <div class="type-input mb-3 row">
                    <div class="col-md-6">
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" value="0" id="single">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Single Input
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" value="1" id="multiple">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Multiple Input
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Single Input Form --}}
                <div class="single-input" id="single_input_form" style="display: none">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="namaClub" class="form-label">Nama Club</label>
                                <div class="input-group">
                                    {{-- <input type="text" class="form-control" name="single_nama_club" id="single_nama_club" placeholder="Nama Club"> --}}
                                    <select name="single_nama_club" id="single_nama_club" class="form-select">
                                        <option value="" selected>.:: PILIH ::.
                                            @foreach ($club as $cl)
                                                <option value="{{ $cl->id_club }}">{{ $cl->nama_club }}</option>
                                            @endforeach
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label for="scoreClub" class="form-label">Main</label>
                            <div class="input-group">
                                <input type="text" class="form-control score" name="main_single_club" id="main_single_club" placeholder="Score">
                            </div>
                        </div><div class="col-md-1">
                            <label for="scoreClub" class="form-label">Menang</label>
                            <div class="input-group">
                                <input type="text" class="form-control score" name="menang_single_club" id="menang_single_club" placeholder="Score">
                            </div>
                        </div><div class="col-md-1">
                            <label for="scoreClub" class="form-label">Seri</label>
                            <div class="input-group">
                                <input type="text" class="form-control score" name="seri_single_club" id="seri_single_club" placeholder="Score">
                            </div>
                        </div><div class="col-md-1">
                            <label for="scoreClub" class="form-label">Kalah</label>
                            <div class="input-group">
                                <input type="text" class="form-control score" name="kalah_single_club" id="kalah_single_club" placeholder="Score">
                            </div>
                        </div><div class="col-md-2">
                            <label for="scoreClub" class="form-label">Goal Menang</label>
                            <div class="input-group">
                                <input type="text" class="form-control score" name="goal_menang_single_club" id="goal_menang_single_club" placeholder="Score">
                            </div>
                        </div><div class="col-md-2">
                            <label for="scoreClub" class="form-label">Goal Kalah</label>
                            <div class="input-group">
                                <input type="text" class="form-control score" name="goal_kalah_single_club" id="goal_kalah_single_club" placeholder="Score">
                            </div>
                        </div>
                    </div>
                </div>


                {{-- Multiple Input Form --}}
                <div class="multiple-input-form form-group" id="multiple_input_form"></div>
                <button type="button" class="btn btn-success float-left col-2" id="add-baru" style="display: none">Add</button>

            </div>
        </div>
    </form>
    <div class="card-footer">
        <button type="button" id="button-submit" class="btn float-right btn-success">Simpan</button>
        <button type="button" class="btn btn-secondary btn-cancel ">Kembali</button>
    </div>
</div>

<script type="text/javascript">
// $('#single_nama_club').select2({
//     theme: 'bootstrap4',
//     width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
//     placeholder: $(this).data('placeholder'),
//     allowClear: Boolean($(this).data('allow-clear')),
//     tags: true,
// });
$(document).ready(function () {
    $('.btn-cancel').click(function(e){
        e.preventDefault();
        $('.other-page').fadeOut(function(){
            $('.other-page').empty();
            $('.main-page').fadeIn();
            $('#datagrid').DataTable().ajax.reload();
        });
    });

    $('input[type=radio]').change(function() {
        if ($('#single').prop('checked')) {
            var selectedValue = $('input[name=flexRadioDefault]:checked').val();
            $('#single_input_form').css('display', 'block')
            $('#multiple_input_form').css('display', 'none')
            $('#add-baru').css('display', 'none')
        } else if ($('#multiple').prop('checked')) {
            var selectedValue = $('input[name=flexRadioDefault]:checked').val();
            $('#single_input_form').css('display', 'none')
            $('#multiple_input_form').css('display', 'block')
            $('#add-baru').css('display', 'block')
        }
    });

    function makeid(length) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
            let counter = 0;
            while (counter < length) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
            counter += 1;
            }
            return result;
    }

    function addRowScore(data) { 
            let detail_club = [];
            console.log(detail_club);
            var generateId = makeid(5);
            var idClub = $('#id_club').val();

            $(document).on('input', '.score', function() {
                var inputValue = $(this).val();
                var sanitizedValue = inputValue.replace(/[^0-9]/g, '');
                $(this).val(sanitizedValue);
            });

            // Cek apakah data.id_club memiliki nilai (untuk menentukan apakah ini operasi update)
            if (data && data.id_club) {
                isUpdate = true;
            }
            // Buat Dua input
            // var inputNamaClub = '<div class="form-group form-input-container">';
            //     inputNamaClub += '<label for="inputNamaClub" class="col-md col-form-label">Nama Club *</label>';
            //     inputNamaClub += '<div class="input-group">';
            //     inputNamaClub += '<input type="hidden" class="form-control" name="id_club[]" value="">'; 
            //     inputNamaClub += '<input type="text" class="form-control form-input-container" value="" id="nama_club[]" name="multiple_nama_club[]" placeholder="Nama Club">';
            //     inputNamaClub += '</div>';
            //     inputNamaClub += '</div>';
            var inputNamaClub = '<div class="form-group form-input-container">';
                inputNamaClub += '<label for="inputNamaClub" class="col-md col-form-label">Nama Club *</label>';
                inputNamaClub += '<div class="input-group">';
                inputNamaClub += '<input type="hidden" class="form-control" name="id_club[]" value="">'; // Tambahkan kondisi isUpdate
                inputNamaClub += '<select class="form-select form-input-container" id="nama_club_multi_form" name="nama_club_multi_form[]">';
                inputNamaClub += '<option value="" selected disabled>.:: Pilih ::.</option>';
                // let arrayClub = jQuery.parseJSON("{{$club}}")
                let arrayClub = jQuery.parseJSON('{!!json_encode($club)!!}')
                $.each(arrayClub,(i,v)=>{
                    inputNamaClub += `<option value="${v.id_club}" >${v.nama_club}</option>`
                })                
                inputNamaClub += '</select>';
                inputNamaClub += '</div>';
                inputNamaClub += '</div>';

            var inputMain = '<div class="form-group form-input-container">';
                inputMain += '<label for="inputMain" class="col-md col-form-label">Main *</label>';
                inputMain += '<input type="text" class="form-control form-input-container score" value="" name="main_multiple_score_club[]" id="score_club' + generateId + '" placeholder="Score">';
                inputMain += '</div>';
                inputMain += '</div>';

            var inputMenang = '<div class="form-group form-input-container">';
                inputMenang += '<label for="inputMenang" class="col-md col-form-label">Menang *</label>';
                inputMenang += '<input type="text" class="form-control form-input-container score" value="" name="menang_multiple_score_club[]" id="score_club' + generateId + '" placeholder="Score">';
                inputMenang += '</div>';
                inputMenang += '</div>';

            var inputSeri = '<div class="form-group form-input-container">';
                inputSeri += '<label for="inputSeri" class="col-md col-form-label">Seri *</label>';
                inputSeri += '<input type="text" class="form-control form-input-container score" value="" name="seri_multiple_score_club[]" id="score_club' + generateId + '" placeholder="Score">';
                inputSeri += '</div>';
                inputSeri += '</div>';

            var inputKalah = '<div class="form-group form-input-container">';
                inputKalah += '<label for="inputKalah" class="col-md col-form-label">Kalah *</label>';
                inputKalah += '<input type="text" class="form-control form-input-container score" value="" name="kalah_multiple_score_club[]" id="score_club' + generateId + '" placeholder="Score">';
                inputKalah += '</div>';
                inputKalah += '</div>';

            var inputGoalMenang = '<div class="form-group form-input-container">';
                inputGoalMenang += '<label for="inputGoalMenang" class="col-md col-form-label">Goal Menang *</label>';
                inputGoalMenang += '<input type="text" class="form-control form-input-container score" value="" name="goal_menang_multiple_score_club[]" id="score_club' + generateId + '" placeholder="Score">';
                inputGoalMenang += '</div>';
                inputGoalMenang += '</div>';

            var inputGoalKalah = '<div class="form-group form-input-container">';
                inputGoalKalah += '<label for="inputGoalKalah" class="col-md col-form-label">Goal Kalah *</label>';
                inputGoalKalah += '<input type="text" class="form-control form-input-container score" value="" name="goal_kalah_multiple_score_club[]" id="score_club' + generateId + '" placeholder="Score">';
                inputGoalKalah += '</div>';
                inputGoalKalah += '</div>';

            var formContainer = '<div class="form-group form-input-container">';
                // if (data && data.id_club) {
                //     formContainer += `<button type="button" data-id="${data.id_club}" onclick="deleteForm(${generateId})" class="btn btn-danger remove-button" style="margin-top: 38px ">Delete</button>`;
                // } else {
                // }
                formContainer += '<button type="button" class="btn btn-danger remove-button" style="margin-top:  " ><i class="fas fa-trash"></button>';
                formContainer += '</div>';

            var rowContainer = '<div class="row form-row" id="'+generateId+'">';
                rowContainer += '<div class="col-md-3 form-input-container" name="nama_club[]" id="nama_club">';
                rowContainer += inputNamaClub;
                rowContainer += '</div>';
                rowContainer += '<div class="col-md-2 form-input-container" name="main_multiple_form[]" id="main_multiple_form">';
                rowContainer += inputMain;
                rowContainer += '<div class="col-md-1 form-input-container" name="menang_multiple_form[]" id="menang_multiple_form">';
                rowContainer += inputMenang;
                rowContainer += '<div class="col-md-1 form-input-container" name="seri_multiple_form[]" id="seri_multiple_form">';
                rowContainer += inputSeri;
                rowContainer += '<div class="col-md-1 form-input-container" name="kalah_multiple_form[]" id="kalah_multiple_form">';
                rowContainer += inputKalah;
                rowContainer += '<div class="col-md-2 form-input-container" name="goal_menang_multiple_form[]" id="goal_menang_multiple_form">';
                rowContainer += inputGoalMenang;
                rowContainer += '<div class="col-md-2 form-input-container" name="goal_kalah_multiple_form[]" id="goal_kalah_multiple_form">';
                rowContainer += inputGoalKalah;
                rowContainer += '</div>';
                // rowContainer += '<div class="col-md-2" name="btn_delete" id="delete">';
                // rowContainer += formContainer;
                // rowContainer += '</div>';
                rowContainer += '</div>';
        
                $('#multiple_input_form').append(rowContainer);

                $('#score_club_' + generateId).on('input', function () {
                    var input = this;
                    var value = input.value;

                    var unformattedValue= unformatRupiah(value);
                    var formattedValue = formatRupiah(unformattedValue);
                    input.value = formattedValue;
                });

            $('#' + generateId + ' .remove-button').click(function () {
                deleteForm(generateId);
        });
    }

    $("#add-baru").on('click', function(event) {
        addRowScore();
    });


    $('.score').on('input', function(e) {
        var inputValue = e.target.value;
        var sanitizedValue = inputValue.replace(/[^0-9]/g, '');
        e.target.value = sanitizedValue;
    });

    $('#button-submit').click(function() {
            console.log('save-data');
            var data = new FormData($('.form-save')[0]);
            $.ajax({
                data: data,
                url: "{{ route('klasemen-store') }}",
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
                        timer: 1500,
                        text: result.message,
                        confirmButtonColor: '#1A4237',
                    });
                    $('.other-page').fadeOut(function() {
                        $('.other-page').empty();
                        $('.main-page').fadeIn();
                        $('#datagrid').DataTable().ajax.reload();
                    });
                } else if (result.status === 'warning') { 
                    Swal.fire({
                        icon: 'warning',
                        title: 'Whoops!',
                        html: result.message, 
                        confirmButtonColor: '#1A4237',
                    });
                } else if (result.status === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Whoops!',
                        timer: 1500,
                        text: 'Failed to save data. Please try again.',
                        confirmButtonColor: '#1A4237',
                    });
                }
            });
        }); 

    function deleteForm(id) {
        // console.log(id);
            $("body").on('click', '.remove-button', function(event) {
            // $(this).parents('.form-input-container').remove();
            $(this).closest('.form-row').remove();
            return false;
        });
    }
})
</script>