$(document).ready(function(){

    $('.select2').select2();

    $('#perijinanTambahForm').on('submit',function(e){
        var form = this;
        if (form.checkValidity() === false) {
            // If the form is not valid, show validation errors
            e.preventDefault();
            e.stopPropagation();
            form.reportValidity();
        } else {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to submit this form?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: 'No, cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, submit the form
                    this.submit();
                }
            });
        }
     });

    $('#btn_pe').on('click',function(){
        var dataId = $(this).data('id');
        $('#id_company').val(dataId);

    });

    $('#checkETbtn').on('click',function(e){
        e.preventDefault();
        var data_nib = $('#nib').val();
        var data_npwp = $('#npwp').val();
        var data_net = $('#nomor_et').val();
        var date_nib = $('#date_nib').val();
        var date_et = $('#date_et').val();

        var formData = new FormData();
        formData.append('nib',data_nib);
        formData.append('npwp',data_npwp);
        formData.append('izin',data_net);
        formData.append('date_nib',date_nib);
        formData.append('date_et',date_et);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        // checkIzinETPE(data_nib,data_npwp,data_net,date_nib);
        checkIzinETPE(formData);
    });

    $('#checkPEbtn').on('click',function(){
        var data_nib = $('#nib').val();
        var data_npwp = $('#npwp').val();
        var data_npe = $('#nomor_pe').val();
        var date_nib = $('#date_nib').val();

        var file_pe = $('#file_pe')[0].files[0];

        var formData = new FormData();
        formData.append('file_pe',file_pe);
        formData.append('nib',data_nib);
        formData.append('npwp',data_npwp);
        formData.append('izin',data_npe);
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

        if($('#file_pe')[0].files.length < 1){
            swal.fire({
                title: "Perhatian",
                text: "Mohon Masukan File PE",
                icon: "warning"
            });
        } else {
            checkIzinETPE(formData);
        }
        // checkIzinETPE(data_nib,data_npwp,data_npe,date_nib);
    });

    $('#province_id').on('change',function(){
        const id = $(this).find(":selected").val();
        if(id) {
            $.ajax({
                url: '/ppbe/city/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#city_id').empty(); // Clear previous options
                    $('#city_id').append('<option value="">Pilih Kota/Kabupaten</option>'); // Add default option
                    $.each(response, function(key, value) {
                        $('#city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#city_id').empty(); // Clear if no city is selected
            $('#city_id').append('<option value="">Select District</option>'); // Add default option
        }
    });
});

// function checkIzinETPE(nib,npwp,izin,date_nib)
function checkIzinETPE(formData)
{
    Swal.fire({
        title: 'Sending...',
        text: 'Please wait while we process your request.',
        icon: 'info',
        allowOutsideClick: false, // Prevent closing by clicking outside
        didOpen: () => {
            Swal.showLoading(); // Show the loading spinner
        }
    });

    $.ajax({
        url:"/check/et_pe",
        method:"POST",
        data:formData  ,
        contentType: false,
        processData: false,
        success:function(response){
            Swal.close();
            const type = response.type;
            const kode = response.message.kode;
            const keterangan = response.message.keterangan;
            const result = response.result;
            const title = response.title;
            swal.fire({
                title: title,
                text: "Kode: "+kode +" - " + keterangan,
                icon: result
            }).then((result) => {
                if (result.isConfirmed) {
                    if ( type == "et")
                    {
                        $('.data_company').removeAttr('hidden');
                        $('.action_company').removeAttr('hidden');
                        $('.check_et_button').remove();
                        //isi value yang ke-disabled
                        $('#nib').prop('readonly',true);
                        $('#nomor_et').prop('readonly',true);
                        $('#npwp').prop('readonly',true);
                        $('#date_et').prop('readonly',true);
                        $('#date_nib').prop('readonly',true);
                        $('#company_name').prop('readonly',true);
                    } else {
                        location.reload(); // Ini akan merefresh halaman setelah konfirmasi
                    }
                }
            });
        },error:function(response){
            Swal.close();
            const kode = response.responseJSON.kode;
            const result = response.responseJSON.result;
            const title = response.responseJSON.title;
            const message = response.responseJSON.message;

            if(typeof kode === "undefined") {
                swal.fire({
                    title: title,
                    text: message,
                    icon: result
                });
            } else {
                swal.fire({
                    title: title,
                    text: kode + " - " +message,
                    icon: result
                });
            }
        }
    });
}

let listwaktu = document.getElementsByClassName('form_date_picker');
$('.form_date_picker').each(function(index, element){
    let datepicker = new Datepicker(element,{
        format:"yyyy-mm-dd",
        todayHighLight:true,
        autohide:true,
        showOnFocus:true,
    });
})
