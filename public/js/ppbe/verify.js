$(document).ready(function(){
    $('.fob_currency').select2();
    $('.office_id').select2();
    $('.type_kemasan').select2();
    $('.form_select2').select2();
    $('.select2').select2();


    $('#flexCheckDefault3').on('change',function(){
        if($(this).is(':checked')){
            $('#verify-btn').removeAttr('disabled');
        } else {
            $('#verify-btn').attr('disabled','disabled');
        }
    });

    let file_nib = false;
    let file_invoice = false;
    let file_packing_list = false;

    $('#file_nib_check,#file_invoice_check,#file_packing_list_check').change(function(){
        file_nib = $('#file_nib_check').is(':checked');
        file_invoice = $('#file_invoice_check').is(':checked');
        file_packing_list = $('#file_packing_list_check').is(':checked');

        updateHiddenInput();
    });

    function updateHiddenInput() {
        const checkboxData = {
            NIB:file_nib,
            Invoice:file_invoice,
            PackingList:file_packing_list
        }
    }

    $('#verify-btn').on('click',function(e){
        validateCheckboxes();
    });

    function validateCheckboxes(){
        const allChecked = file_nib && file_invoice && file_packing_list ;
        console.log(allChecked);
        if(!allChecked) {
            $('#verifikasiModal').modal('hide');
            Swal.fire({
                title: 'Tolong Check List',
                text: "Mohon untuk check kelengkapan dokument",
                icon: 'error',
            });
        } else {
            let dataTrue = {
                nib:file_nib ? "on":"off",
                invoince:file_invoice ? "on":"off",
                packing_list:file_packing_list ? "on":"off"
            };

            $('#verifikasiModal').modal('show');
            $('#checkbox_data').val(JSON.stringify(dataTrue));
        }
    }

    $('#verifyBtn').on('click',function(e){
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
                $('#form_approval').submit();
            }
        });
    });
});
