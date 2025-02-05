<x-app-layout :assets="$assets ?? []">
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
        <div class="">
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
                                        {{ Form::text('nomor_penganjuan', $data->code, ['class' => 'form-control text-black','id'=>'nomor_pengajuan' ,'placeholder' => 'Nomor PPBE', 'readonly']) }}
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="form-label" for="date_ppbe">Tanggal Pengajuan PPBE: <span class="text-danger">*</span></label>
                                        {{ Form::text('date_ppbe', $data->date_ppbe, ['class' => 'form-control text-black datePicker','id'=>'date_ppbe' ,'placeholder' => 'Tanggal PPBE', 'readonly']) }}
                                    </div>
                                </div>
                                <hr>
                                <h5 class="mb-4 text-secondary">DATA PEMOHON</h5>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="form-label" for="company_id">Nama Perusahaan: <span class="text-danger">*</span></label>
                                        <select name="company_id" class="form-control text-black select2" id="company_id" placeholder="Select Company Name" disabled>
                                            <option value="">Select Company Name</option>
                                            @foreach($data_company as $key => $company)
                                                <option value="{{ $company->id }}" {{ $data->company_id === $company->id ? 'selected' : '' }}>
                                                    {{ $company->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label for="pe_id" class="form-label">PE</label>
                                        <select name="pe_id" id="pe_id" class="form-control select2" disabled>
                                            <option value="">Pilih PE</option>
                                            @foreach ($data_pe as $key => $pe)
                                                <option value="{{$pe->id}}" {{$data->company_pe_id === $pe->id ? 'selected' : ''}}>
                                                    {{$pe->nomor_pe}}
                                                </option>
                                            @endforeach
                                        </select>
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
                                        <label class="form-label" for="npwp">NPWP: <span class="text-danger">*</span></label>
                                        {{ Form::text('npwp', old('npwp',$data->company->npwp), ['class' => 'form-control text-black','id'=>'npwp' ,'placeholder' => 'NPWP', 'readonly']) }}
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="form-label" for="company_address">Alamat: <span class="text-danger">*</span></label>
                                        {{ Form::textarea('company_address', old('company_address',$data->company->company_address), ['class' => 'form-control text-black','id'=>'company_address' ,'placeholder' => 'Alamat', 'readonly', 'rows'=>'2']) }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="form-label" for="pic">Nama: <span class="text-danger">*</span></label>
                                        {{ Form::text('pic', old('pic',$data->company->pic), ['class' => 'form-control text-black','id'=>'pic' ,'placeholder' => 'Penanggung Jawab', 'readonly']) }}
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="form-label" for="position">Jabatan: <span class="text-danger">*</span></label>
                                        {{ Form::text('position', old('position',$data->company->position), ['class' => 'form-control text-black','id'=>'position' ,'placeholder' => 'Jabatan', 'readonly']) }}
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
                                                <td>
                                                    {{-- {{ Form::text('barang['.$index.'][nomor_hs]', old('barang['.$index.'][nomor_hs]',$good->processed_level_id), ['class' => 'form-control text-black','id'=>'barang['.$index.'][nomor_hs]' ,'placeholder' => 'Nomor HS', 'readonly']) }} --}}
                                                    <select name="barang[{{$index}}][nomor_hs]" class="form-control select2" id="barang[{{$index}}][nomor_hs]" placeholder="Select Company Name" disabled>
                                                        <option value="">Select HS</option>
                                                        @foreach($hs_levels as $key => $level)
                                                            <option value="{{ $level->id }}" {{ $good->processed_level_id === $level->id ? 'selected' : '' }}>
                                                                {{ $level->hs }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
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
                                            {{ Form::select('packing_type', $type_kemasan , old('packing_type'),  ['class' => 'form-control text-black select2','id'=>'packing_type' ,'placeholder' => 'Pilih!', 'disabled']) }}
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
                                            {{-- {{ Form::select('fob_currency', $currency , $data->fob_currency,  ['class' => 'form-control text-black fob_currency select2','id'=>'fob_currency' ,'placeholder' => 'Pilih FOB', 'disabled']) }} --}}
                                            <select name="fob_currency" class="form-control select2" id="fob_currency" placeholder="Select FOB Currency" disabled>
                                                <option value="">Pilih Mata Uang</option>
                                                @foreach($currencies as $key => $currency)
                                                    <option value="{{ $currency->id }}" {{ $data->fob_currency === $currency->id ? 'selected' : '' }}>
                                                        {{ $currency->description}} ({{ $currency->code }})
                                                    </option>
                                                @endforeach
                                            </select>
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
                                    {{-- {{ Form::text('origin_port_id', old('origin_port_id'), ['class' => 'form-control text-black','id'=>'origin_port_id' ,'placeholder' => 'Pelabuhan Muat', 'required']) }} --}}
                                    <select name="origin_port_id" class="form-control select2 text-black" id="origin_port_id" placeholder="Pelabuhan Asal" disabled>
                                        <option value="">Pilih Pelabuhan Asal</option>
                                        @foreach($loading_port as $key => $port)
                                            <option value="{{ $port->id }}" {{ old('origin_port_id',$data->origin_port_id) === $port->id ? 'selected' : '' }}>
                                                {{ $port->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="loading_port_id">Pelabuhan Muat: <span class="text-danger">*</span></label>
                                    {{-- {{ Form::text('loading_port_id', old('loading_port_id'), ['class' => 'form-control text-black','id'=>'loading_port_id' ,'placeholder' => 'Pelabuhan Muat', 'readonly']) }} --}}
                                    <select name="loading_port_id" class="form-control select2 text-black" id="loading_port_id" placeholder="Pelabuhan Muat" disabled>
                                        <option value="">Pilih Pelabuhan Muat</option>
                                        @foreach($loading_port as $key => $port)
                                            <option value="{{ $port->id }}" {{ old('loading_port_id',$data->loading_port_id) === $port->id ? 'selected' : '' }}>
                                                {{ $port->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="country_id">Negara Tujuan: <span class="text-danger">*</span></label>
                                    <small class="text-info text-6">(tercantum di LS)</small>
                                    {{-- {{ Form::text('country_id', old('country_id'), ['class' => 'form-control text-black','id'=>'country_id' ,'placeholder' => 'Negara Tujuan', 'readonly']) }} --}}
                                    <select name="country_id" class="form-control select2 text-black" id="country_id" placeholder="Negara Tujuan" disabled>
                                        <option value="">Pilih Negara Tujuan</option>
                                        @foreach($countries as $key => $country)
                                            <option value="{{ $country->id }}" {{ old('country_id',$data->country_id) === $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="country_destination_id">Negara Tujuan : <span class="text-danger">*</span></label>
                                    {{-- {{ Form::text('country_destination_id', old('country_destination_id'), ['class' => 'form-control text-black','id'=>'country_destination_id' ,'placeholder' => 'Negara Tujuan', 'readonly']) }} --}}
                                    <select name="country_destination_id" class="form-control select2 text-black" id="country_destination_id" placeholder="Negara Tujuan" disabled>
                                        <option value="">Pilih Negara Tujuan</option>
                                        @foreach($countries as $key => $country)
                                            <option value="{{ $country->id }}" {{ old('country_destination_id',$data->country_destination_id) === $country->id ? 'selected' : '' }}>
                                                {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label for="destination_port_id" class="form-label">Pelabuhan Tujuan</label>
                                    {{-- {{ Form::text('destination_port_id', old('destination_port_id'), ['class' => 'form-control text-black','id'=>'destination_port_id' ,'placeholder' => 'Pelabuhan Tujuan', 'readonly']) }} --}}
                                    <select name="destination_port_id" class="form-control select2 text-black" id="destination_port_id" placeholder="Negara Tujuan" disabled>
                                        <option value="">Pilih Negara Tujuan</option>
                                        @foreach($destination_port as $key => $port)
                                            <option value="{{ $port->id }}" {{ old('destination_port_id',$data->destination_port_id) === $port->id ? 'selected' : '' }}>
                                                {{ $port->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                    {{-- {{ Form::select('inspection_office_id', $pemeriksaan ,old('inspection_office_id'), ['class' => 'form-control text-black form_select2','id'=>'inspection_office' ,'placeholder' => 'Kantor Pemeriksaan', 'disbaled']) }} --}}
                                    <select name="inspection_office_id" class="form-control select2 text-black" id="inspection_office_id" placeholder="Kantor Pemeriksaan" disabled>
                                        <option value="">Pilih Kantor Pemeriksaan</option>
                                        @foreach($office_branch as $key => $office)
                                            <option value="{{ $office->id }}" {{ old('inspection_office_id',$data->inspection_office_id) === $office->id ? 'selected' : '' }}>
                                                {{ $office->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                            {{ Form::select('inspection_timezone', $date ,old('inspection_timezone'), ['class' => 'form-control text-black select2','id'=>'inspection_timezone' ,'placeholder' => 'WAKTU', 'disabled']) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="inspection_province_id">Provinsi: <span class="text-danger">*</span></label>
                                    {{-- {{ Form::text('inspection_province_id', old('inspection_province_id'), ['class' => 'form-control text-black','id'=>'inspection_province_id' ,'placeholder' => 'Provinsi', 'readonly']) }} --}}
                                    <select name="inspection_province_id" class="form-control select2 text-black" id="inspection_province_id" placeholder="Provinsi" disabled>
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinces as $key => $province)
                                            <option value="{{ $province->id }}" {{ old('inspection_province_id',$data->inspection_province_id) === $province->id ? 'selected' : '' }}>
                                                {{ $province->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="inspection_city_id">Kabupaten: <span class="text-danger">*</span></label>
                                    {{-- {{ Form::text('inspection_city_id', old('inspection_city_id'), ['class' => 'form-control text-black','id'=>'inspection_city_id' ,'placeholder' => 'Kabupaten', 'readonly']) }} --}}
                                    <select name="inspection_city_id" class="form-control select2 text-black" id="inspection_city_id" placeholder="Kota/Kabupaten" disabled>
                                        <option value="">Pilih Kota/Kabupaten</option>
                                        @foreach($cities as $key => $city)
                                            <option value="{{ $city->id }}" {{ old('inspection_city_id',$data->inspection_city_id) === $city->id ? 'selected' : '' }}>
                                                {{ $city->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                {{-- {{dd($data)}} --}}
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="form-label" for="stuffing_office_id">Kantor Pengawasan Stuffing: <span class="text-danger">*</span></label>
                                    {{-- {{ Form::select('stuffing_office_id', $stuffing ,old('stuffing_office_id'), ['class' => 'form-control text-black form_select2','id'=>'stuffing_office_id' ,'placeholder' => 'Kantor Pemeriksaan', 'disabled']) }} --}}
                                    <select name="stuffing_office_id" class="form-control select2 text-black" id="stuffing_office_id" placeholder="Kantor Pemeriksaan" disabled>
                                        <option value="">Pilih Kantor Pemeriksaan</option>
                                        @foreach($office_branch as $key => $office)
                                            <option value="{{ $office->id }}" {{ old('stuffing_office_id',$data->stuffing_office_id) === $office->id ? 'selected' : '' }}>
                                                {{ $office->name }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                            {{ Form::select('stuffing_timezone', $date ,old('stuffing_timezone'), ['class' => 'form-control text-black select2','id'=>'stuffing_timezone' ,'placeholder' => 'WAKTU', 'disabled']) }}
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
                                <div class="">
                                </div>
                                <div class="col-md-9">
                                    {{-- <a href="{{route('ppbe.pdf_draft',$id)}}" type="button" class="btn btn-success me-2"  id="print">Print Draft PPBE</a>
                                    <button type="button" class="btn btn-primary me-2"  id="verify-btn" data-id="{{$id}}" disabled>Verifikasi PPBE</button>
                                    <button type="button" class="btn btn-danger me-2"  id="reject-send" data-id="{{$id}}" data-bs-toggle="modal" data-bs-target="#RejectModal">Tolak PPBE</button> --}}
                                    <a href="{{route('ppbe.index')}}" type="button" class="btn btn-secondary me-2">Kembali</a>
                                </div>
                                <div class="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
</x-app-layout>
