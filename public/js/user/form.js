$(document).ready(function(){
    $('.select2').select2();

    // $("#company_id").on("change",function(){
    //     $('.branch_office').removeAttr('hidden');
    // });
    $('#inspection_province_id').on('change',function(){
        const id = $(this).find(":selected").val();
        if(id) {
            $.ajax({
                url: '/ppbe/city/' + id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $('#inspection_city_id').empty(); // Clear previous options
                    $('#inspection_city_id').append('<option value="">Pilih Kota/Kabupaten</option>'); // Add default option
                    $.each(response, function(key, value) {
                        $('#inspection_city_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
        } else {
            $('#inspection_city_id').empty(); // Clear if no city is selected
            $('#inspection_city_id').append('<option value="">Select District</option>'); // Add default option
        }
    });
});
