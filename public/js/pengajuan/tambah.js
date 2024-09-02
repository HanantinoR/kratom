$(document).ready(function(){
    $('.company_name').select2();
    $('.fob_currency').select2();
    $('.office_id').select2();
    $('.type_kemasan').select2();

});
// querySelector('input[name="inspection_date"]');
    let listwaktu = document.getElementsByClassName('datePicker');

    // for(let waktu of listwaktu)
    // {
    //     console.log(waktu);
        // let datepicker = new Datepicker(waktu,{
        //     format:"yyyy-mm-dd",
        //     todayHighLight:true,
        //     autohide:true,
        //     showOnFocus:true,
        // });
    // }

    $('.datePicker').each(function(index, element){
        let datepicker = new Datepicker(element,{
            format:"yyyy-mm-dd",
            todayHighLight:true,
            autohide:true,
            showOnFocus:true,
        });
    })
