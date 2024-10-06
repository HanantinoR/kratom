$(document).ready(function(){
    $('.company_id').select2();
    $('.fob_currency').select2();
    $('.office_id').select2();
    $('.type_kemasan').select2();
    $('.form_select2').select2();
    $('.select2').select2();
    $('.dropify').dropify({
        messages: {
            'default': '',
            'replace': 'Drag and drop or click to replace',
        },
    });

    $('#company_id').change(function(){
        const company_id = $(this).find(":selected").val();
        $.ajax({
            url:"/data_company/"+company_id,
            method:"GET",
            data:company_id,
            success:function(response){
                $('#company_id').val(response.company.id);
                $('#nib').val(response.company.nib);
                $('#nomor_et').val(response.company.nomor_et);
                $('#nomor_pe').val(response.company.nomor_pe);
                $('#date_nib').val(response.company.date_nib);
                $('#date_et').val(response.company.date_et);
                $('#date_pe').val(response.company.date_pe);
                $('#company_email').val(response.company.company_email);
                $('#company_telp').val(response.company.company_telp);
                $('#company_hp').val(response.company.company_hp);
                $('#company_npwp').val(response.company.company_npwp);
                $('#company_address').text(response.company.company_address);
                $('#company_pic').val(response.company.company_pic);
                $('#company_position').val(response.company.company_position);
                $('#company_quota_remaining').val(response.quota.company_quota_remaining);
                $('#company_quota_used').val(response.quota.company_quota_used);

            },
        });
    });
    var count = 0
    $('.btn_tambah').click(function(){
        count = count+1;
        $("#form_barang tbody").append(`
            <tr>
                <td> <input type="text" name="barang[`+count+ `][nomor_hs]" class="form-control text-black " id="barang[`+count+`][nomor_hs]" placeholder="Nomor HS" required></td>
                <td> <input type="text" name="barang[`+count+ `][uraian]" class="form-control text-black " id="barang[`+count+`][uraian]" placeholder="Uraian" required></td>
                <td> <input type="text" name="barang[`+count+ `][jumlah_total]" class="form-control text-black " id="barang[`+count+`][jumlah_total]" placeholder="Jumlah Total" required></td>
                <td> <input type="text" name="barang[`+count+ `][nilai_fob]" class="form-control text-black calculateFOB" id="barang[`+count+`][nilai_fob]" placeholder="Nilai FOB" required></td>
                <td> <input type="text" name="barang[`+count+ `][per_kilogram]" class="form-control text-black calculateFOB" id="barang[`+count+`][per_kilogram]" placeholder="perKilo" required></td>
                <td>
                    <button class="btn btn-sm btn-icon btn-danger rmv_tambah" id="" type="button">
                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path>
                        </svg>
                    </button>
                </td>
            </tr>
        `)
    })

    $("#form_barang").on('click', '.rmv_tambah', function() {
        $(this).parent().parent().remove();

        loopCalculateFOB();
    });


    $("#form_barang").on('change','.calculateFOB',function(){
        loopCalculateFOB();
    });

    function  loopCalculateFOB()
    {
        let totalFOB = 0;
        $('.calculateFOB').each(function(){
            const valueFOB = $(this).val() ? parseFloat($(this).val().replace(/[^\d.]+/g, '')) : 0
            totalFOB = totalFOB + valueFOB
        });
        $('#fob_total').val(totalFOB);
    }

    $('#flexCheckDefault3').on('change',function(){
        if($(this).is(':checked')){
            $('#btn-send').removeAttr('disabled');
        } else {
            $('#btn-send').attr('disabled','disabled');
        }
    });

    $('#send_btn').on('click',function(e){
        $('#update_btn').attr("disabled",false);
        e.preventDefault();
        Swal.fire({
            title: 'Apakah Anda Yakin',
            text: "Anda ingin mengajukan Form Ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, submit it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#form_edit').submit();
            }
        });
    });
});


// querySelector('input[name="inspection_date"]');
    let listwaktu = document.getElementsByClassName('datePicker');
    $('.datePicker').each(function(index, element){
        let datepicker = new Datepicker(element,{
            format:"yyyy-mm-dd",
            todayHighLight:true,
            autohide:true,
            showOnFocus:true,
        });
    })
