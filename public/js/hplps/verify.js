$(document).ready(function(){
    $('.select2').select2({
        placeholder: "Select",
        selectOnClose: true,
        width: 'resolve',
        dropdownParent: $('#verifikasiHPLModal')

    });
    $('#verify_btn').click(function(){
        $('#verifikasiHPLModal').modal('show');
    });
});
