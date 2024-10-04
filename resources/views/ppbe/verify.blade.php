<x-app-layout :assets="$assets ?? []">
    <div class="">
        <?php
            $id = $id ?? null;
            $currency = ['1'=>'USD','2'=>'IDR','3'=>"JPY"];
            $office = ["JAKARTA"=>'Jakarta',"BANDUNG"=>'BANDUNG',"CIREBON"=>'CIREBON'];
            $pemeriksaan = ["PONTIANAK"=>'PONTIANAK','SEMARANG'=>'SEMARANG'];
            $stuffing = ["JAKARTA"=>'JAKARTA','SURABAYA' => 'SURABAYA'];
            $date = ['WIB'=>'WIB','WITA'=>'WITA','WIT'=>'WIT'];
            $type = ['1' => 'FCL','2' => 'LCL','3' => 'KONV'];
            $size = ['20' => '20', '40' => '40'];
            $type_kemasan = ['1'=>'BALE','2'=>'CARTON','3'=>'BUNDLE','4'=>'PALLET'];
            $skenario = ['1' => '1', '2' => '2','3'=>'3'];

        ?>
        {!! Form::model($data, ['route' => ['ppbe.update', $id], 'method' => 'patch' , 'enctype' => 'multipart/form-data']) !!}
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h3 class="card-title">
                                {{$id !== null ? 'Edit' : 'Tambah' }} PPBE
                            </h3>
                        </div>
                        <div class="card-action">
                            <a href="{{route('ppbe.index')}}" class="btn btn-sm btn-primary" role="button">Back</a>
                      </div>
                    </div>
                    <div class="card-body">
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="nomor_penganjuan">Nomor PPBE: <span class="text-danger">*</span></label>
                                    {{ Form::text('nomor_penganjuan', old('nomor_penganjuan'), ['class' => 'form-control text-black','id'=>'nomor_pengajuan' ,'placeholder' => 'Nomor PPBE', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="date">Tanggal Pengajuan PPBE: <span class="text-danger">*</span></label>
                                    {{ Form::text('date', old('date'), ['class' => 'form-control text-black datePicker','id'=>'date' ,'placeholder' => 'Tanggal PPBE', 'readonly']) }}
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-4 text-secondary">DATA PEMOHON</h5>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company_id">Nama Perusahaan: <span class="text-danger">*</span></label>
                                    <select name="company_id" class="form-control text-black company_id" id="company_id" placeholder="Select Company Name" disabled>
                                        <option value="">Select Company Name</option>
                                        @foreach($data_company as $key => $company)
                                            <option value="{{ $company->id }}" {{ $data->company_id === $company->id ? 'selected' : '' }}>
                                                {{ $company->company_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label" for="company_quota_used">Kuota Pemakaian: <span class="text-danger">*</span></label>
                                            {{ Form::text('company_quota_used', old('company_quota_used',$history_quota->company_quota_used), ['class' => 'form-control text-black','id'=>'company_quota_used' ,'placeholder' => 'Kuota Pemakaian', 'readonly']) }}
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="company_quota_remaining">Sisa Kuota: <span class="text-danger">*</span></label>
                                            {{ Form::text('company_quota_remaining', old('company_quota_remaining',$history_quota->company_quota_remaining), ['class' => 'form-control text-black','id'=>'company_quota_remaining' ,'placeholder' => 'Kuota Sisa', 'readonly']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company_email">Email: <span class="text-danger">*</span></label>
                                    {{ Form::email('company_email', old('company_email',$data->company->company_email), ['class' => 'form-control text-black','id'=>'company_email' ,'placeholder' => 'E-Mail ', 'readonly', 'rows'=>'2']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company_telp">Telephone: <span class="text-danger">*</span></label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {{ Form::text('company_telp', old('company_telp',$data->company->company_telp), ['class' => 'form-control text-black','id'=>'company_telp' ,'placeholder' => 'Telephone', 'readonly']) }}
                                        </div>
                                        <div class="col-md-6">
                                            {{ Form::text('company_hp', old('company_hp',$data->company->company_hp), ['class' => 'form-control text-black','id'=>'company_hp' ,'placeholder' => 'Telephone', 'readonly']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="nib">NIB: <span class="text-danger">*</span></label>
                                    {{ Form::text('nib', old('nib',$data->company->nib), ['class' => 'form-control text-black','id'=>'nib' ,'placeholder' => 'NIB', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="date_nib">Tanggal NIB: <span class="text-danger">*</span></label>
                                    {{ Form::text('date_nib', old('date_nib',$data->company->date_nib), ['class' => 'form-control text-black','id'=>'date_nib' ,'placeholder' => 'Tanggal NIB', 'readonly']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="nomor_et">Nomor ET: <span class="text-danger">*</span></label>
                                    {{ Form::text('nomor_et', old('nomor_et',$data->company->nomor_et), ['class' => 'form-control text-black','id'=>'nomor_et' ,'placeholder' => 'ET', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="date_et">Tanggal ET: <span class="text-danger">*</span></label>
                                    {{ Form::text('date_et', old('date_et',$data->company->date_et), ['class' => 'form-control text-black','id'=>'date_et' ,'placeholder' => 'Tanggal NIB', 'readonly']) }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="nomor_pe">Nomor PE: <span class="text-danger">*</span></label>
                                    {{ Form::text('nomor_pe', old('nomor_pe',$data->company->nomor_pe), ['class' => 'form-control text-black','id'=>'nomor_pe' ,'placeholder' => 'PE', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="date_pe">Tanggal PE: <span class="text-danger">*</span></label>
                                    {{ Form::text('date_pe', old('date_pe',$data->company->date_pe), ['class' => 'form-control text-black','id'=>'date_pe' ,'placeholder' => 'Tanggal NIB', 'readonly']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company_npwp">NPWP: <span class="text-danger">*</span></label>
                                    {{ Form::text('company_npwp', old('company_npwp',$data->company->company_npwp), ['class' => 'form-control text-black','id'=>'company_npwp' ,'placeholder' => 'NPWP', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company_address">Alamat: <span class="text-danger">*</span></label>
                                    {{ Form::textarea('company_address', old('company_address',$data->company->company_address), ['class' => 'form-control text-black','id'=>'company_address' ,'placeholder' => 'Alamat', 'readonly', 'rows'=>'2']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company_pic">Nama: <span class="text-danger">*</span></label>
                                    {{ Form::text('company_pic', old('company_pic',$data->company->company_pic), ['class' => 'form-control text-black','id'=>'company_pic' ,'placeholder' => 'Penanggung Jawab', 'readonly']) }}
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company_position">Jabatan: <span class="text-danger">*</span></label>
                                    {{ Form::text('company_position', old('company_position',$data->company->company_position), ['class' => 'form-control text-black','id'=>'company_position' ,'placeholder' => 'Jabatan', 'readonly']) }}
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
                                <table class="table table-striped mb-0" role="grid" id="form_barang">
                                    <thead>
                                        <tr>
                                            <th>hs</th>
                                            <th>uraian</th>
                                            <th>jumlah</th>
                                            <th>fob</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->goods as $index => $good)
                                        <tr>
                                            <td>{{ Form::text('barang['.$index.'][nomor_hs]', old('barang['.$index.'][nomor_hs]',$good->processed_level_id), ['class' => 'form-control text-black','id'=>'barang['.$index.'][nomor_hs]' ,'placeholder' => 'Nomor HS', 'readonly']) }}</td>
                                            <td>{{ Form::text('barang['.$index.'][uraian]', old('barang['.$index.'][uraian]',$good->description), ['class' => 'form-control text-black','id'=>'barang['.$index.'][uraian]' ,'placeholder' => 'Uraian', 'readonly']) }}</td>
                                            <td>{{ Form::text('barang['.$index.'][jumlah_total]', old('barang['.$index.'][jumlah_total]',$good->quantity_kg), ['class' => 'form-control text-black','id'=>'barang['.$index.'][jumlah_total]' ,'placeholder' => 'Jumlah Total', 'readonly']) }}</td>
                                            <td>{{ Form::text('barang['.$index.'][nilai_fob]', old('barang['.$index.'][nilai_fob]',$good->fob_value), ['class' => 'form-control text-black calculateFOB','id'=>'barang['.$index.'][nilai_fob]' ,'placeholder' => 'FOB', 'readonly']) }}</td>
                                            <td>
                                                <button class="btn btn-sm btn-icon btn-success btn_tambah" id="tambah_row" type="button">
                                                    <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="merk">Merek & Nomor Kemasan : <span class="text-danger">*</span></label>
                                {{ Form::textarea('merk', old('merk'), ['class' => 'form-control text-black','id'=>'merk' ,'placeholder' => 'Merek dan Nomor Kemasan', 'readonly', 'rows'=>'2']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="packing_total">Total Kemasan: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-8">
                                        {{ Form::text('packing_total', old('packing_total'), ['class' => 'form-control text-black','id'=>'packing_total' ,'placeholder' => 'Total Kemasan', 'readonly']) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::select('packing_type', $type_kemasan , old('packing_type'),  ['class' => 'form-control text-black form_select2','id'=>'packing_type' ,'placeholder' => 'Pilih!', 'disabled']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="fob_total">Nilai FOB: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-8">
                                        {{ Form::text('fob_total', old('fob_total'), ['class' => 'form-control text-black text-black','id'=>'fob_total' ,'placeholder' => 'Nilai FOB', 'readonly']) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::select('fob_currency', $currency , old('fob_currency'),  ['class' => 'form-control text-black fob_currency','id'=>'fob_currency' ,'placeholder' => 'Pilih FOB', 'disabled']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="invoice_number">Nomor Invoice: <span class="text-danger">*</span></label>
                                {{ Form::text('invoice_number', old('invoice_number'), ['class' => 'form-control text-black','id'=>'invoice_number' ,'placeholder' => 'Nomor Invoice', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="invoice_date">Tanggal Invoice: <span class="text-danger">*</span></label>
                                {{ Form::text('invoice_date', old('invoice_date'), ['class' => 'form-control text-black datePicker','id'=>'invoice_date' ,'placeholder' => 'Tanggal Invoice', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="packing_list_number">Nomor Packing List <span class="text-danger">*</span></label>
                                {{ Form::text('packing_list_number', old('packing_list_number'), ['class' => 'form-control text-black','id'=>'packing_list_number' ,'placeholder' => 'Nomor Invoice', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="packing_list_date">Tanggal Packing List <span class="text-danger">*</span></label>
                                {{ Form::text('packing_list_date', old('packing_list_date'), ['class' => 'form-control text-black datePicker','id'=>'packing_list_date' ,'placeholder' => 'Tanggal Invoice', 'readonly']) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="buyer_name">Nama Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::text('buyer_name', old('buyer_name'), ['class' => 'form-control text-black','id'=>'buyer_name' ,'placeholder' => 'Nama Pembeli', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="buyer_address">Alamat Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::textarea('buyer_address', old('buyer_address'), ['class' => 'form-control text-black','id'=>'buyer_address' ,'placeholder' => 'Alamat Pembeli', 'readonly', 'rows'=>'2']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="origin_port_id">Pelabuhan asal: <span class="text-danger">*</span></label>
                                {{ Form::text('origin_port_id', old('origin_port_id'), ['class' => 'form-control text-black','id'=>'origin_port_id' ,'placeholder' => 'Pelabuhan Muat', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="loading_port_id">Pelabuhan Muat: <span class="text-danger">*</span></label>
                                {{ Form::text('loading_port_id', old('loading_port_id'), ['class' => 'form-control text-black','id'=>'loading_port_id' ,'placeholder' => 'Pelabuhan Muat', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="country_id">Negara Tujuan: <span class="text-danger">*</span></label>
                                <small class="text-info text-6">(tercantum di LS)</small>
                                {{ Form::text('country_id', old('country_id'), ['class' => 'form-control text-black','id'=>'country_id' ,'placeholder' => 'Negara Tujuan', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="country_destination_id">Negara Tujuan : <span class="text-danger">*</span></label>
                                {{ Form::text('country_destination_id', old('country_destination_id'), ['class' => 'form-control text-black','id'=>'country_destination_id' ,'placeholder' => 'Negara Tujuan', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="destination_port_id" class="form-label">Pelabuhan Tujuan</label>
                                {{ Form::text('destination_port_id', old('destination_port_id'), ['class' => 'form-control text-black','id'=>'destination_port_id' ,'placeholder' => 'Pelabuhan Tujuan', 'readonly']) }}
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
                                                {{ Form::radio('goods_storage', 'pabrik',old('goods_storage') || true, ['class' => 'form-check-input', 'id' => 'gudang-pabrik']); }}
                                                <label class="form-check-label" for="gudang-pabrik">
                                                    Gudang Pabrik
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="grid" style="--bs-gap: 1rem">
                                            <div class="form-check g-col-6">
                                                {{ Form::radio('goods_storage', 'konsolidator',old('goods_storage') || true, ['class' => 'form-check-input', 'id' => 'gudang-konsolidator']); }}
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
                                <label class="form-label" for="inspection_office_id">Kantor Pemeriksaan: <span class="text-danger">*</span></label>
                                {{ Form::select('inspection_office_id', $pemeriksaan ,old('inspection_office_id'), ['class' => 'form-control text-black form_select2','id'=>'inspection_office' ,'placeholder' => 'Kantor Pemeriksaan', 'disbaled']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_address">Alamat: <span class="text-danger">*</span></label>
                                {{ Form::textarea('inspection_address', old('inspection_address'), ['class' => 'form-control text-black','id'=>'inspection_address' ,'placeholder' => 'Alamat',"rows"=>'2' ,'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_address">Tanggal: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::text('inspection_date', old('inspection_date'), ['class' => 'form-control text-black datePicker','id'=>'inspection_date' ,'placeholder' => 'Tanggal' ,'readonly']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::select('inspection_timezone', $date ,old('inspection_timezone'), ['class' => 'form-control text-black form_select2','id'=>'inspection_timezone' ,'placeholder' => 'WAKTU', 'disabled']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_province_id">Provinsi: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_province_id', old('inspection_province_id'), ['class' => 'form-control text-black','id'=>'inspection_province_id' ,'placeholder' => 'Provinsi', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_city_id">Kabupaten: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_city_id', old('inspection_city_id'), ['class' => 'form-control text-black','id'=>'inspection_city_id' ,'placeholder' => 'Kabupaten', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_pic_name">Nama Petugas: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_pic_name', old('inspection_pic_name'), ['class' => 'form-control text-black','id'=>'inspection_pic_name' ,'placeholder' => 'Provinsi', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_pic_phone">No HP Petugas: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_pic_phone', old('inspection_pic_phone'), ['class' => 'form-control text-black','id'=>'inspection_pic_phone' ,'placeholder' => 'Provinsi', 'readonly']) }}
                            </div>
                        </div>
                        <label for="" class="col-lg-12">Tanggal dan Tempat Pelaksanaan Stuffing :</label>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="stuffing_office_id">Kantor Pengawasan Stuffing: <span class="text-danger">*</span></label>
                                {{ Form::select('stuffing_office_id', $stuffing ,old('stuffing_office_id'), ['class' => 'form-control text-black form_select2','id'=>'stuffing_office_id' ,'placeholder' => 'Kantor Pemeriksaan', 'disabled']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="stuffing_address">Alamat: <span class="text-danger">*</span></label>
                                {{ Form::textarea('stuffing_address', old('stuffing_address'), ['class' => 'form-control text-black','id'=>'stuffing_address' ,'placeholder' => 'Alamat',"rows"=>'2' ,'readonly']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="stuffing_address">Tanggal: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::text('stuffing_date', old('stuffing_date'), ['class' => 'form-control text-black datePicker','id'=>'stuffing_date' ,'placeholder' => 'Tanggal' ,'readonly']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::select('stuffing_timezone', $date ,old('stuffing_timezone'), ['class' => 'form-control text-black form_select2','id'=>'stuffing_timezone' ,'placeholder' => 'WAKTU', 'disabled']) }}
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
                                {{ Form::select('memorize_type', $type ,old('memorize_type'), ['class' => 'form-control text-black','id'=>'memorize_type' ,'placeholder' => 'Type Pengapalan', 'disabled']) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::select('memorize_size', $size ,old('memorize_size'), ['class' => 'form-control text-black','id'=>'memorize_size' ,'placeholder' => 'Ukuran Pengapalan', 'disabled']) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::text('memorize_total', old('memorize_total'), ['class' => 'form-control text-black','id'=>'memorize_total' ,'placeholder' => 'Total' ,'readonly']) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::select('memorize_skenario', $skenario ,old('memorize_skenario'), ['class' => 'form-control text-black','id'=>'memorize_skenario' ,'placeholder' => 'Ukuran Pengapalan', 'disabled']) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input class="form-check-input" type="checkbox" value="" id="file_nib_check">
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group row">
                                            <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_nib">NIB: </label>
                                            <div class="col-md-6 col-sm-9">
                                                <a href="{{url('ppbe_file/'.$data->file_nib)}}" target="_blank" class="me-2 text-left">
                                                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                    </svg>
                                                    Download File NIB
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input class="form-check-input" type="checkbox" value="" id="file_invoice_check">
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group row">
                                            <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_invoice">Invoice: </label>
                                            <div class="col-md-6 col-sm-9">
                                                <a href="{{asset('ppbe_file/'.    $data->file_invoice)}}" target="_blank" class="me-2">
                                                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                    </svg>
                                                    Download File Invoice
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input class="form-check-input" type="checkbox" value="" id="file_packing_list_check">
                                    </div>
                                    <div class="col-md-10">
                                        <div class="form-group row">
                                            <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_packing_list">Packing List: </label>
                                            <div class="col-md-6 col-sm-9">
                                                <a href="{{asset('ppbe_file/'.    $data->file_packing_list)}}" target="_blank" class="me-2">
                                                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                    </svg>
                                                    Download File Packing List
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-6 mb-3">
                                <label class="form-label" for="file_invoice">ET & PE: <span class="text-danger">*</span></label>
                                {{ Form::file('file_invoice',['class' => 'dropify', 'id'=>'file_invoice','placeholder' => 'input' ,'readonly']) }}
                            </div> --}}
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
                                <button type="button" class="btn btn-primary me-2"  id="verify-btn" data-id="{{$id}}" disabled>Verifikasi PPBE</button>
                                <button type="button" class="btn btn-danger me-2"  id="reject-send" data-id="{{$id}}"data-bs-toggle="modal" data-bs-target="#RejectModal">Tolak PPBE</button>
                                <a href="{{route('ppbe.index')}}" type="button" class="btn btn-secondary me-2">Kembali</a>
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
<div class="modal fade" id="verifikasiModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="verifikasiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifikasiModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($data, ['route' => ['ppbe.update', $id], 'method' => 'patch' , 'enctype' => 'multipart/form-data','id'=>"form_approval"]) !!}
                    <div class="row">
                        {{Form::hidden('ppbe_id',old('ppbe_id',$id),['class'=>'form-control','id'=>'ppbe_id','placeholder'=>'Catatan'])}}
                        {{Form::hidden('checkbox_data',old('checkbox_data',$id),['class'=>'form-control','id'=>'checkbox_data','placeholder'=>'Catatan'])}}
                        <div class="mb-3">
                            <label for="ppbe_new_status" class="col-form-label">Status:</label>
                            {{Form::text('ppbe_new_status',"Disetujui",['class'=>'form-control text-black','id'=>'ppbe_new_status','placeholder'=>'Catatan','readonly'])}}
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Alasan:</label>
                            {{Form::text('ppbe_approved_reason',null,['class'=>'form-control text-black','id'=>'ppbe_approved_reason','placeholder'=>'Catatan'])}}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="verifyBtn">
                    <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.4274 2.5783C20.9274 2.0673 20.1874 1.8783 19.4974 2.0783L3.40742 6.7273C2.67942 6.9293 2.16342 7.5063 2.02442 8.2383C1.88242 8.9843 2.37842 9.9323 3.02642 10.3283L8.05742 13.4003C8.57342 13.7163 9.23942 13.6373 9.66642 13.2093L15.4274 7.4483C15.7174 7.1473 16.1974 7.1473 16.4874 7.4483C16.7774 7.7373 16.7774 8.2083 16.4874 8.5083L10.7164 14.2693C10.2884 14.6973 10.2084 15.3613 10.5234 15.8783L13.5974 20.9283C13.9574 21.5273 14.5774 21.8683 15.2574 21.8683C15.3374 21.8683 15.4274 21.8683 15.5074 21.8573C16.2874 21.7583 16.9074 21.2273 17.1374 20.4773L21.9074 4.5083C22.1174 3.8283 21.9274 3.0883 21.4274 2.5783Z" fill="currentColor"></path>
                        <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M3.01049 16.8079C2.81849 16.8079 2.62649 16.7349 2.48049 16.5879C2.18749 16.2949 2.18749 15.8209 2.48049 15.5279L3.84549 14.1619C4.13849 13.8699 4.61349 13.8699 4.90649 14.1619C5.19849 14.4549 5.19849 14.9299 4.90649 15.2229L3.54049 16.5879C3.39449 16.7349 3.20249 16.8079 3.01049 16.8079ZM6.77169 18.0003C6.57969 18.0003 6.38769 17.9273 6.24169 17.7803C5.94869 17.4873 5.94869 17.0133 6.24169 16.7203L7.60669 15.3543C7.89969 15.0623 8.37469 15.0623 8.66769 15.3543C8.95969 15.6473 8.95969 16.1223 8.66769 16.4153L7.30169 17.7803C7.15569 17.9273 6.96369 18.0003 6.77169 18.0003ZM7.02539 21.5683C7.17139 21.7153 7.36339 21.7883 7.55539 21.7883C7.74739 21.7883 7.93939 21.7153 8.08539 21.5683L9.45139 20.2033C9.74339 19.9103 9.74339 19.4353 9.45139 19.1423C9.15839 18.8503 8.68339 18.8503 8.39039 19.1423L7.02539 20.5083C6.73239 20.8013 6.73239 21.2753 7.02539 21.5683Z" fill="currentColor"></path>
                    </svg>
                Verify PPBE</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="RejectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="RejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="RejectModalLabel">Tolak PPBE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {!! Form::model($data, ['route' => ['ppbe.update', $id], 'method' => 'patch' , 'enctype' => 'multipart/form-data','id'=>"form_reject"]) !!}
                    <div class="row">
                        {{Form::hidden('ppbe_id',old('ppbe_id',$id),['class'=>'form-control','id'=>'ppbe_id','placeholder'=>'Catatan'])}}
                        <div class="mb-3">
                            <label for="ppbe_new_status" class="col-form-label">Status:</label>
                            {{Form::text('ppbe_new_status',"Tolak",['class'=>'form-control text-black','id'=>'ppbe_new_status','placeholder'=>'Catatan','readonly'])}}
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Alasan:</label>
                            {{Form::text('ppbe_approved_reason',null,['class'=>'form-control text-black','id'=>'ppbe_approved_reason','placeholder'=>'Catatan'])}}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="rejectbtn">
                    <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path opacity="0.4" d="M18.8089 9.021C18.3574 9.021 17.7594 9.011 17.0149 9.011C15.199 9.011 13.7059 7.508 13.7059 5.675V2.459C13.7059 2.206 13.503 2 13.2525 2H7.96337C5.49604 2 3.5 4.026 3.5 6.509V17.284C3.5 19.889 5.59109 22 8.1703 22H16.0455C18.5059 22 20.5 19.987 20.5 17.502V9.471C20.5 9.217 20.298 9.012 20.0465 9.013C19.6238 9.016 19.1168 9.021 18.8089 9.021Z" fill="currentColor"></path>
                        <path opacity="0.4" d="M16.0842 2.56737C15.7862 2.25637 15.2632 2.47037 15.2632 2.90137V5.53837C15.2632 6.64437 16.1742 7.55437 17.2802 7.55437C17.9772 7.56237 18.9452 7.56437 19.7672 7.56237C20.1882 7.56137 20.4022 7.05837 20.1102 6.75437C19.0552 5.65737 17.1662 3.69137 16.0842 2.56737Z" fill="currentColor"></path>
                        <path d="M12.9349 12.9854L14.1559 11.7634C14.4469 11.4734 14.4469 11.0024 14.1559 10.7114C13.8649 10.4204 13.3939 10.4204 13.1029 10.7114L11.8819 11.9314L10.6609 10.7114C10.3699 10.4204 9.89792 10.4204 9.60692 10.7114C9.31592 11.0024 9.31592 11.4734 9.60692 11.7634L10.8289 12.9854L9.60692 14.2064C9.31592 14.4974 9.31592 14.9684 9.60692 15.2584C9.75292 15.4044 9.94292 15.4774 10.1339 15.4774C10.3249 15.4774 10.5149 15.4044 10.6609 15.2584L11.8819 14.0384L13.1029 15.2584C13.2479 15.4044 13.4389 15.4774 13.6299 15.4774C13.8199 15.4774 14.0109 15.4044 14.1559 15.2584C14.4469 14.9684 14.4469 14.4974 14.1559 14.2064L12.9349 12.9854Z" fill="currentColor"></path>
                    </svg>
                Tolak PPBE</button>
            </div>
        </div>
    </div>
</div>
