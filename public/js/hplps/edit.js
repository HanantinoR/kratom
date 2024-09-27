$(document).ready(function(){
    $('.edit_readonly').on('click',function(){
        var value_btn = $(this).attr('name');
        if(value_btn === "merk_btn")
        {
            $('#merk').prop('readonly',false);
        } else if(value_btn === 'packing_btn')
        {
            $('#packing_total').prop('readonly',false);
        } else if(value_btn === 'inspection_btn') {
            $('#inspection_address').prop('readonly',false);
        } else {
            $('#stuffing_address').prop('readonly',false);
        }
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

    $("#form_barang").on('change', '.calculateFOB', function() {
        loopCalculateFOB()
    });

    $("#form_barang").on('click', '.rmv_tambah', function() {
        $(this).parent().parent().remove();

        loopCalculateFOB();
    });

    function loopCalculateFOB()
    {
        let totalFOB = 0;
        $('.calculateFOB').each(function(){
            const valueFOB = $(this).val() ? parseFloat($(this).val().replace(/[^\d.]+/g, '')) : 0
            totalFOB = totalFOB + valueFOB
        });
        $('#fob_total_hpl').val(totalFOB);
    }

    var usage_bcops = 0;
    $('.btn_tambah_usage').click(function(){
        usage_bcops += 1;
        $('#form_bcops_usage tbody').append(`
            <tr>
                <td><input type="text" class="form-control text-black" name="usage[`+usage_bcops+`][type]"  id="usage[`+usage_bcops+`][type]"/></td>
                <td>
                    <div class="row">
                        <div class="col-lg-2 mt-2">No. Seri</div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control text-black" name="usage[`+usage_bcops+`][series]"  id="usage[`+usage_bcops+`][series]"/>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" class="form-control text-black" name="usage[`+usage_bcops+`][init]"  id="usage[`+usage_bcops+`][init]"/>
                        </div>
                        <div class="col-lg-1 mt-2">
                            S/D
                        </div>
                        <div class="col-lg-3">
                           <input type="text" class="form-control text-black" name="usage[`+usage_bcops+`][final]"  id="usage[`+usage_bcops+`][final]"/>
                        </div>
                    </div>
                </td>
                <td>
                    <button class="btn btn-sm btn-icon btn-danger rmv_tambah_usage" id="" type="button">
                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path>
                        </svg>
                    </button>
                </td>
            </tr>
        `);
    });

    $("#form_bcops_usage").on('click', '.rmv_tambah_usage', function() {
        usage_bcops -= 1;
        $(this).parent().parent().remove();
        loopCalculateFOB();
    });

    var hpl_field = 0;
    $('.btn_tambah_hplps').click(function(){
        hpl_field += 1;
        $('#form_pengapalan tbody').append(`
            <tr>
                <td class="p-1"> <input type="text" class="form-control text-black" name="memorizations[`+hpl_field+`][type]"  id="memorization[`+hpl_field+`][type]"/></td>
                <td class="p-1"> <input type="text" class="form-control text-black" name="memorizations[`+hpl_field+`][create_number]"  id="memorization[`+hpl_field+`][create_number]"/></td>
                <td class="p-1"> <input type="text" class="form-control text-black" name="memorizations[`+hpl_field+`][create_type]"  id="memorization[`+hpl_field+`][create_type]"/></td>
                <td class="p-1"> <input type="text" class="form-control text-black" name="memorizations[`+hpl_field+`][size]"  id="memorization[`+hpl_field+`][size]"/></td>
                <td class="p-1">
                    <div class="row ">
                        <div class="col-md-12 col-lg-12 ">
                            <div class="row ">
                                <div class="col-md-1 col-lg-1 me-1">
                                    <div class="checkbox-wrapper-input">
                                        <input type="checkbox" id="check_segel[`+hpl_field+`]" name="check_segel[`+hpl_field+`]" data-id=`+hpl_field+` class="checkbox_segel"/>
                                        <label for="check_segel[`+hpl_field+`]" class="check-box mt-2">
                                    </div>
                                </div>
                                <div class="col-md-5 col-lg-5 pe-1">
                                    <input type="text" class="form-control text-black segel-`+hpl_field+`" name="memorizations[`+hpl_field+`][series]"  id="memorization[`+hpl_field+`][series]"/>
                                </div>
                                <div class="col-md-5 col-lg-5 ps-1">
                                    <input type="text" class="form-control text-black segel-`+hpl_field+`" name="memorizations[`+hpl_field+`][series_init]"  id="memorization[`+hpl_field+`][series_init]"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="p-1">
                    <div class="row">
                        <div class="col-md-12 col-lg-12">
                            <div class="row">
                                <div class="col-md-6 col-lg-6 pe-1">
                                    <input type="text" class="form-control text-black" name="memorizations[`+hpl_field+`][series_total]"  id="memorization[`+hpl_field+`][series_total]"/>
                                </div>
                                <div class="col-md-6 col-lg-6 ps-1">
                                    <input type="text" class="form-control text-black" name="memorizations[`+hpl_field+`][series_type]"  id="memorization[`+hpl_field+`][series_type]"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="">
                    <div class="row">
                        <label for="memorizations[`+hpl_field+`][red_series]">TPS Merah</label>
                        <div class="red_field" id="red_field_`+hpl_field+`">
                            <div class="row">
                                <div class="col-md-3 p-1">
                                    <input type="text" class="form-control text-black tps_`+hpl_field+`" name=memorizations[`+hpl_field+`][red_series][0]"  id="memorizations[`+hpl_field+`][red_series][0]" disabled/>
                                </div>
                                <div class="col-md-4 p-1">
                                    <input type="text" class="form-control text-black tps_`+hpl_field+`" name=memorizations[`+hpl_field+`][red_init][0]"  id="memorizations[`+hpl_field+`][red_init][0]" disabled/>
                                </div>
                                <div class="col-md-4 p-1">
                                    <input type="text" class="form-control text-black tps_`+hpl_field+`" name=memorizations[`+hpl_field+`][red_final][0]"  id="memorizations[`+hpl_field+`][red_final][0]" disabled/>
                                </div>
                                <div class="col-md-1">
                                    <button  type="button" class="btn btn-sm btn-icon btn-warning btn_tps_merah_`+hpl_field+` mt-2" id="btn_tps_merah_`+hpl_field+`" name="btn_tps_merah[`+hpl_field+`]" target="`+hpl_field+`" disabled>
                                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="memorizations[`+hpl_field+`][green_series]">TPS Hijau</label>
                        <div class="green_field" id="green_field_`+hpl_field+`">
                            <div class="row">
                                <div class="col-md-3 p-1">
                                    <input type="text" class="form-control text-black tps_`+hpl_field+`" name=memorizations[`+hpl_field+`][green_series][0]"  id="memorizations[`+hpl_field+`][green_series][0]" disabled/>
                                </div>
                                <div class="col-md-4 p-1">
                                    <input type="text" class="form-control text-black tps_`+hpl_field+`" name=memorizations[`+hpl_field+`][green_init][0]"  id="memorizations[`+hpl_field+`][green_init][0]" disabled/>
                                </div>
                                <div class="col-md-4 p-1">
                                    <input type="text" class="form-control text-black tps_`+hpl_field+`" name=memorizations[`+hpl_field+`][green_final][0]"  id="memorizations[`+hpl_field+`][green_final][0]" disabled/>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm btn-icon btn-warning btn_tps_hijau_`+hpl_field+` mt-2" id="btn_tps_hijau_`+hpl_field+`"  name="btn_tps_hijau[`+hpl_field+`]" target="`+hpl_field+`" disabled>
                                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label for="memorizations[`+hpl_field+`][thread_seal_series]">Thread Seal</label>
                        <div class="thread_field" id="thread_field_`+hpl_field+`">
                            <div class="row">
                                <div class="col-md-3 p-1">
                                    <input type="text" class="form-control text-black tps_`+hpl_field+`" name=memorizations[`+hpl_field+`][thread_seal_series][0]"  id="memorizations[`+hpl_field+`][thread_seal_series][0]" disabled/>
                                </div>
                                <div class="col-md-4 p-1">
                                    <input type="text" class="form-control text-black tps_`+hpl_field+`" name=memorizations[`+hpl_field+`][thread_seal_init][0]"  id="memorizations[`+hpl_field+`][thread_seal_init][0]" disabled/>
                                </div>
                                <div class="col-md-4 p-1">
                                    <input type="text" class="form-control text-black tps_`+hpl_field+`" name=memorizations[`+hpl_field+`][thread_seal_final][0]"  id="memorizations[`+hpl_field+`][thread_seal_final][0]" disabled/>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-sm btn-icon btn-warning  btn_thread_seal_`+hpl_field+` mt-2" id="btn_thread_seal_`+hpl_field+`" name="btn_thread_seal[`+hpl_field+`]" target="`+hpl_field+`" disabled>
                                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="">
                    <button class="btn btn-sm btn-icon btn-danger rmv_tambah_hpl" id="" type="button">
                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path>
                        </svg>
                    </button>
                </td>
            </tr>
        `);
        $('.checkbox_segel').change(function(){
            check_id = parseInt($(this).attr("data-id"));
            if($(this).is(':checked')){
                $('.segel-'+check_id).prop('disabled',true);
                $('.tps_'+check_id).prop('disabled',false);
                $('.btn_tps_merah_'+check_id).removeAttr('disabled');
                $('.btn_tps_hijau_'+check_id).removeAttr('disabled');
                $('.btn_thread_seal_'+check_id).removeAttr('disabled');
            } else {
                $('.segel-'+check_id).prop('disabled',false);
                $('.tps_'+check_id).prop('disabled',true);
                $('.btn_tps_merah_'+check_id).attr('disabled',true);
                $('.btn_tps_hijau_'+check_id).attr('disabled',true);
                $('.btn_thread_seal_'+check_id).attr('disabled',true);
            }
        });
        var tps_red = 0;
        $(`[name="btn_tps_merah[`+hpl_field+`]"]`).click(function(){
            var target =$(this).attr('target');
            tps_red += 1;
            $('#red_field_'+target).append(`
                <div class="row">
                    <div class="col-md-3 p-1">
                        <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][red_series][`+tps_red+`]"  id="memorizations[`+hpl_field+`][red_series][`+tps_red+`]"/>
                    </div>
                    <div class="col-md-4 p-1">
                        <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][red_init][`+tps_red+`]"  id="memorizations[`+hpl_field+`][red_init][`+tps_red+`]"/>
                    </div>
                    <div class="col-md-4 p-1">
                        <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][red_final][`+tps_red+`]"  id="memorizations[`+hpl_field+`][red_final][`+tps_red+`]"/>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-sm btn-icon btn-danger rmv_red_tps mt-2" id="" type="button">
                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `);
        });

        var tps_green = 0;
        $(`[name="btn_tps_hijau[`+hpl_field+`]"]`).click(function(){
            var target =$(this).attr('target');
            tps_green += 1;
            $('#green_field_'+target).append(`
                <div class="row">
                    <div class="col-md-3 p-1">
                        <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][green_series][`+tps_green+`]"  id="memorizations[`+hpl_field+`][green_series][`+tps_green+`]"/>
                    </div>
                    <div class="col-md-4 p-1">
                        <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][green_init][`+tps_green+`]"  id="memorizations[`+hpl_field+`][green_init][`+tps_green+`]"/>
                    </div>
                    <div class="col-md-4 p-1">
                        <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][green_final][`+tps_green+`]"  id="memorizations[`+hpl_field+`][green_final][`+tps_green+`]"/>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-sm btn-icon btn-danger rmv_green_tps mt-2" id="" type="button">
                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `);
        });

        var thread_seal = 0;
        $(`[name="btn_thread_seal[`+hpl_field+`]"]`).click(function(){
            var target =$(this).attr('target');
            thread_seal += 1;
            $('#thread_field_'+target).append(`
                <div class="row">
                    <div class="col-md-3 p-1">
                        <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][thread_seal_series][`+thread_seal+`]"  id="memorizations[`+hpl_field+`][thread_seal_series][`+thread_seal+`]"/>
                    </div>
                    <div class="col-md-4 p-1">
                        <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][thread_seal_init][`+thread_seal+`]"  id="memorizations[`+hpl_field+`][thread_seal_init][`+thread_seal+`]"/>
                    </div>
                    <div class="col-md-4 p-1">
                        <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][thread_seal_final][`+thread_seal+`]"  id="memorizations[`+hpl_field+`][thread_seal_final][`+thread_seal+`]"/>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-sm btn-icon btn-danger rmv_thread_seal mt-2" id="" type="button">
                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `);
        });

        $(".red_field").on('click', '.rmv_red_tps', function() {
            tps_red -= 1;
            $(this).parent().parent().remove();
        });

        $(".green_field").on('click', '.rmv_green_tps', function() {
            tps_green -= 1;
            $(this).parent().parent().remove();
        });

        $(".thread_field").on('click', '.rmv_thread_seal', function() {
            thread_seal -= 1;
            $(this).parent().parent().remove();
        });

    });

    var tps_red = 0;
    $('#btn_tps_merah_0').click(function(){
        tps_red += 1;
        $('#red_field_0').append(`
            <div class="row">
                <div class="col-md-3 p-1">
                    <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][red_series][`+tps_red+`]"  id="memorizations[`+hpl_field+`][red_series][`+tps_red+`]"/>
                </div>
                <div class="col-md-4 p-1">
                    <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][red_init][`+tps_red+`]"  id="memorizations[`+hpl_field+`][red_init][`+tps_red+`]"/>
                </div>
                <div class="col-md-4 p-1">
                    <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][red_final][`+tps_red+`]"  id="memorizations[`+hpl_field+`][red_final][`+tps_red+`]"/>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-sm btn-icon btn-danger rmv_red_tps mt-2" id="" type="button">
                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `);
    });

    var tps_green = 0;
    $('#btn_tps_hijau_0').click(function(){
        tps_green += 1;
        $('#green_field_0').append(`
            <div class="row">
                <div class="col-md-3 p-1">
                    <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][green_series][`+tps_green+`]"  id="memorizations[`+hpl_field+`][green_series][`+tps_green+`]"/>
                </div>
                <div class="col-md-4 p-1">
                    <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][green_init][`+tps_green+`]"  id="memorizations[`+hpl_field+`][green_init][`+tps_green+`]"/>
                </div>
                <div class="col-md-4 p-1">
                    <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][green_final][`+tps_green+`]"  id="memorizations[`+hpl_field+`][green_final][`+tps_green+`]"/>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-sm btn-icon btn-danger rmv_green_tps mt-2" id="" type="button">
                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `);
    });

    var thread_seal = 0;
    $('#btn_thread_seal_0').click(function(){
        thread_seal += 1;
        $('#thread_field_0').append(`
            <div class="row">
                <div class="col-md-3 p-1">
                    <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][thread_seal_series][`+thread_seal+`]"  id="memorizations[`+hpl_field+`][thread_seal_series][`+thread_seal+`]"/>
                </div>
                <div class="col-md-4 p-1">
                    <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][thread_seal_init][`+thread_seal+`]"  id="memorizations[`+hpl_field+`][thread_seal_init][`+thread_seal+`]"/>
                </div>
                <div class="col-md-4 p-1">
                    <input type="text" class="form-control text-black" name=memorizations[`+hpl_field+`][thread_seal_final][`+thread_seal+`]"  id="memorizations[`+hpl_field+`][thread_seal_final][`+thread_seal+`]"/>
                </div>
                <div class="col-md-1">
                    <button class="btn btn-sm btn-icon btn-danger rmv_thread_seal mt-2" id="" type="button">
                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `);
    });

    $(".red_field").on('click', '.rmv_red_tps', function() {
        tps_red -= 1;
        $(this).parent().parent().remove();
    });

    $(".green_field").on('click', '.rmv_green_tps', function() {
        tps_green -= 1;
        $(this).parent().parent().remove();
    });

    $(".thread_field").on('click', '.rmv_thread_seal', function() {
        thread_seal -= 1;
        $(this).parent().parent().remove();
    });

    $("#form_pengapalan").on('click', '.rmv_tambah_hpl', function() {
        hpl_field -= 1;
        $(this).parent().parent().remove();
        loopCalculateFOB();
    });

    $('.checkbox_segel').change(function(){
        check_id = parseInt($(this).attr("data-id"));
        if($(this).is(':checked')){
            $('.segel-'+check_id).prop('disabled',true);
            $('.tps_'+check_id).prop('disabled',false);
            $('.btn_tps_merah_'+check_id).removeAttr('disabled');
            $('.btn_tps_hijau_'+check_id).removeAttr('disabled');
            $('.btn_thread_seal_'+check_id).removeAttr('disabled');
        } else {
            $('.segel-'+check_id).prop('disabled',false);
            $('.tps_'+check_id).prop('disabled',true);
            $('.btn_tps_merah_'+check_id).attr('disabled',true);
            $('.btn_tps_hijau_'+check_id).attr('disabled',true);
            $('.btn_thread_seal_'+check_id).attr('disabled',true);
        }
    });

    //check apakah kondisi sudah terpenuhi
    var check_merk = false;
    var check_packing = false;
    var check_inspection = false;

    $('#check_merk,#check_packing,#check_inspection').change(function(){
        check_merk = $('#check_merk').is(':checked');
        check_packing = $('#check_packing').is(':checked');
        check_inspection = $('#check_inspection').is(':checked');

        updateHiddenInput();
    });

    function updateHiddenInput() {
        const checkboxData = {
            Merk:check_merk,
            Packing:check_packing,
            Inspection:check_inspection
        }
        console.log(JSON.stringify(checkboxData));
    }

    $('#send_hpl_btn').on('click',function(e){
        validateCheckboxes();
    });

    function validateCheckboxes(){
        const allChecked = check_merk && check_packing && check_inspection ;
        console.log(allChecked);
        if(!allChecked) {
            Swal.fire({
                title: 'Tolong Check List',
                text: "Mohon untuk check validasi Form",
                icon: 'error',
            });
        } else {
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
        }
    }

});


$('.dateControl').each(function(index, element){
    let datepicker = new Datepicker(element,{
        // enableTime: true,
        // dateFormat: "yyyy-mm-dd HH:i",
        // time_24hr: true,
        format:"yyyy-mm-dd hh:mm",
        todayHighLight:true,
        autohide:true,
        showOnFocus:true,
    });
});


document.addEventListener('DOMContentLoaded', function() {
    Dropzone.options.fileUpload = {
        url: '/pemeriksaan/upload',
        method:"POST",
        paramName: 'files', // The name that will be used to transfer the file
        maxFilesize: 4, // MB
        acceptedFiles: ".pdf,.jpg,.jpeg,.png",
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        init: function() {
            this.on("success", function(file, response) {
                // Optionally, you can handle the response here if needed
                console.log(response);
            });

            this.on("addedfile", function(file) {
                // Create a preview for the image
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement("img");
                        img.src = e.target.result;
                        img.style.width = "100%"; // Set a fixed width or any styling
                        img.style.height = "auto";

                        // Append the image to the Dropzone preview element
                        const previewElement = Dropzone.createElement('<div class="dz-preview dz-file-preview"></div>');
                        previewElement.appendChild(img);
                        file.previewElement.appendChild(previewElement);
                    };
                    reader.readAsDataURL(file);
                }
            });
        },
        error: function(file, response) {
            console.log(response);
        }
    };
});

