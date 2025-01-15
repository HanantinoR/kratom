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

        {{-- {{dd($data)}} --}}
        {!! Form::model($data, ['route' => ['ls.save'], 'method' => 'POST' , 'enctype' => 'multipart/form-data','id'=>'form_edit']) !!}
            @csrf
        @if ($state === "verified")
            {{ Form::hidden('hplps_id', old('hplps_id', $id), ['class' => 'form-control text-black', 'id' => 'hplps_id', 'readonly']) }}
        @else
            {{ Form::hidden('ppbe_id', old('ppbe_id', $id), ['class' => 'form-control text-black', 'id' => 'ppbe_id', 'readonly']) }}
        @endif
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-center">
                        <h3 class="card-title">Hasil Pemeriksaan Lapangan & Pengawasan Stuffing (HPL-PS)</h3>
                        <div class="card-action">
                            {{-- <a href="{{ route('ppbe.index') }}" class="btn btn-sm btn-primary" role="button">Back</a> --}}
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <h5 class="mb-4 text-secondary">A. PEMERIKSAAN (HPL)</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="inspection_date" class="form-label">Tanggal: <span class="text-danger">*</span></label>
                                        <input type="datetime-local" id="inspection_date" name="inspection_date" class="form-control text-black" value="{{ old('inspection_date', date('Y-m-d\TH:i', strtotime($data->assignments->penugasan_date)))}}" readonly>
                                        {{-- {{ Form::datetimeLocal('inspection_date', old('inspection_date',$data->insepction_date), ['class' => 'form-control text-black', 'id' => 'inspection_date', 'required']) }} --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="npp" class="form-label">NPP/Surveyor Pemeriksa: <span class="text-danger">*</span></label>
                                        {{ Form::text('npp', old('npp', $surveyor->first_name." ".$surveyor->last_name), ['class' => 'form-control text-black', 'id' => 'npp', 'readonly']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="no_ppbe" class="form-label">NO PPBE: <span class="text-danger">*</span></label>
                                <a href="{{route('ppbe.edit',$data->id)}}" target="_blank"><h4 class="ms-4 mt-2 text-info text-center">{{$data->code}}</h4></a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="npwp" class="form-label">NPWP: <span class="text-danger">*</span></label>
                                {{ Form::text('npwp', old('npwp',$data->company->npwp), ['class' => 'form-control text-black', 'id' => 'npwp', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="name" class="form-label">Nama Eksportir: <span class="text-danger">*</span></label>
                                {{ Form::text('name', old('name',$data->company->name), ['class' => 'form-control text-black', 'id' => 'nama_eksp', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="position" class="form-label">Jabatan Petugas Eksportir: <span class="text-danger">*</span></label>
                                {{ Form::text('position', old('position',$data->company->position), ['class' => 'form-control text-black', 'id' => 'company_position', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="pic" class="form-label">Nama Petugas Eksportir: <span class="text-danger">*</span></label>
                                {{ Form::text('pic', old('pic', $data->company->pic), ['class' => 'form-control text-black', 'id' => 'pic', 'readonly']) }}
                            </div>
                        </div>
                        {{-- <hr> --}}
                        {{-- <div class="row">
                            <div class="form-group col-md-6">
                                <label for="origin_port_id" class="form-label">Pelabuhan asal: <span class="text-danger">*</span></label>
                                <select name="origin_port_id" class="form-control text-black select2" id="origin_port_id" placeholder="Pelabuhan Asal" disabled>
                                    <option value="">Pilih Pelabuhan Asal</option>
                                    @foreach($loading_port as $key => $port)
                                        <option value="{{ $port->id }}" {{ $data->origin_port_id === $port->id ? 'selected' : '' }}>
                                            {{ $port->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="loading_port_id" class="form-label">Pelabuhan Muat: <span class="text-danger">*</span></label>
                                <select name="loading_port_id" class="form-control text-black select2" id="loading_port_id" placeholder="Pelabuhan Muat" disabled>
                                    <option value="">Pilih Pelabuhan Muat</option>
                                    @foreach($loading_port as $key => $port)
                                        <option value="{{ $port->id }}" {{ $data->loading_port_id === $port->id ? 'selected' : '' }}>
                                            {{ $port->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="destination_port_id" class="form-label">Pelabuhan Tujuan: <span class="text-danger">*</span></label>
                                <select name="destination_port_id" class="form-control text-black select2" id="destination_port_id" placeholder="Negara Pelabuhan" disabled>
                                    <option value="">Pilih Pelabuhan Tujuan</option>
                                    @foreach($destination_port as $key => $port)
                                        <option value="{{ $port->id }}" {{ $data->destination_port_id === $port->id ? 'selected' : '' }}>
                                            {{ $port->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country_destination_id" class="form-label">Negara Pelabuhan Tujuan: <span class="text-danger">*</span></label>
                                <select name="country_destination_id" class="form-control text-black select2" id="country_destination_id" placeholder="Negara Tujuan" disabled>
                                    <option value="">Pilih Negara Tujuan</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $country->id }}" {{ $data->country_destination_id === $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="country_destination_id" class="form-label">Negara Tujuan: <span class="text-danger">*</span></label>
                                <select name="country_id" class="form-control text-black select2" id="country_id" placeholder="Negara Tujuan" disabled>
                                    <option value="">Pilih Negara Tujuan</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $country->id }}" {{ $data->country_id === $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fob_total" class="form-label">Nilai FOB PPBE*: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::number('fob_total', old('fob_total'), ['class' => 'form-control text-black', 'id' => 'fob_total', 'step' => '0.01', 'readonly']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::text('fob_currency', old('fob_currency', $currencies[$data->fob_currency-1]->description ." (" .$currencies[$data->fob_currency-1]->code.")"), ['class' => 'form-control text-black', 'id' => 'fob_currency', 'readonly']) }}
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="row">
                            <div class="form-group col-md-6">
                                <label for="origin_port_id" class="form-label">Pelabuhan asal: <span class="text-danger">*</span></label>
                                {{ Form::text('origin_port_id', old('origin_port_id', $data->origin_port_id), ['class' => 'form-control text-black', 'id' => 'origin_port_id', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="loading_port_id" class="form-label">Pelabuhan Muat: <span class="text-danger">*</span></label>
                                {{ Form::text('loading_port_id', old('loading_port_id', $data->loading_port_id), ['class' => 'form-control text-black', 'id' => 'loading_port_id', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="destination_port_id" class="form-label">Pelabuhan Tujuan: <span class="text-danger">*</span></label>
                                {{ Form::text('destination_port_id', old('destination_port_id', $data->destination_port_id), ['class' => 'form-control text-black', 'id' => 'destination_port_id', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country_destination_id" class="form-label">Negara Tujuan: <span class="text-danger">*</span></label>
                                {{ Form::text('country_destination_id', old('country_destination_id', $data->country_destination_id), ['class' => 'form-control text-black', 'id' => 'country_destination_id', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="fob_total" class="form-label">Nilai FOB PPBE*: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ Form::number('fob_total', old('fob_total'), ['class' => 'form-control text-black', 'id' => 'fob_total', 'step' => '0.01', 'readonly']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::number('fob_currency', old('fob_currency'), ['class' => 'form-control text-black', 'id' => 'fob_currency', 'step' => '0.01', 'readonly']) }}
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="packing_list_number" class="form-label">Nomor Packing List: <span class="text-danger">*</span></label>
                                {{ Form::text('packing_list_number', old('packing_list_number'), ['class' => 'form-control text-black', 'id' => 'packing_list_number', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="packing_list_date" class="form-label"> Tgl. Packing List: <span class="text-danger">*</span></label>
                                {{ Form::text('packing_list_date', old('packing_list_date'), ['class' => 'form-control text-black', 'id' => 'packing_list_date', 'readonly']) }}
                                <small class="text-gray-500">Tanggal Packing List tidak boleh lebih dari tanggal pengajuan</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="invoice_number" class="form-label">Nomor Invoice: <span class="text-danger">*</span></label>
                                {{ Form::text('invoice_number', old('invoice_number'), ['class' => 'form-control text-black', 'id' => 'invoice_number', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="invoice_date" class="form-label">Tgl. Invoice: <span class="text-danger">*</span></label>
                                {{ Form::text('invoice_date', old('invoice_date'), ['class' => 'form-control text-black', 'id' => 'invoice_date', 'readonly']) }}
                                <small class="text-gray-500">Tanggal Invoice tidak boleh lebih dari tanggal pengajuan</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="buyer_name" class="form-label">Nama Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::text('buyer_name', old('buyer_name'), ['class' => 'form-control text-black', 'id' => 'buyer_name', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="buyer_address" class="form-label">Alamat Pembeli: <span class="text-danger">*</span></label>
                                {{ Form::textarea('buyer_address', old('buyer_address'), ['class' => 'form-control text-black', 'id' => 'buyer_address', 'rows' => 2, 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="origin_port_id" class="form-label">Pelabuhan asal: <span class="text-danger">*</span></label>
                                {{-- {{ Form::text('origin_port_id', old('origin_port_id', $data->origin_port_id), ['class' => 'form-control text-black', 'id' => 'origin_port_id', 'readonly']) }} --}}
                                <select name="origin_port_id" class="form-control text-black select2" id="origin_port_id" placeholder="Pelabuhan Asal" disabled>
                                    <option value="">Pilih Pelabuhan Asal</option>
                                    @foreach($loading_port as $key => $port)
                                        <option value="{{ $port->id }}" {{ $data->origin_port_id === $port->id ? 'selected' : '' }}>
                                            {{ $port->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="loading_port_id" class="form-label">Pelabuhan Muat: <span class="text-danger">*</span></label>
                                {{-- {{ Form::text('loading_port_id', old('loading_port_id', $data->loading_port_id), ['class' => 'form-control text-black', 'id' => 'loading_port_id', 'readonly']) }} --}}
                                <select name="loading_port_id" class="form-control text-black select2" id="loading_port_id" placeholder="Pelabuhan Muat" disabled>
                                    <option value="">Pilih Pelabuhan Muat</option>
                                    @foreach($loading_port as $key => $port)
                                        <option value="{{ $port->id }}" {{ $data->loading_port_id === $port->id ? 'selected' : '' }}>
                                            {{ $port->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="destination_port_id" class="form-label">Pelabuhan Tujuan: <span class="text-danger">*</span></label>
                                {{-- {{ Form::text('destination_port_id', old('destination_port_id', $data->destination_port_id), ['class' => 'form-control text-black', 'id' => 'destination_port_id', 'readonly']) }} --}}
                                <select name="destination_port_id" class="form-control text-black select2" id="destination_port_id" placeholder="Negara Pelabuhan" disabled>
                                    <option value="">Pilih Pelabuhan Tujuan</option>
                                    @foreach($destination_port as $key => $port)
                                        <option value="{{ $port->id }}" {{ $data->destination_port_id === $port->id ? 'selected' : '' }}>
                                            {{ $port->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country_destination_id" class="form-label">Negara Pelabuhan Tujuan: <span class="text-danger">*</span></label>
                                <select name="country_destination_id" class="form-control text-black select2" id="country_destination_id" placeholder="Negara Tujuan" disabled>
                                    <option value="">Pilih Negara Tujuan</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $country->id }}" {{ $data->country_destination_id === $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="country_destination_id" class="form-label">Negara Tujuan: <span class="text-danger">*</span></label>
                                {{-- {{ Form::text('country_destination_id', old('country_destination_id', $data->country_destination_id), ['class' => 'form-control text-black', 'id' => 'country_destination_id', 'readonly']) }} --}}
                                <select name="country_id" class="form-control text-black select2" id="country_id" placeholder="Negara Tujuan" disabled>
                                    <option value="">Pilih Negara Tujuan</option>
                                    @foreach($countries as $key => $country)
                                        <option value="{{ $country->id }}" {{ $data->country_id === $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-center bg-primary">
                        <h3 class="card-title text-white"></h3>
                        <div class="card-action">
                            <a href=""></a>
                        </div>
                    </div>
                    @php
                        $check = json_decode($data->hplps->checker_list);
                    @endphp
                    <div class="card-body">
                        <h5 class="mb-4 text-secondary">KEMASAN</h5>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="merk" class="form-label">Merek Kemasan (Shipping Merk): <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-10">
                                        {{ Form::textarea('merk', old('merk'), ['class' => 'form-control text-black', 'id' => 'merk', 'rows'=>2,'readonly']) }}
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-small btn-icon btn-warning mt-3 edit_readonly" name="merk_btn">
                                            <svg height="24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0" d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z" fill="currentColor"></path>
                                                <path d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z" fill="currentColor"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="checkbox-wrapper-input">
                                            <input type="checkbox" id="check_merk" class="check_hplps" name="check_merk" {{$check->merk_checked === "on" ? "checked" : ""}}/>
                                            <label for="check_merk" class="check-box mt-4">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="packing_total" class="form-label">Jumlah dan Jenis Kemasan: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-5">
                                        {{ Form::text('packing_total', old('packing_total'), ['class' => 'form-control text-black', 'id' => 'packing_total', 'readonly']) }}
                                    </div>
                                    <div class="col-md-5">
                                        <select name="packing_type" class="form-control select2" id="packing_type" placeholder="Select FOB Currency" disabled>
                                            <option value="">Pilih Kemasan</option>
                                            @foreach($type_kemasan as $key => $kemasan)
                                                <option value="{{ $key }}" {{ $data->packing_type === $key ? 'selected' : '' }}>
                                                    {{$kemasan}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-small btn-icon btn-warning mt-1 edit_readonly" name="packing_btn">
                                            <svg height="24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="">
                                                <path opacity="0" d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z" fill="currentColor"></path>
                                                <path d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z" fill="currentColor"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-md-1" >
                                        <div class="checkbox-wrapper-input">
                                            <input type="checkbox" id="check_packing" class="check_hplps" name="check_packing" disabled {{$check->check_packing === "on" ? "checked" : ""}} />
                                            <label for="check_packing" class="check-box mt-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inspection_date_start" class="form-label">Waktu Pemeriksaan: <span class="text-danger">*</span></label>
                                <input type="datetime-local" id="inspection_date_start" name="inspection_date_start" class="form-control text-black" value="{{ old('inspection_date_start', $data->hplps->inspection_date_start)}}" disabled>
                                {{-- {{ Form::text('inspection_date_start', old('inspection_date_start',$data->inspection_date_start), ['class' => 'form-control text-black', 'id' => 'inspection_date_start', 'readonly',"data-date-format"=>"yyyy-mm-dd hh-mm"]) }} --}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inspection_date_end" class="form-label">S/D: <span class="text-danger">*</span></label>
                                <input type="datetime-local" id="inspection_date_end" name="inspection_date_end" class="form-control text-black" value="{{ old('inspection_date_end', $data->hplps->inspection_date_end)}}" disabled>
                                {{-- {{ Form::text('inspection_date_end', old('inspection_date_end'), ['class' => 'form-control text-black', 'id' => 'inspection_date_end', 'readonly']) }} --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inspection_office_id" class="form-label">Kantor Pemeriksaan Barang: <span class="text-danger">*</span></label>
                                <select name="inspection_office_id" class="form-control select2" id="inspection_office_id" placeholder="Kantor Pemeriksaan" disabled>
                                    <option value="">Pilih Kantor Pemeriksaan</option>
                                    @foreach($office_branch as $key => $office)
                                        <option value="{{ $office->id }}" {{ old('inspection_office_id', $data->inspection_office_id) == $office->id ? 'selected' : '' }}>
                                            {{ $office->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="inspection_address" class="form-label">Tempat Pemeriksaan: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-10">
                                        {{ Form::text('inspection_address', old('inspection_address'), ['class' => 'form-control text-black', 'id' => 'inspection_address', 'readonly']) }}
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-small btn-icon btn-warning mt-1 edit_readonly" name="inspection_btn">
                                            <svg height="24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0" d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z" fill="currentColor"></path>
                                                <path d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z" fill="currentColor"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="checkbox-wrapper-input">
                                            <input type="checkbox" id="check_inspection" class="check_hplps" name="check_inspection" {{$check->check_inspection === "on" ? "checked" : ""}}/>
                                            <label for="check_inspection" class="check-box mt-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inspection_province_id" class="form-label">Provinsi (Tercantum Pada LS): <span class="text-danger">*</span></label>
                                {{-- {{ Form::text('inspection_province_id', old('inspection_province_id'), ['class' => 'form-control text-black', 'id' => 'inspection_province_id', 'required']) }} --}}
                                <select name="inspection_province_id" class="form-control select2" id="inspection_province_id" placeholder="Provinsi" disabled>
                                    <option value="">Pilih Provinsi</option>
                                    @foreach($provinces as $key => $province)
                                        <option value="{{ $province->id }}" {{ old('inspection_province_id', $data->inspection_province_id) == $province->id ? 'selected' : '' }}>
                                            {{ $province->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inspection_city_id" class="form-label">Kab. / Kota (Tercantum Pada LS): <span class="text-danger">*</span></label>
                                {{-- {{ Form::text('inspection_city_id', old('inspection_city_id'), ['class' => 'form-control text-black', 'id' => 'inspection_city_id', 'required']) }} --}}
                                <select name="inspection_city_id" class="form-control select2" id="inspection_city_id" placeholder="Kota/Kabupaten" disabled>
                                    <option value="">Pilih Kota/Kabupaten</option>
                                    @foreach($cities as $key => $city)
                                        <option value="{{ $city->id }}" {{ old('inspection_city_id', $data->inspection_city_id) == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped" role="grid" id="form_barang">
                                <thead>
                                    <tr class="bg-primary">
                                        <th class="text-white text-center">hs</th>
                                        <th class="text-white text-center">uraian</th>
                                        <th class="text-white text-center">jumlah</th>
                                        <th class="text-white text-center">fob</th>
                                        <th class="text-white text-center">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->goods as $index => $good)
                                    <tr>
                                        <td>
                                            <select name="barang[{{$index}}][nomor_hs]" class="form-control select2" id="barang[{{$index}}][nomor_hs]" placeholder="Select Company Name" style="width: 100%;" disabled>
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
                                            {{-- <button class="btn btn-sm btn-icon btn-success btn_tambah" id="tambah_row" type="button">
                                                <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>
                                                </svg>
                                            </button> --}}
                                            -
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="fob_total_hpl" class="form-label">Total FOB: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-8">
                                        {{ Form::text('fob_total_hpl', old('fob_total_hpl', !empty($hplps)? $hplps->fob_total: $data->fob_total), ['class' => 'form-control text-black', 'id' => 'fob_total_hpl', 'readonly']) }}
                                    </div>
                                    <div class="col-md-4">
                                        <select name="fob_currency_hpl" class="form-control select2" id="fob_currency_hpl" placeholder="Select FOB Currency" disabled>
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
                        <label for="" class="mb-2">Cara Pengapalan <span class="text-danger"> (Jika ada perubahan data, harap hubungi Koordinator Cabang!)</span></label>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="memorize_type">Tipe</label>
                                {{ Form::select('memorize_type', $type ,old('memorize_type'), ['class' => 'form-control text-black','id'=>'memorize_type' ,'placeholder' => 'Type Pengapalan', 'readonly']) }}
                            </div>
                            <div class="col-md-3">
                                <label for="memorize_size">Ukuran</label>
                                {{ Form::select('memorize_size', $size ,old('memorize_size'), ['class' => 'form-control text-black','id'=>'memorize_size' ,'placeholder' => 'Ukuran Pengapalan', 'readonly']) }}
                            </div>
                            <div class="col-md-3">
                                <label for="memorize_total">Jumlah</label>
                                {{ Form::text('memorize_total', old('memorize_total'), ['class' => 'form-control text-black','id'=>'memorize_total' ,'placeholder' => 'Total' ,'readonly']) }}
                            </div>
                            <div class="col-md-3">
                                <label for="memorize_skenario">Skenario</label>
                                {{ Form::select('memorize_skenario', $skenario ,old('memorize_skenario'), ['class' => 'form-control text-black','id'=>'memorize_skenario' ,'placeholder' => 'Ukuran Pengapalan', 'readonly']) }}
                            </div>
                        </div>
                        <hr>
                        <div class="row d-flex justify-content-between">
                            <div class="col-lg-3 col-md-3">
                                Penggunaan BCOPS
                            </div>
                            {{-- <div class="col-lg-3 col-md-3">
                                Jumlah BCOPS : 0
                            </div> --}}
                        </div>
                        <div class="row mt-2">
                            <div class="table-responsive">
                                <table class="table form-table table-striped table-responsive-lg table-hover" role="grid" id="form_bcops_usage">
                                    <thead class="text-center">
                                        <tr class="bg-primary">
                                            <td class="text-white text-center">JENIS</td>
                                            <td class="text-white text-center">BCOPS</td>
                                            <td class="text-white text-center">AKSI</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{dd($data->hplps->usage)}} --}}
                                        @foreach ($data->hplps->usage as $index => $usage)
                                            <tr>
                                                <td>
                                                    <select name="usage[{{$index}}][type]" class="form-control select2" id="usage[{{$index}}][type]" placeholder="Select FOB Currency" style="width:100%" disabled>
                                                        <option value="">Pilih Segel Kemas</option>
                                                            <option value="1" {{ old('usage['.$index.'][type]', $usage['type']) == 1 ? 'selected' : '' }}>TPS MERAH</option>
                                                            <option value="2" {{ old('usage['.$index.'][type]', $usage['type']) == 2 ? 'selected' : '' }}>TPS HIJAU</option>
                                                            <option value="3" {{ old('usage['.$index.'][type]', $usage['type']) == 3 ? 'selected' : '' }}>LOCK SEAL</option>
                                                            <option value="4" {{ old('usage['.$index.'][type]', $usage['type']) == 4 ? 'selected' : '' }}>THREAD SEAL</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-lg-2 mt-2">No. Seri</div>
                                                        <div class="col-lg-3">
                                                            {{ Form::text('usage[$index][series]', old('usage[$index][series]', $usage['series']), ['class' => 'form-control text-black', 'id' => 'usage[$index][series]','readonly']) }}
                                                        </div>
                                                        <div class="col-lg-3">
                                                            {{ Form::text('usage[$index][init]', old('usage[$index][init]', $usage['series_init']), ['class' => 'form-control text-black', 'id' => 'usage[$index][init]','readonly']) }}
                                                        </div>
                                                        <div class="col-lg-1 mt-2">
                                                            S/D
                                                        </div>
                                                        <div class="col-lg-3">
                                                            {{ Form::text('usage[$index][final]', old('usage[$index][final]', $usage['series_final']), ['class' => 'form-control text-black', 'id' => 'usage[$index][final]','readonly']) }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{-- <button class="btn btn-sm btn-icon btn-success btn_tambah_usage" id="tambah_row" type="button">
                                                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>
                                                        </svg>
                                                    </button> --}}
                                                    -
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="hpl_notes" class="form-label">Catatan Pemeriksaan: <span class="text-danger">*</span></label>
                                {{ Form::textarea('hpl_notes', old('hpl_notes', $data->hplps->hpl_notes), ['class' => 'form-control text-black', 'id' => 'hpl_notes', 'readonly','rows'=>4]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title"></h3>
                        <div class="card-action"></div>
                    </div>
                    <div class="card-body">
                        <h5 class="mb-4 text-secondary">B. PENGAWASAN STUFFING (HPL)</h5>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="stuffing_date_start" class="form-label">Waktu Pengawasan: <span class="text-danger">*</span></label>
                                <input type="datetime-local" id="stuffing_date_start" name="stuffing_date_start" class="form-control text-black" value="{{ old('stuffing_date_start',$data->hplps->stuffing_date_start)}}" disabled>
                                {{-- {{ Form::text('stuffing_date_start', old('stuffing_date_start'), ['class' => 'form-control text-black', 'id' => 'stuffing_date_start', 'readonly']) }} --}}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="stuffing_date_end" class="form-label">S/D: <span class="text-danger">*</span></label>
                                <input type="datetime-local" id="stuffing_date_end" name="stuffing_date_end" class="form-control text-black" value="{{ old('stuffing_date_end', $data->hplps->stuffing_date_end)}}" disabled>
                                {{-- {{ Form::text('stuffing_date_end', old('stuffing_date_end'), ['class' => 'form-control text-black', 'id' => 'stuffing_date_end', 'readonly']) }} --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="stuffing_office_id" class="form-label">Kantor Pengawasan Stuffing: <span class="text-danger">*</span></label>
                                <select name="stuffing_office_id" class="form-control select2" id="stuffing_office_id" placeholder="Kantor Stuffing" disabled>
                                    <option value="">Pilih Kantor Stuffing</option>
                                    @foreach($office_branch as $key => $office)
                                        <option value="{{ $office->id }}" {{ old('stuffing_office_id', $data->stuffing_office_id) == $office->id ? 'selected' : '' }}>
                                            {{ $office->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-8">
                                <label for="stuffing_address" class="form-label">Tempat Stuffing: <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-10">
                                        {{ Form::text('stuffing_address', old('stuffing_address'), ['class' => 'form-control text-black', 'id' => 'stuffing_address', 'readonly']) }}
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-small btn-icon btn-warning mt-1 edit_readonly" name="stuffing_btn">
                                            <svg height="24" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path opacity="0" d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z" fill="currentColor"></path>
                                                <path d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z" fill="currentColor"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="checkbox-wrapper-input">
                                            <input type="checkbox" id="check_stuffing" class="check_stuffing" name="check_stuffing"/>
                                            <label for="check_stuffing" class="check-box mt-2">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="table-responsive" style="overflow-x:auto;">
                                <table class="table form-table table-striped table-responsive-lg table-hover" id="form_pengapalan" style="width:140%">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th class="text-white text-center p-1" style="text-wrap: pretty;!i;!;max-width:70px">Cara Pengapalan</th>
                                            <th class="text-white text-center p-1" style="max-width: 110px">No Peti Kemas</th>
                                            <th class="text-white text-center p-1" style="text-wrap: pretty;max-width: 50px;">Jenis Peti Kemas</th>
                                            <th class="text-white text-center p-1" style="max-width: 50px">Ukuran</th>
                                            <th class="text-white text-center p-1" style="max-width: ">No Segel</th>
                                            <th class="text-white text-center p-1" style="max-width: 100px">Jumlah Kemasan</th>
                                            <th class="text-white text-center p-1" style="max-width: ">TPS</th>
                                            <th class="text-white text-center p-1" style="max-width: ">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->hplps->memory as $memory)
                                        {{-- {{dd($memory, $data->hplps->memory)}} --}}
                                            <tr class="">
                                            <td class="p-1 ">
                                                {{ Form::text('memorizations[0][type]', old('memorizations[0][type]',$memory['type']), ['class' => 'form-control text-black', 'id' => 'memorizations[0][type]', 'readonly']) }}
                                            </td>
                                            <td class="p-1">
                                                {{ Form::text('memorizations[0][create_number]', old('memorizations[0][create_number]',$memory['create_number']), ['class' => 'form-control text-black', 'id' => 'memorizations[0][create_number]', 'readonly']) }}
                                            </td>
                                            <td class="p-1 ">
                                                {{ Form::text('memorizations[0][create_type]', old('memorizations[0][create_type]',$memory['create_type']), ['class' => 'form-control text-black', 'id' => 'memorizations[0][create_type]', 'readonly']) }}
                                            </td>
                                            <td class="p-1 ">
                                                {{ Form::text('memorizations[0][size]', old('memorizations[0][size]',$memory['size']), ['class' => 'form-control text-black', 'id' => 'memorizations[0][size]', 'readonly']) }}
                                            </td>
                                            <td class="p-1 ">
                                                <div class="row ">
                                                    <div class="col-md-12 col-lg-12 ">
                                                        <div class="row ">
                                                            <div class="col-md-1 col-lg-1 me-1">
                                                                <div class="checkbox-wrapper-input">
                                                                    <input type="checkbox" id="check_segel[0]" name="check_segel[0]" data-id="0" class="checkbox_segel"/>
                                                                    <label for="check_segel[0]" class="check-box mt-2">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 col-lg-4 pe-1">
                                                                {{ Form::text('memorizations[0][series]', old('memorizations[0][series]',$memory['series']), ['class' => 'form-control text-black segel-0', 'id' => 'memorizations[0][series]', 'readonly']) }}
                                                            </div>
                                                            <div class="col-md-5 col-lg-6 ps-1">
                                                                {{ Form::text('memorizations[0][series_init]', old('memorizations[0][series_init]',$memory['series_init']), ['class' => 'form-control text-black segel-0', 'id' => 'memorizations[0][series_init]', 'readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-1 ">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12">
                                                        <div class="row">
                                                            <div class="col-md-6 col-lg-6 pe-1">
                                                                {{ Form::text('memorizations[0][series_total]', old('memorizations[0][series_total]',$memory['series_total']), ['class' => 'form-control text-black', 'id' => 'memorizations[0][series_total]', 'readonly']) }}
                                                            </div>
                                                            <div class="col-md-6 col-lg-6 ps-1">
                                                                {{ Form::text('memorizations[0][series_type]', old('memorizations[0][series_type]',$memory['series_type']), ['class' => 'form-control text-black', 'id' => 'memorizations[0][series_type]', 'readonly']) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="">
                                                {{-- {{$merah =""}} --}}
                                                @if($memory['tps_merah'] != "" || !empty($memory['tps_merah']))
                                                        @php
                                                            $merah = json_decode($memory['tps_merah']);
                                                        @endphp
                                                    @foreach ($merah as $tps_merah)
                                                        <div class="row">
                                                            <label for="memorizations[0][red_series]">TPS Merah</label>
                                                            <div class="red_field" id="red_field_0">
                                                                <div class="row">
                                                                    <div class="col-md-3 p-1">
                                                                        {{ Form::text('memorizations[0][red_series][0]', old('memorizations[0][red_series][0]', $tps_merah->series), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][red_series][0]', 'readonly','disabled']) }}
                                                                    </div>
                                                                    <div class="col-md-4 p-1">
                                                                        {{ Form::text('memorizations[0][red_init][0]', old('memorizations[0][red_init][0]',$tps_merah->red_init), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][red_init][0]', 'readonly','disabled']) }}
                                                                    </div>
                                                                    <div class="col-md-4 p-1">
                                                                        {{ Form::text('memorizations[0][red_final][0]', old('memorizations[0][red_final][0]',$tps_merah->red_final), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][red_final][0]', 'readonly','disabled']) }}
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <button type="button" class="btn btn-sm btn-icon btn-warning btn_tps_merah_0 mt-2" id="btn_tps_merah_0" name="btn_tps_merah[0]" target="0" disabled>
                                                                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                                @if ($memory['tps_hijau'] != "" || !empty($memory['tps_hijau']))
                                                    @php
                                                        $hijau = json_decode($memory['tps_hijau']);
                                                    @endphp
                                                    @foreach ($hijau as $tps_hijau)
                                                    <div class="row">
                                                        <label for="memorizations[0][green_series]">TPS Hijau</label>
                                                        <div class="green_field" id="green_field_0">
                                                            <div class="row">
                                                                <div class="col-md-3 p-1">
                                                                    {{ Form::text('memorizations[0][green_series][0]', old('memorizations[0][green_series][0]',$tps_hijau->series), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][green_series][0]', 'readonly','disabled']) }}
                                                                </div>
                                                                <div class="col-md-4 p-1">
                                                                    {{ Form::text('memorizations[0][green_init][0]', old('memorizations[0][green_init][0]',$tps_hijau->green_init), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][green_init][0]', 'readonly','disabled']) }}
                                                                </div>
                                                                <div class="col-md-4 p-1">
                                                                    {{ Form::text('memorizations[0][green_final][0]', old('memorizations[0][green_final][0]',$tps_hijau->green_final), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][green_final][0]', 'readonly','disabled']) }}
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button type="button" class="btn btn-sm btn-icon btn-warning btn_tps_hijau_0 mt-2" id="btn_tps_hijau_0" name="btn_tps_hijau[0]" target="0" disabled>
                                                                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>
                                                                        </svg>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                                @if($memory['thread_seal']!= "")
                                                    @php
                                                        $seal = json_decode($memory['thread_seal']);
                                                    @endphp
                                                    @foreach ($seal as $thread_seal)
                                                    <div class="row">
                                                        <label for="memorizations[0][thread_seal_series]">Thread Seal</label>
                                                        <div class="thread_field" id="thread_field_0">
                                                            <div class="row">
                                                                <div class="col-md-3 p-1">
                                                                    {{ Form::text('memorizations[0][thread_seal_series][0]', old('memorizations[0][thread_seal_series][0]',$thread_seal->series), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][thread_seal_series][0]', 'readonly','disabled']) }}
                                                                </div>
                                                                <div class="col-md-4 p-1">
                                                                    {{ Form::text('memorizations[0][thread_seal_init][0]', old('memorizations[0][thread_seal_init][0]',$thread_seal->thread_seal_init), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][thread_seal_init][0]', 'readonly','disabled']) }}
                                                                </div>
                                                                <div class="col-md-4 p-1">
                                                                    {{ Form::text('memorizations[0][thread_seal_final][0]', old('memorizations[0][thread_seal_final][0]',$thread_seal->thread_seal_final), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][thread_seal_final][0]', 'readonly','disabled']) }}
                                                                </div>
                                                                <div class="col-md-1">
                                                                    {{-- <button type="button" class="btn btn-sm btn-icon btn-warning  btn_thread_seal_0 mt-2" id="btn_thread_seal_0" name="btn_thread_seal[0]" target="0" disabled>
                                                                        <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>
                                                                        </svg>
                                                                    </button> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="">
                                                {{-- <button class="btn btn-sm btn-icon btn-success btn_tambah_hplps" id="tambah_row" type="button">
                                                    <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.33 2H16.66C20.06 2 22 3.92 22 7.33V16.67C22 20.06 20.07 22 16.67 22H7.33C3.92 22 2 20.06 2 16.67V7.33C2 3.92 3.92 2 7.33 2ZM12.82 12.83H15.66C16.12 12.82 16.49 12.45 16.49 11.99C16.49 11.53 16.12 11.16 15.66 11.16H12.82V8.34C12.82 7.88 12.45 7.51 11.99 7.51C11.53 7.51 11.16 7.88 11.16 8.34V11.16H8.33C8.11 11.16 7.9 11.25 7.74 11.4C7.59 11.56 7.5 11.769 7.5 11.99C7.5 12.45 7.87 12.82 8.33 12.83H11.16V15.66C11.16 16.12 11.53 16.49 11.99 16.49C12.45 16.49 12.82 16.12 12.82 15.66V12.83Z" fill="currentColor"></path>
                                                    </svg>
                                                </button> --}}
                                                -
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <label for="">Hasil Analisis <span class="text-danger"> (Pemilihan hasil analisis akan menghasilkan LHP)</span></label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="checkbox-wrapper-input">
                                    <input type="checkbox" id="check_technical_error" class="check_hplps" name="check_technical_error"/>
                                    <label for="check_technical_error" class="check-box mt-4"></label>
                                    <span>Cacat Teknis</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="checkbox-wrapper-input">
                                    <input type="checkbox" id="check_spec_error" class="check_hplps" name="check_spec_error"/>
                                    <label for="check_spec_error" class="check-box mt-4"></label>
                                    <span>Spesifikasi Teknis Tidak Memenuhi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        @if ($state)
                            <button type="submit" class="btn btn-success me-2">Verifikasi Tanda Tangan</button>
                        @endif
                        <button type="button" class="btn btn-secondary"> Kembali</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</x-app-layout>
