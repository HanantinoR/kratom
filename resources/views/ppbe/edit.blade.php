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
        {!! Form::model($data, ['route' => ['ppbe.update', $id], 'method' => 'patch' , 'enctype' => 'multipart/form-data','id'=>'form_edit']) !!}
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
                                    {{ Form::text('date', old('date'), ['class' => 'form-control text-black datePicker','id'=>'date' ,'placeholder' => 'Tanggal PPBE', 'required']) }}
                                </div>
                            </div>
                            <hr>
                            <h5 class="mb-4 text-secondary">DATA PEMOHON</h5>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="company_id">Nama Perusahaan: <span class="text-danger">*</span></label>
                                    {{-- {{ Form::select('company[name]', $data_company , old('company[name]') ? old('company[name]') : $data->user_type ?? 'user', ['class' => 'form-control text-black company_id', 'placeholder' => 'Select Company Name']) }} --}}
                                    <select name="company_id" class="form-control text-black company_id" id="company_id" placeholder="Select Company Name" readonly>
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
                                            <td>{{ Form::text('barang['.$index.'][nomor_hs]', old('barang['.$index.'][nomor_hs]',$good->processed_level_id), ['class' => 'form-control text-black','id'=>'barang['.$index.'][nomor_hs]' ,'placeholder' => 'Nomor HS', 'required']) }}</td>
                                            <td>{{ Form::text('barang['.$index.'][uraian]', old('barang['.$index.'][uraian]',$good->description), ['class' => 'form-control text-black','id'=>'barang['.$index.'][uraian]' ,'placeholder' => 'Uraian', 'required']) }}</td>
                                            <td>{{ Form::text('barang['.$index.'][jumlah_total]', old('barang['.$index.'][jumlah_total]',$good->quantity_kg), ['class' => 'form-control text-black','id'=>'barang['.$index.'][jumlah_total]' ,'placeholder' => 'Jumlah Total', 'required']) }}</td>
                                            <td>{{ Form::text('barang['.$index.'][nilai_fob]', old('barang['.$index.'][nilai_fob]',$good->fob_value), ['class' => 'form-control text-black calculateFOB','id'=>'barang['.$index.'][nilai_fob]' ,'placeholder' => 'FOB', 'required']) }}</td>
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
                                {{ Form::textarea('merk', old('merk'), ['class' => 'form-control text-black','id'=>'merk' ,'placeholder' => 'Merek dan Nomor Kemasan', 'required', 'rows'=>'2']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="packing_total">Total Kemasan: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-8">
                                        {{ Form::text('packing_total', old('packing_total'), ['class' => 'form-control text-black','id'=>'packing_total' ,'placeholder' => 'Total Kemasan', 'required']) }}
                                    </div>
                                    <div class="col-md-4">
                                        {{ Form::select('packing_type', $type_kemasan , old('packing_type'),  ['class' => 'form-control text-black form_select2','id'=>'packing_type' ,'placeholder' => 'Pilih!', 'required']) }}
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
                                        {{ Form::select('fob_currency', $currency , old('fob_currency'),  ['class' => 'form-control text-black fob_currency','id'=>'fob_currency' ,'placeholder' => 'Pilih FOB', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="invoice_number">Nomor Invoice: <span class="text-danger">*</span></label>
                                {{ Form::text('invoice_number', old('invoice_number'), ['class' => 'form-control text-black','id'=>'invoice_number' ,'placeholder' => 'Nomor Invoice', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="invoice_date">Tanggal Invoice: <span class="text-danger">*</span></label>
                                {{ Form::text('invoice_date', old('invoice_date'), ['class' => 'form-control text-black datePicker','id'=>'invoice_date' ,'placeholder' => 'Tanggal Invoice', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="packing_list_number">Nomor Packing List <span class="text-danger">*</span></label>
                                {{ Form::text('packing_list_number', old('packing_list_number'), ['class' => 'form-control text-black','id'=>'packing_list_number' ,'placeholder' => 'Nomor Invoice', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="packing_list_date">Tanggal Packing List <span class="text-danger">*</span></label>
                                {{ Form::text('packing_list_date', old('packing_list_date'), ['class' => 'form-control text-black datePicker','id'=>'packing_list_date' ,'placeholder' => 'Tanggal Invoice', 'required']) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="buyer_name">Nama Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::text('buyer_name', old('buyer_name'), ['class' => 'form-control text-black','id'=>'buyer_name' ,'placeholder' => 'Nama Pembeli', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="buyer_address">Alamat Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::textarea('buyer_address', old('buyer_address'), ['class' => 'form-control text-black','id'=>'buyer_address' ,'placeholder' => 'Alamat Pembeli', 'required', 'rows'=>'2']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="loading_port_id">Pelabuhan Muat: <span class="text-danger">*</span></label>
                                {{ Form::text('loading_port_id', old('loading_port_id'), ['class' => 'form-control text-black','id'=>'loading_port_id' ,'placeholder' => 'Pelabuhan Muat', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="country_id">Negara Tujuan: <span class="text-danger">*</span></label>
                                <small class="text-info text-6">(tercantum di LS)</small>
                                {{ Form::text('country_id', old('country_id'), ['class' => 'form-control text-black','id'=>'country_id' ,'placeholder' => 'Negara Tujuan', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="country_destination_id">Negara Tujuan : <span class="text-danger">*</span></label>
                                {{ Form::text('country_destination_id', old('country_destination_id'), ['class' => 'form-control text-black','id'=>'country_destination_id' ,'placeholder' => 'Negara Tujuan', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="destination_port_id" class="form-label">Pelabuhan Tujuan</label>
                                {{ Form::text('destination_port_id', old('destination_port_id'), ['class' => 'form-control text-black','id'=>'destination_port_id' ,'placeholder' => 'Pelabuhan Tujuan', 'required']) }}
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
                                {{ Form::select('inspection_office_id', $pemeriksaan ,old('inspection_office_id'), ['class' => 'form-control text-black form_select2','id'=>'inspection_office' ,'placeholder' => 'Kantor Pemeriksaan', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_address">Alamat: <span class="text-danger">*</span></label>
                                {{ Form::textarea('inspection_address', old('inspection_address'), ['class' => 'form-control text-black','id'=>'inspection_address' ,'placeholder' => 'Alamat',"rows"=>'2' ,'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_address">Tanggal: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::text('inspection_date', old('inspection_date'), ['class' => 'form-control text-black datePicker','id'=>'inspection_date' ,'placeholder' => 'Tanggal' ,'required']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::select('inspection_timezone', $date ,old('inspection_timezone'), ['class' => 'form-control text-black form_select2','id'=>'inspection_timezone' ,'placeholder' => 'WAKTU', 'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_province_id">Provinsi: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_province_id', old('inspection_province_id'), ['class' => 'form-control text-black','id'=>'inspection_province_id' ,'placeholder' => 'Provinsi', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_city_id">Kabupaten: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_city_id', old('inspection_city_id'), ['class' => 'form-control text-black','id'=>'inspection_city_id' ,'placeholder' => 'Kabupaten', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_pic_name">Nama Petugas: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_pic_name', old('inspection_pic_name'), ['class' => 'form-control text-black','id'=>'inspection_pic_name' ,'placeholder' => 'Provinsi', 'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="inspection_pic_phone">No HP Petugas: <span class="text-danger">*</span></label>
                                {{ Form::text('inspection_pic_phone', old('inspection_pic_phone'), ['class' => 'form-control text-black','id'=>'inspection_pic_phone' ,'placeholder' => 'Provinsi', 'required']) }}
                            </div>
                        </div>
                        <label for="" class="col-lg-12">Tanggal dan Tempat Pelaksanaan Stuffing :</label>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="stuffing_office_id">Kantor Pengawasan Stuffing: <span class="text-danger">*</span></label>
                                {{ Form::select('stuffing_office_id', $stuffing ,old('stuffing_office_id'), ['class' => 'form-control text-black form_select2','id'=>'stuffing_office_id' ,'placeholder' => 'Kantor Pemeriksaan', 'required']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="stuffing_address">Alamat: <span class="text-danger">*</span></label>
                                {{ Form::textarea('stuffing_address', old('stuffing_address'), ['class' => 'form-control text-black','id'=>'stuffing_address' ,'placeholder' => 'Alamat',"rows"=>'2' ,'required']) }}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label class="form-label" for="stuffing_address">Tanggal: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::text('stuffing_date', old('stuffing_date'), ['class' => 'form-control text-black datePicker','id'=>'stuffing_date' ,'placeholder' => 'Tanggal' ,'required']) }}
                                    </div>
                                    <div class="col-md-3">
                                        {{ Form::select('stuffing_timezone', $date ,old('stuffing_timezone'), ['class' => 'form-control text-black form_select2','id'=>'stuffing_timezone' ,'placeholder' => 'WAKTU', 'required']) }}
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
                                {{ Form::select('memorize_type', $type ,old('memorize_type'), ['class' => 'form-control text-black','id'=>'memorize_type' ,'placeholder' => 'Type Pengapalan', 'required']) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::select('memorize_size', $size ,old('memorize_size'), ['class' => 'form-control text-black','id'=>'memorize_size' ,'placeholder' => 'Ukuran Pengapalan', 'required']) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::text('memorize_total', old('memorize_total'), ['class' => 'form-control text-black','id'=>'memorize_total' ,'placeholder' => 'Total' ,'required']) }}
                            </div>
                            <div class="col-md-3">
                                {{ Form::select('memorize_skenario', $skenario ,old('memorize_skenario'), ['class' => 'form-control text-black','id'=>'memorize_skenario' ,'placeholder' => 'Ukuran Pengapalan', 'required']) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_nib">NIB: </label>
                                    <div class="col-md-6 col-sm-9">
                                        <div class="row mb-4">
                                        <a href="{{url('ppbe_file/'.$data->file_nib)}}" target="_blank" class="me-2 text-left">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                </svg>
                                                Download File NIB
                                            </a>
                                        </div>
                                        <div class="row">
                                            <i class="text-danger text-sm-left mb-2">Unggah File jika Anda ingin Merubah</i>
                                            {{ Form::file('file_nib',['class' => 'dropify',"data-height"=>'50' ,'id'=>'file_nib','placeholder' => 'input',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" ]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_invoice">Invoice: </label>
                                    <div class="col-md-6 col-sm-9">
                                        <div class="row mb-4">
                                            <a href="{{asset('ppbe_file/'.    $data->file_invoice)}}" target="_blank" class="me-2">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                </svg>
                                                Download File Invoice
                                            </a>
                                        </div>
                                        <div class="row">
                                            <i class="text-danger text-sm-left mb-2">Unggah File jika Anda ingin Merubah</i>
                                            {{-- {{ Form::file('file_invoice',['class' => 'dropify',"data-height"=>'50' ,'id'=>'file_invoice','placeholder' => 'input', "data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" ]) }} --}}
                                            {{ Form::file('file_invoice',['class' => 'form-control',"data-height"=>'50' ,'id'=>'file_invoice','placeholder' => 'input', "data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" ]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_packing_list">Packing List: </label>
                                    <div class="col-md-6 col-sm-9">
                                        <div class="row mb-4">
                                            <a href="{{asset('ppbe_file/'.    $data->file_packing_list)}}" target="_blank" class="me-2">
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                </svg>
                                                Download File Packing List
                                            </a>
                                        </div>
                                        <div class="row">
                                            <i class="text-danger text-sm-left mb-2">Unggah File jika Anda ingin Merubah</i>
                                            {{ Form::file('file_packing_list',['class' => 'dropify',"data-height"=>'50','id'=>'file_packing_list','placeholder' => 'input', "data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" ]) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-6 mb-3">
                                <label class="form-label" for="file_invoice">ET & PE: <span class="text-danger">*</span></label>
                                {{ Form::file('file_invoice',['class' => 'dropify', 'id'=>'file_invoice','placeholder' => 'input' ,'required']) }}
                            </div> --}}
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <label for="other_reason" class="form-label">Catatan Lain</label>
                                {{Form::textarea('other_reason',old('other_reason'),['class'=>'form-control','id'=>'other_reason','placeholder'=>'Catatan','rows'=>'3'])}}
                            </div>
                        </div>
                        {{-- <div class="checkbox mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">
                                <label class="form-check-label" for="flexCheckDefault3">
                                    Dengan ini saya Menyatakan Bahwa data yang saya cantumkan sudah Benar dan asli, tidak ada kebohongan
                                </label>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-footer">
                        <div class="row justify-content-center">
                            <div class="col-md-4">
                                {{Form::hidden('update_btn','submitted',['class'=>'form-control','id'=>'update_btn','placeholder'=>'Catatan','disabled'])}}
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="btn btn-success me-2" id="send_btn" value="submitted">Ajukan PPBE</button>
                                <button type="submit" class="btn btn-warning me-2" name="update_btn" id="save_btn" value="draft">Simpan</button>
                                <a href="{{route('ppbe.index')}}" type="button" class="btn btn-danger me-2">Kembali</a>
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
