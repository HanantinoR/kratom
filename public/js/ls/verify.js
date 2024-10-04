$(document).ready(function(){
    $('.select2').select2({
        placeholder: "Select",
        selectOnClose: true,
        width: 'resolve',
        dropdownParent: $('#verifyLSModal')

    });
    $('#verify_ls_btn').click(function(){
        $('#verifyLSModal').modal('show');
    });
});
