$(document).ready(function(){
    $('.select2Modal').select2({
        placeholder: "Select",
        selectOnClose: true,
        width: 'resolve',
        dropdownParent: $('#verifikasiHPLModal')
    });
    $('#verify_btn').click(function(){
        $('#verifikasiHPLModal').modal('show');
    });
});
