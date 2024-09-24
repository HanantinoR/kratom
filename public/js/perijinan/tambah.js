$(document).ready(function(){
     $('.dropify').dropify({
        messages: {
            'default': '',
            'replace': 'Drag and drop or click to replace',
        },
     });


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

        // $('#exampleModal').show();

        $('#id_company').val(dataId);

    });

    $('#exampleModal').on('show.bs.modal', function (event) {
        // $('#date_modal_pe').each(function(index, element){
        //     let datepicker = new Datepicker(element,{
        //         format:"yyyy-mm-dd",
        //         todayHighLight:true,
        //         autohide:true,
        //         showOnFocus:true,
        //     });
        // });
    });
});

let listwaktu = document.getElementsByClassName('form_date_picker');
$('.form_date_picker').each(function(index, element){
    let datepicker = new Datepicker(element,{
        format:"yyyy-mm-dd",
        todayHighLight:true,
        autohide:true,
        showOnFocus:true,
    });
})