<x-app-layout :assets="$assets ?? []">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="header-title text-center pb-3">
                        <h3 class="card-title text-white">
                            DETAIL LAPORAN SURVEYOR
                        </h3>
                    </div>
                    {{-- <div class="card-action">
                        <a href="{{route('ls.daftar')}}" class="btn btn-sm btn-primary" role="button">Back</a>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <h5 class="mb-4 text-black">A. Kantor Penerbit</h5>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="nomor_ls">Nomor LS: <span class="text-danger">*</span></label>
                                {{ Form::text('nomor_ls',$ls->code_above, ['class' => 'form-control text-black','id'=>'nomor_ls' ,'placeholder' => 'Nomor LS', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="tanggal_ls">Tanggal LS: <span class="text-danger">*</span></label>
                                {{ Form::text('tanggal_ls',$ls->created_at, ['class' => 'form-control text-black','id'=>'tanggal_ls' ,'placeholder' => 'Tanggal LS', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="nomor_ppbe">Nomor PPBE: <span class="text-danger">*</span></label>
                                {{ Form::text('nomor_ppbe', $ls->code, ['class' => 'form-control text-black','id'=>'nomor_ppbe' ,'placeholder' => 'Nomor PPBE', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="date_ppbe">Tanggal PPBE: <span class="text-danger">*</span></label>
                                {{ Form::text('date_ppbe', $ls->code_date, ['class' => 'form-control text-black datePicker','id'=>'date_ppbe' ,'placeholder' => 'Tanggal PPBE', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="office_id">Kantor Cabang: <span class="text-danger">*</span></label>
                                <select name="office_id" class="form-control select2 text-black" id="office_id" placeholder="Kantor Cabang" disabled>
                                    <option value="">Pilih Kantor Cabang</option>
                                    @foreach($office_branch as $key => $office)
                                        <option value="{{ $office->id }}" {{ $ls->inspection_office_id == $office->id ? 'selected' : '' }}>
                                            {{ $office->name }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- {{ Form::text('office_id', null, ['class' => 'form-control text-black','id'=>'office_id' ,'placeholder' => 'Kantor Cabang', 'readonly']) }} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h5 class="card-title text-black">
                            B. Pernyataan Eksportir
                        </h5>
                    </div>
                    <div class="card-action"></div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <h6 class="text-black text-small mb-3">EKSPORTIR (NPWP, Nama, Alamat)</h6>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="company_id">Nama Perusahaan: <span class="text-danger">*</span></label>
                                {{ Form::text('company_id', null, ['class' => 'form-control text-black','id'=>'company_id' ,'placeholder' => 'Perusahaan', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="company_npwp">NPWP: <span class="text-danger">*</span></label>
                                {{ Form::text('company_npwp', null, ['class' => 'form-control text-black','id'=>'company_npwp' ,'placeholder' => 'NPWP', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="company_address">Alamat: <span class="text-danger">*</span></label>
                                {{ Form::textarea('company_address', null, ['class' => 'form-control text-black','id'=>'company_address' ,'placeholder' => 'Alamat', 'readonly', 'rows'=>'2']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">

                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="inspection_start">Pemeriksaan Awal: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_start', null, ['class' => 'form-control text-black','id'=>'inspection_start' ,'placeholder' => 'Pemeriksaan Awal', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="">Tanggal Pemeriksaan: <span class="text-danger">*</span></label>
                                {{ Form::text('date_inspection_start', null, ['class' => 'form-control text-black','id'=>'date_inspection_start' ,'placeholder' => 'Tanggal', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="">Pemeriksaan Akhir: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_end', null, ['class' => 'form-control text-black','id'=>'inspection_end' ,'placeholder' => 'Pemeriksaan Akhir', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="">Tanggal Pemeriksaan: <span class="text-danger">*</span></label>
                                {{ Form::text('date_inspection_end', null, ['class' => 'form-control text-black','id'=>'date_inspection_end' ,'placeholder' => 'Tanggal', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="nib">NIB: <span class="text-danger">*</span></label>
                                {{ Form::text('nib', null, ['class' => 'form-control text-black','id'=>'nib' ,'placeholder' => 'NIB', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="date_nib">Tanggal NIB: <span class="text-danger">*</span></label>
                                {{ Form::text('date_nib', null, ['class' => 'form-control text-black','id'=>'date_nib' ,'placeholder' => 'Tanggal NIB', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="nomor_et">Nomor ET: <span class="text-danger">*</span></label>
                                {{ Form::text('nomor_et', null, ['class' => 'form-control text-black','id'=>'nomor_et' ,'placeholder' => 'ET', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="date_et">Tanggal ET: <span class="text-danger">*</span></label>
                                {{ Form::text('date_et', null, ['class' => 'form-control text-black','id'=>'date_et' ,'placeholder' => 'Tanggal NIB', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="nomor_pe">Nomor PE: <span class="text-danger">*</span></label>
                                {{ Form::text('nomor_pe', null, ['class' => 'form-control text-black','id'=>'nomor_pe' ,'placeholder' => 'PE', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="date_pe">Tanggal PE: <span class="text-danger">*</span></label>
                                {{ Form::text('date_pe', null, ['class' => 'form-control text-black','id'=>'date_pe' ,'placeholder' => 'Tanggal NIB', 'readonly']) }}
                            </div>
                        </div>
                        <hr>
                        <h6 class="text-black text-small mb-3">IMPORTIR (Nama, Alamat, Kode Negara)</h6>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="buyer_name">Nama Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::text('buyer_name', old('buyer_name'), ['class' => 'form-control text-black','id'=>'buyer_name' ,'placeholder' => 'Nama Pembeli', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="invoice_number">Nomor Invoice: <span class="text-danger">*</span></label>
                                {{ Form::text('invoice_number', old('invoice_number'), ['class' => 'form-control text-black','id'=>'invoice_number' ,'placeholder' => 'Nomor Invoice', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="buyer_address">Alamat Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::textarea('buyer_address', old('buyer_address'), ['class' => 'form-control text-black','id'=>'buyer_address' ,'placeholder' => 'Alamat Pembeli', 'readonly', 'rows'=>'2']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="invoice_date">Tanggal Invoice: <span class="text-danger">*</span></label>
                                {{ Form::text('invoice_date', old('invoice_date'), ['class' => 'form-control text-black datePicker','id'=>'invoice_date' ,'placeholder' => 'Tanggal Invoice', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="buyer_country">Negara Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::text('buyer_country', old('buyer_country'), ['class' => 'form-control text-black','id'=>'buyer_country' ,'placeholder' => 'Negara', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="packing_list_number">Nomor Packing List <span class="text-danger">*</span></label>
                                {{ Form::text('packing_list_number', old('packing_list_number'), ['class' => 'form-control text-black','id'=>'packing_list_number' ,'placeholder' => 'Nomor Packing List', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12"></div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="packing_list_date">Tanggal Packing List <span class="text-danger">*</span></label>
                                {{ Form::text('packing_list_date', old('packing_list_date'), ['class' => 'form-control text-black datePicker','id'=>'packing_list_date' ,'placeholder' => 'Tanggal Packing List', 'readonly']) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                {{-- disini nanti di looping --}}
                                <label class="form-label" for="ls_goods">Uraian Barang <span class="text-danger">*</span></label>
                                {{ Form::textarea('ls_goods', old('ls_goods'), ['class' => 'form-control text-black datePicker','id'=>'ls_goods' ,'placeholder' => 'Uraian Barang', 'readonly','rows'=>'2']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <div class="row mb-2">
                                    <label class="form-label" for="fob_total">Nilai FOB <span class="text-danger">*</span></label>
                                    {{ Form::text('fob_total', old('fob_total'), ['class' => 'form-control text-black datePicker','id'=>'fob_total' ,'placeholder' => 'FOB', 'readonly']) }}
                                </div>
                                <div class="row mb-2">
                                    <label class="form-label" for="fob_currency">Valuta <span class="text-danger">*</span></label>
                                    {{ Form::text('fob_currency', old('fob_currency'), ['class' => 'form-control text-black datePicker','id'=>'fob_currency' ,'placeholder' => 'Mata Uang', 'readonly']) }}
                                </div>
                                <div class="row mb-2">
                                    <label class="form-label" for="origin_port_id">Pelabuhan Asal <span class="text-danger">*</span></label>
                                    {{ Form::text('origin_port_id', old('origin_port_id'), ['class' => 'form-control text-black datePicker','id'=>'origin_port_id' ,'placeholder' => 'Pelabuhan Asal', 'readonly']) }}
                                </div>
                                <div class="row mb-2">
                                    <label class="form-label" for="loading_port_id">Pelabuhan Muat <span class="text-danger">*</span></label>
                                    {{ Form::text('loading_port_id', old('loading_port_id'), ['class' => 'form-control text-black datePicker','id'=>'loading_port_id' ,'placeholder' => 'Pelabuhan Muat', 'readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h5 class="card-title text-black">
                            C. Hasil Pemeriksaan
                        </h5>
                    </div>
                    <div class="card-action"></div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="jumlah_kemasan">Jumlah dan Jenis Kemasan: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-4 col-lg-4 col-sm-12">
                                        {{ Form::text('jumlah_kemasan', null, ['class' => 'form-control text-black','id'=>'jumlah_kemasan' ,'placeholder' => 'Jumlah Kemasan', 'readonly']) }}
                                    </div>
                                    <div class="col-md-8 col-lg-8 col-sm-12">
                                        {{ Form::text('jenis_kemasan', null, ['class' => 'form-control text-black','id'=>'jenis_kemasan' ,'placeholder' => 'Jenis Kemasan', 'readonly']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="merk_kemasan">Merk dan Nomor Kemasan: <span class="text-danger">*</span></label>
                                {{ Form::textarea('merk_kemasan', old('merk_kemasan'), ['class' => 'form-control text-black datePicker','id'=>'merk_kemasan' ,'placeholder' => 'Merk dan Nomor Kemasan', 'readonly','rows'=>'2']) }}
                            </div>
                        </div>
                        <div class="row mt-2">
                            <h6 class="text-black text-small mb-3">Cara Pengapalan Barang</h6>
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table class="table form-table table-responsive-lg table-hover" role="grid" style="width:160%">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th class="text-white text-center">Cara Pengapalan</th>
                                            <th class="text-white text-center">No Peti Kemas</th>
                                            <th class="text-white text-center">Jenis Peti Kemas</th>
                                            <th class="text-white text-center">Ukuran</th>
                                            <th class="text-white text-center">No Segel</th>
                                            <th class="text-white text-center">Jumlah Kemasan</th>
                                            <th class="text-white text-center">TPS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- disini nanti dilooping tentang hasil --}}
                                        <tr>
                                            <tbody>
                                                <tr class="">
                                                    <td class="">
                                                        {{ Form::text('memorizations[0][type]', old('memorizations[0][type]'), ['class' => 'form-control text-black', 'id' => 'memorizations[0][type]', 'readonly']) }}
                                                    </td>
                                                    <td class="">
                                                        {{ Form::text('memorizations[0][create_number]', old('memorizations[0][create_number]'), ['class' => 'form-control text-black', 'id' => 'memorizations[0][create_number]', 'readonly']) }}
                                                    </td>
                                                    <td class="">
                                                        {{ Form::text('memorizations[0][create_type]', old('memorizations[0][create_type]'), ['class' => 'form-control text-black', 'id' => 'memorizations[0][create_type]', 'readonly']) }}
                                                    </td>
                                                    <td class="">
                                                        {{ Form::text('memorizations[0][size]', old('memorizations[0][size]'), ['class' => 'form-control text-black', 'id' => 'memorizations[0][size]', 'readonly']) }}
                                                    </td>
                                                    <td class="">
                                                        <div class="row">
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="row ">
                                                                    <div class="col-md-2 col-lg-1 me-1">
                                                                        <div class="checkbox-wrapper-input">
                                                                            <input type="checkbox" id="check_segel[0]" name="check_segel[0]" data-id="0" class="checkbox_segel"/>
                                                                            <label for="check_segel[0]" class="check-box mt-2">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-5 col-lg-4 pe-1">
                                                                        {{ Form::text('memorizations[0][series]', old('memorizations[0][series]'), ['class' => 'form-control text-black segel-0', 'id' => 'memorizations[0][series]', 'readonly']) }}
                                                                    </div>
                                                                    <div class="col-md-5 col-lg-6 ps-1">
                                                                        {{ Form::text('memorizations[0][series_init]', old('memorizations[0][series_init]'), ['class' => 'form-control text-black segel-0', 'id' => 'memorizations[0][series_init]', 'readonly']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div class="row">
                                                            <div class="col-md-12 col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-6 pe-1">
                                                                        {{ Form::text('memorizations[0][series_total]', old('memorizations[0][series_total]'), ['class' => 'form-control text-black', 'id' => 'memorizations[0][series_total]', 'readonly']) }}
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 ps-1">
                                                                        {{ Form::text('memorizations[0][series_type]', old('memorizations[0][series_type]'), ['class' => 'form-control text-black', 'id' => 'memorizations[0][series_type]', 'readonly']) }}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <div class="red_field" id="red_field_0">
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <label for="memorizations[0][red_series]">TPS Merah</label>
                                                                    <div class="row">
                                                                        <div class="col-md-4 p-1">
                                                                            {{ Form::text('memorizations[0][red_series][0]', old('memorizations[0][red_series][0]'), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][red_series][0]', 'readonly']) }}
                                                                        </div>
                                                                        <div class="col-md-4 p-1">
                                                                            {{ Form::text('memorizations[0][red_init][0]', old('memorizations[0][red_init][0]'), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][red_init][0]', 'readonly']) }}
                                                                        </div>
                                                                        <div class="col-md-4 p-1">
                                                                            {{ Form::text('memorizations[0][red_final][0]', old('memorizations[0][red_final][0]'), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][red_final][0]', 'readonly']) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="green_field" id="green_field_0">
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <label for="memorizations[0][green_series]">TPS Hijau</label>
                                                                    <div class="row">
                                                                        <div class="col-md-4 p-1">
                                                                            {{ Form::text('memorizations[0][green_series][0]', old('memorizations[0][green_series][0]'), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][green_series][0]', 'readonly']) }}
                                                                        </div>
                                                                        <div class="col-md-4 p-1">
                                                                            {{ Form::text('memorizations[0][green_init][0]', old('memorizations[0][green_init][0]'), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][green_init][0]', 'readonly']) }}
                                                                        </div>
                                                                        <div class="col-md-4 p-1">
                                                                            {{ Form::text('memorizations[0][green_final][0]', old('memorizations[0][green_final][0]'), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][green_final][0]', 'readonly']) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="thread_field" id="thread_field_0">
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12">
                                                                    <label for="memorizations[0][thread_seal_series]">Thread Seal</label>
                                                                    <div class="row">
                                                                        <div class="col-md-4 p-1">
                                                                            {{ Form::text('memorizations[0][thread_seal_series][0]', old('memorizations[0][thread_seal_series][0]'), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][thread_seal_series][0]', 'readonly']) }}
                                                                        </div>
                                                                        <div class="col-md-4 p-1">
                                                                            {{ Form::text('memorizations[0][thread_seal_init][0]', old('memorizations[0][thread_seal_init][0]'), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][thread_seal_init][0]', 'readonly']) }}
                                                                        </div>
                                                                        <div class="col-md-4 p-1">
                                                                            {{ Form::text('memorizations[0][thread_seal_final][0]', old('memorizations[0][thread_seal_final][0]'), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][thread_seal_final][0]', 'readonly']) }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr class="mt-4">
                        <div class="row mt-2">
                            <h6 class="text-black text-small mb-3">Uraian Detail Barang:</h6>
                            <div class="table-resposinve">
                                <table class="table form-table table-responsive-lg table-hover" role="grid">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th class="text-white text-center">no</th>
                                            <th class="text-white text-center">hs</th>
                                            <th class="text-white text-center">uraian</th>
                                            <th class="text-white text-center">jumlah</th>
                                            <th class="text-white text-center">fob</th>
                                            <th class="text-white text-center">perKilo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- nanti disini di looping --}}
                                        <tr>
                                            <td>NO</td>
                                            <td>{{ Form::text('barang[0][nomor_hs]', old('barang[0][nomor_hs]'), ['class' => 'form-control text-black','id'=>'barang[0][nomor_hs]' ,'placeholder' => 'Nomor HS', 'readonly']) }}</td>
                                            <td>{{ Form::text('barang[0][uraian]', old('barang[0][uraian]'), ['class' => 'form-control text-black','id'=>'barang[0][uraian]' ,'placeholder' => 'Uraian', 'readonly']) }}</td>
                                            <td>{{ Form::text('barang[0][jumlah_total]', old('barang[0][jumlah_total]'), ['class' => 'form-control text-black','id'=>'barang[0][jumlah_total]' ,'placeholder' => 'Jumlah Total', 'readonly']) }}</td>
                                            <td>{{ Form::text('barang[0][nilai_fob]', old('barang[0][nilai_fob]'), ['class' => 'form-control text-black calculateFOB','id'=>'barang[0][nilai_fob]' ,'placeholder' => 'FOB', 'readonly']) }}</td>
                                            <td>{{ Form::text('barang[0][per_kilogram]', old('barang[0][per_kilogram]'), ['class' => 'form-control text-black','id'=>'barang[0][per_kilogram]' ,'placeholder' => 'perKilo', 'readonly']) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="table-responsive">
                                <h6 class="text-black text-small mb-3">Hasil Analisa Lab:</h6>
                                <table class="table form-table table-bordered table-responsive-lg table-hover" role="grid">
                                    <thead>
                                        <tr class="text-white bg-primary">
                                            <th style="text-align:center; align-content:center;" rowspan="2">Parameter</th>
                                            <th style="text-align:center; align-content:center;" rowspan="2">Satuan</th>
                                            <th style="text-align:center; align-content:center;" rowspan="2">Hasil Uji</th>
                                            <th style="text-align:center; align-content:center;" colspan="2">Persyaratan BPOM</th>
                                            <th style="text-align:center; align-content:center;" rowspan="2">Metode</th>
                                        </tr>
                                        <tr class="text-white bg-primary">
                                            <th style="text-align:center;align-content:center; width:15%">Kratom Putih dan Hijau</th>
                                            <th style="text-align:center;align-content:center; ">Kratom Merah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td> - Mitragynine</td>
                                            <td style="text-align:center">%</td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center"> &ge; 1.2</td>
                                            <td style="text-align:center"> &ge; 0.8</td>
                                            <td style="text-align:center"></td>
                                        </tr>
                                        <tr>
                                            <td> - Timbal (Pb)</td>
                                            <td style="text-align:center">mg/kg</td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center">&le; 10</td>
                                            <td style="text-align:center">&le; 10</td>
                                            <td style="text-align:center"></td>
                                        </tr>
                                        <tr>
                                            <td> - Kadmium (Cd)</td>
                                            <td style="text-align:center">mg/kg</td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center">&le; 0.3</td>
                                            <td style="text-align:center">&le; 0.3</td>
                                            <td style="text-align:center"></td>
                                        </tr>
                                        <tr>
                                            <td> - Arsen (As)</td>
                                            <td style="text-align:center">mg/kg</td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center">&le; 5</td>
                                            <td style="text-align:center">&le; 5</td>
                                            <td style="text-align:center"></td>
                                        </tr>
                                        <tr>
                                            <td> - Merkuri (Hg)</td>
                                            <td style="text-align:center">mg/kg</td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center">&le; 0.5</td>
                                            <td style="text-align:center">&le; 0.5</td>
                                            <td style="text-align:center"></td>
                                        </tr>
                                        <tr>
                                            <td> - Kadar Air</td>
                                            <td style="text-align:center">%</td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center">&le; 10</td>
                                            <td style="text-align:center">&le; 10</td>
                                            <td style="text-align:center"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-style: italic;"> - Ukuran Partikel</td>
                                            <td style="text-align:center">μm</td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center">&le; 600</td>
                                            <td style="text-align:center">&le; 600</td>
                                            <td style="text-align:center"></td>
                                        </tr>
                                        <tr>
                                            <td style="text-align:center">Mikrobiologi:</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td style="font-style: italic;"> - Escherichia coli</td>
                                            <td style="text-align:center">APM/g</td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center">&le; 10</td>
                                            <td style="text-align:center">&le; 10</td>
                                            <td style="text-align:center"></td>
                                        </tr>
                                        <tr>
                                            <td style="font-style: italic;"> - Salmonella sp</td>
                                            <td style="text-align:center">Koloni/25g</td>
                                            <td style="text-align:center"></td>
                                            <td style="text-align:center">Negatif/g</td>
                                            <td style="text-align:center">Negatif/g</td>
                                            <td style="text-align:center"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
