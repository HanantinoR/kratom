<x-app-layout :assets="$assets ?? []">
    <div class="">
        <?php
            $id = $id ?? null;
            $currency = ['USD','IDR',"JPY"];
            $office = ["JAKARTA"=>'Jakarta',"BANDUNG"=>'BANDUNG',"CIREBON"=>'CIREBON'];
            $date = ['WIB'=>'WIB','WITA'=>'WITA','WIT'=>'WIT'];
            $type = ['1' => 'FCL','2' => 'LCL','3' => 'KONV'];
            $size = ['20' => '20', '40' => '40'];
            $type_kemasan = ['1'=>'BALE','2'=>'CARTON','3'=>'BUNDLE','4'=>'PALLET']
            dd($id);
        ?>
        @if(isset($id))
            {!! Form::model($data, ['route' => ['pengajuan.update', $id], 'method' => 'patch' , 'enctype' => 'multipart/form-data']) !!}
        @else
            {!! Form::open(['route' => ['pengajuan.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        @endif
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h3 class="card-title">
                                {{$id !== null ? 'Edit' : 'Tambah' }} Pengajuan
                            </h3>
                        </div>
                        <div class="card-action">
                            <a href="{{route('pengajuan.index')}}" class="btn btn-sm btn-primary" role="button">Back</a>
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="nomor_penganjuan">Nomor Pengajuan: <span class="text-danger">*</span></label>
                                    {{ Form::text('nomor_penganjuan', old('nomor_penganjuan'), ['class' => 'form-control','id'=>'nomor_pengajuan' ,'placeholder' => 'Nomor Pengajuan', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="tanggal_pengajuan">Tanggal Pengajuan: <span class="text-danger">*</span></label>
                                    {{ Form::text('tanggal_pengajuan', old('tanggal_pengajuan'), ['class' => 'form-control datePicker','id'=>'tanggal_pengajuan' ,'placeholder' => 'Tanggal Pengajuan', 'required']) }}
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-4 text-secondary">DATA PEMOHON</h5>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[name]">Nama Perusahaan: <span class="text-danger">*</span></label>
                                    {{ Form::select('company[name]', $roles , old('company[name]') ? old('company[name]') : $data->user_type ?? 'user', ['class' => 'form-control company_name', 'placeholder' => 'Select Company Name']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="company[kuota]">Kuota Pemakaian: <span class="text-danger">*</span></label>
                                            {{ Form::text('company[kuota]', old('company[kuota]'), ['class' => 'form-control','id'=>'company[kuota]' ,'placeholder' => 'Kuota Pemakaian', 'readonly']) }}
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="company[kuota]">Sisa Kuota: <span class="text-danger">*</span></label>
                                    {{ Form::text('company[kuota]', old('company[kuota]'), ['class' => 'form-control','id'=>'company[kuota]' ,'placeholder' => 'Kuota Sisa', 'readonly']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[email]">Email: <span class="text-danger">*</span></label>
                                    {{ Form::email('company[email]', old('company[email]'), ['class' => 'form-control','id'=>'company[email]' ,'placeholder' => 'E-Mail ', 'readonly', 'rows'=>'2']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[phone]">Telephone: <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ Form::text('company[phone]', old('company[phone]'), ['class' => 'form-control','id'=>'company[phone]' ,'placeholder' => 'Telephone', 'readonly']) }}
                                        </div>
                                        <div class="col-md-6">
                                            {{ Form::text('company[phone_alt]', old('company[phone_alt]'), ['class' => 'form-control','id'=>'company[phone_alt]' ,'placeholder' => 'Telephone', 'readonly']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[nib]">NIB: <span class="text-danger">*</span></label>
                                    {{ Form::text('company[nib]', old('company[nib]'), ['class' => 'form-control','id'=>'company[nib]' ,'placeholder' => 'NIB', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[tanggal_nib]">Tanggal NIB: <span class="text-danger">*</span></label>
                                    {{ Form::text('company[tanggal_nib]', old('company[tanggal_nib]'), ['class' => 'form-control','id'=>'company[tanggal_nib]' ,'placeholder' => 'Tanggal NIB', 'readonly']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[et]">Nomor ET: <span class="text-danger">*</span></label>
                                    {{ Form::text('company[et]', old('company[et]'), ['class' => 'form-control','id'=>'company[et]' ,'placeholder' => 'ET', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[tanggal_et]">Tanggal ET: <span class="text-danger">*</span></label>
                                    {{ Form::text('company[tanggal_et]', old('company[tanggal_et]'), ['class' => 'form-control','id'=>'company[tanggal_et]' ,'placeholder' => 'Tanggal NIB', 'readonly']) }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[pe]">Nomor PE: <span class="text-danger">*</span></label>
                                    {{ Form::text('company[pe]', old('company[pe]'), ['class' => 'form-control','id'=>'company[pe]' ,'placeholder' => 'PE', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[tanggal_pe]">Tanggal PE: <span class="text-danger">*</span></label>
                                    {{ Form::text('company[tanggal_pe]', old('company[tanggal_pe]'), ['class' => 'form-control','id'=>'company[tanggal_pe]' ,'placeholder' => 'Tanggal NIB', 'readonly']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[npwp]">NPWP: <span class="text-danger">*</span></label>
                                    {{ Form::text('company[npwp]', old('company[npwp]'), ['class' => 'form-control','id'=>'company[npwp]' ,'placeholder' => 'NPWP', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[address]">Alamat: <span class="text-danger">*</span></label>
                                    {{ Form::textarea('company[address]', old('company[address]'), ['class' => 'form-control','id'=>'company[address]' ,'placeholder' => 'Alamat', 'readonly', 'rows'=>'2']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[pic]">Nama: <span class="text-danger">*</span></label>
                                    {{ Form::text('company[pic]', old('company[pic]'), ['class' => 'form-control','id'=>'company[pic]' ,'placeholder' => 'Penanggung Jawab', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company[position]">Jabatan: <span class="text-danger">*</span></label>
                                    {{ Form::text('company[position]', old('company[position]'), ['class' => 'form-control','id'=>'company[position]' ,'placeholder' => 'Jabatan', 'readonly']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title text-secondary">
                                BARANG EKSPOR
                            </h5>
                        </div>
                        <div class="card-action"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive mt-4 mb-2">
                                <table class="table table-striped mb-0" role="grid">
                                    <thead>
                                        <tr>
                                            <th>hs</th>
                                            <th>uraian</th>
                                            <th>jumlah</th>
                                            <th>fob</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ Form::text('nomor_hs', old('nomor_hs'), ['class' => 'form-control','id'=>'nomor_hs' ,'placeholder' => 'Nomor HS', 'required']) }}</td>
                                            <td>{{ Form::text('uraian', old('uraian'), ['class' => 'form-control','id'=>'uraian' ,'placeholder' => 'Uraian', 'required']) }}</td>
                                            <td>{{ Form::text('jumlah_total', old('jumlah_total'), ['class' => 'form-control','id'=>'jumlah_total' ,'placeholder' => 'Jumlah Total', 'required']) }}</td>
                                            <td>{{ Form::text('nilai_fob', old('nilai_fob'), ['class' => 'form-control','id'=>'nilai_fob' ,'placeholder' => 'FOB', 'required']) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="merek_kemasan">Merek & Nomor Kemasan : <span class="text-danger">*</span></label>
                                {{ Form::textarea('merek_kemasan', old('merek_kemasan'), ['class' => 'form-control','id'=>'merek_kemasan' ,'placeholder' => 'Merek dan Nomor Kemasan', 'required', 'rows'=>'2']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="total_kemasan">Total Kemasan: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-8">
                                        {{ Form::text('total_kemasan', old('total_kemasan'), ['class' => 'form-control','id'=>'total_kemasan' ,'placeholder' => 'Total Kemasan', 'required']) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::select('fob_currency', $type_kemasan , null,  ['class' => 'form-control type_kemasan','id'=>'type_kemasan' ,'placeholder' => 'Pilih!', 'required']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="total_fob">Nilai FOB: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-8">
                                        {{ Form::text('total_fob', old('total_fob'), ['class' => 'form-control','id'=>'total_fob' ,'placeholder' => 'Nilai FOB', 'readonly']) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::select('fob_currency', $currency , old('company[name]'),  ['class' => 'form-control fob_currency','id'=>'fob_currency' ,'placeholder' => 'Pilih FOB', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="nomor_invoice">Nomor Invoice: <span class="text-danger">*</span></label>
                                {{ Form::text('nomor_invoice', old('nomor_invoice'), ['class' => 'form-control','id'=>'nomor_invoice' ,'placeholder' => 'Nomor Invoice', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="tanggal_invoice">Tanggal Invoice: <span class="text-danger">*</span></label>
                                {{ Form::text('tanggal_invoice', old('tanggal_invoice'), ['class' => 'form-control datePicker','id'=>'tanggal_invoice' ,'placeholder' => 'Tanggal Invoice', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="nomor_packing_list">Nomor Packing List <span class="text-danger">*</span></label>
                                {{ Form::text('nomor_packing_list', old('nomor_packing_list'), ['class' => 'form-control','id'=>'nomor_packing_list' ,'placeholder' => 'Nomor Invoice', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="tanggapacking_list">Tanggal Packing List <span class="text-danger">*</span></label>
                                {{ Form::text('tanggapacking_list', old('tanggapacking_list'), ['class' => 'form-control datePicker','id'=>'tanggapacking_list' ,'placeholder' => 'Tanggal Invoice', 'required']) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="buyer_name">Nama Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::text('buyer_name', old('buyer_name'), ['class' => 'form-control','id'=>'buyer_name' ,'placeholder' => 'Nama Pembeli', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="buyer_address">Alamat Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::textarea('buyer_address', old('buyer_address'), ['class' => 'form-control','id'=>'buyer_address' ,'placeholder' => 'Alamat Pembeli', 'required', 'rows'=>'2']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="loading_port">Pelabuhan Muat: <span class="text-danger">*</span></label>
                                {{ Form::text('loading_port', old('loading_port'), ['class' => 'form-control','id'=>'loading_port' ,'placeholder' => 'Pelabuhan Muat', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="country_id">Negara Tujuan: <span class="text-danger">*</span></label>
                                <small class="text-info text-6">(tercantum di LS)</small>
                                {{ Form::text('country_id', old('country_id'), ['class' => 'form-control','id'=>'country_id' ,'placeholder' => 'Negara Tujuan', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="country_destination_port">Negara Tujuan : <span class="text-danger">*</span></label>
                                {{ Form::text('country_destination_port', old('country_destination_port'), ['class' => 'form-control','id'=>'country_destination_port' ,'placeholder' => 'Negara Tujuan', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="" class="form-label">Pelabuhan Tujuan</label>
                                {{ Form::text('destination_port', old('destination_port'), ['class' => 'form-control','id'=>'destination_port' ,'placeholder' => 'Pelabuhan Tujuan', 'required']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title text-secondary">
                                Kesiapan Barang
                            </h5>
                        </div>
                        <div class="card-action"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="form-label">Tempat Penyimpanan:</label>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="grid" style="--bs-gap: 1rem">
                                            <div class="form-check g-col-6">
                                                {{ Form::radio('status', 'pabrik',old('status') || true, ['class' => 'form-check-input', 'id' => 'gudang-pabrik']); }}
                                                <label class="form-check-label" for="gudang-pabrik">
                                                    Gudang Pabrik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="grid" style="--bs-gap: 1rem">
                                            <div class="form-check g-col-6">
                                                {{ Form::radio('status', 'konsolidator',old('status') || true, ['class' => 'form-check-input', 'id' => 'gudang-konsolidator']); }}
                                                <label class="form-check-label" for="gudang-konsolidator">
                                                    Gudang Konsolidator
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label for="" class="col-lg-12">Barang tersebut telah siap diekspor dan pemeriksaan diminta pada:</label>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_office">Kantor Pemeriksaan: <span class="text-danger">*</span></label>
                                {{ Form::select('inspection_office', $office ,old('inspection_office'), ['class' => 'form-control inspection_office','id'=>'inspection_office' ,'placeholder' => 'Kantor Pemeriksaan', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_address">Alamat: <span class="text-danger">*</span></label>
                                {{ Form::textarea('inspection_address', old('inspection_address'), ['class' => 'form-control','id'=>'inspection_address' ,'placeholder' => 'Alamat',"rows"=>'2' ,'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_address">Tanggal: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::text('inspection_date', old('inspection_date'), ['class' => 'form-control datePicker','id'=>'inspection_date' ,'placeholder' => 'Tanggal' ,'required']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::select('date_type', $date ,old('date_type'), ['class' => 'form-control date_type','id'=>'date_type' ,'placeholder' => 'WAKTU', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="provincy_inspection">Provinsi: <span class="text-danger">*</span></label>
                                {{ Form::text('provincy_inspection', old('provincy_inspection'), ['class' => 'form-control','id'=>'provincy_inspection' ,'placeholder' => 'Provinsi', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="district_inspection">Kabupaten: <span class="text-danger">*</span></label>
                                {{ Form::text('district_inspection', old('district_inspection'), ['class' => 'form-control','id'=>'district_inspection' ,'placeholder' => 'Kabupaten', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_pic_name">Nama Petugas: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_pic_name', old('inspection_pic_name'), ['class' => 'form-control','id'=>'inspection_pic_name' ,'placeholder' => 'Provinsi', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_pic_number">No HP Petugas: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_pic_number', old('inspection_pic_number'), ['class' => 'form-control','id'=>'inspection_pic_number' ,'placeholder' => 'Provinsi', 'required']) }}
                            </div>
                        </div>
                        <label for="" class="col-lg-12">Tanggal dan Tempat Pelaksanaan Stuffing :</label>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_office">Kantor Pengawasan Stuffing: <span class="text-danger">*</span></label>
                                {{ Form::select('inspection_office', $office ,old('inspection_office'), ['class' => 'form-control inspection_office','id'=>'inspection_office' ,'placeholder' => 'Kantor Pemeriksaan', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_address">Alamat: <span class="text-danger">*</span></label>
                                {{ Form::textarea('inspection_address', old('inspection_address'), ['class' => 'form-control','id'=>'inspection_address' ,'placeholder' => 'Alamat',"rows"=>'2' ,'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_address">Tanggal: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::text('inspection_date', old('inspection_date'), ['class' => 'form-control datePicker','id'=>'inspection_date' ,'placeholder' => 'Tanggal' ,'required']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::select('date_type', $date ,old('date_type'), ['class' => 'form-control date_type','id'=>'date_type' ,'placeholder' => 'WAKTU', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h5 class="card-title text-secondary">
                                Cara Pengapalan
                            </h5>
                        </div>
                        <div class="card-action"></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                {{ Form::select('memorize[type]', $type ,old('memorize[type]'), ['class' => 'form-control','id'=>'memorize[type]' ,'placeholder' => 'Type Pengapalan', 'required']) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::select('memorize[size]', $size ,old('memorize[size]'), ['class' => 'form-control','id'=>'memorize[size]' ,'placeholder' => 'Ukuran Pengapalan', 'required']) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::text('memorize[total]', old('memorize[total]'), ['class' => 'form-control','id'=>'memorize[total]' ,'placeholder' => 'Total' ,'required']) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label" for="file_nib">NIB: <span class="text-danger">*</span></label>
                                {{ Form::file('file_nib',['class' => 'form-control', 'id'=>'file_nib','placeholder' => 'input', 'required']) }}
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="file_invoice">Invoice: <span class="text-danger">*</span></label>
                                {{ Form::file('file_invoice',['class' => 'form-control', 'id'=>'file_invoice','placeholder' => 'input', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label" for="file_packing_list">Paking List: <span class="text-danger">*</span></label>
                                {{ Form::file('file_packing_list',['class' => 'form-control', 'id'=>'file_packing_list','placeholder' => 'input', 'required']) }}
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label" for="file_invoice">ET & PE: <span class="text-danger">*</span></label>
                                {{ Form::file('file_invoice',['class' => 'form-control', 'id'=>'file_invoice','placeholder' => 'input', 'multiple' ,'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="other_reason" class="form-label">Catatan Lain</label>
                                {{Form::textarea('other_reason',old('other_reason'),['class'=>'form-control','id'=>'other_reason','placeholder'=>'Catatan','rows'=>'3'])}}
                            </div>
                        </div>
                        <div class="checkbox mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                <label class="form-check-label" for="flexCheckDefault3">
                                    Dengan ini saya Menyatakan Bahwa data yang saya cantumkan sudah Benar dan asli, tidak ada kebohongan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-center">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-primary me-2">Kirim Pengajuan</button>
                                <button type="button" class="btn btn-danger me-2">Kembali</button>
                                <button type="button" class="btn btn-warning">Draft</button>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</x-app-layout>
