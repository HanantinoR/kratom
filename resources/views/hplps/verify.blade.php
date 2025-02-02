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
        {!! Form::model($data, ['route' => ['hplps.save'], 'method' => 'POST' , 'enctype' => 'multipart/form-data','id'=>'form_edit']) !!}
            @csrf
        {{ Form::hidden('ppbe_id', old('ppbe_id', $id), ['class' => 'form-control text-black', 'id' => 'ppbe_id', 'readonly']) }}
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
                                        {{-- {{ Form::datetimeLocal('inspection_date', old('inspection_date',$data->insepction_date), ['class' => 'form-control text-black', 'id' => 'inspection_date', 'readonly']) }} --}}
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
                                {{ Form::text('name', old('name',$data->company->name), ['class' => 'form-control text-black', 'id' => 'nama', 'readonly']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="pic" class="form-label">Nama Petugas Eksportir: <span class="text-danger">*</span></label>
                                {{ Form::text('pic', old('pic', $data->company->pic), ['class' => 'form-control text-black', 'id' => 'pic', 'readonly']) }}
                            </div>
                            <div class="form-group col-md-6">
                                <label for="position" class="form-label">Jabatan Petugas Eksportir: <span class="text-danger">*</span></label>
                                {{ Form::text('position', old('position',$data->company->position), ['class' => 'form-control text-black', 'id' => 'position', 'readonly']) }}
                            </div>
                        </div>
                        <hr>
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
                        </div>
                        <hr> --}}
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
                                    <option value="">Pilih Pelabuhan</option>
                                    @foreach($destination_port as $key => $port)
                                        <option value="{{ $port->id }}" {{ $data->destination_port_id === $port->id ? 'selected' : '' }}>
                                            {{ $port->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country_destination_id" class="form-label">Negara Tujuan: <span class="text-danger">*</span></label>
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
                                        {{ Form::text('fob_total', old('fob_total', $data->fob_total), ['class' => 'form-control text-black', 'id' => 'fob_total', 'readonly']) }}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::text('fob_currency', old('fob_currency', $currencies[$data->fob_currency-1]->description ." (" .$currencies[$data->fob_currency-1]->code.")"), ['class' => 'form-control text-black', 'id' => 'fob_currency', 'readonly']) }}
                                    </div>
                                </div>
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
                        $check = json_decode($data->hplps->checker_list)
                    @endphp
                    {{-- {{dd($check)}} --}}
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
                                            <select name="barang[{{$index}}][nomor_hs]" class="form-control select2" id="barang[{{$index}}][nomor_hs]" placeholder="Select Company Name" style="width: 100%" disabled>
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
                                        <select name="fob_currency_hpl" class="form-control select2" id="fob_currency_hpl" placeholder="Select FOB Currency">
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
                                        @foreach ($data->hplps->usage as $usage)
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
                                                            {{ Form::text('usage[0][series]', old('usage[0][series]', $usage['series']), ['class' => 'form-control text-black', 'id' => 'usage[0][series]','readonly']) }}
                                                        </div>
                                                        <div class="col-lg-3">
                                                            {{ Form::text('usage[0][init]', old('usage[0][init]', $usage['series_init']), ['class' => 'form-control text-black', 'id' => 'usage[0][init]','readonly']) }}
                                                        </div>
                                                        <div class="col-lg-1 mt-2">
                                                            S/D
                                                        </div>
                                                        <div class="col-lg-3">
                                                            {{ Form::text('usage[0][final]', old('usage[0][final]', $usage['series_final']), ['class' => 'form-control text-black', 'id' => 'usage[0][final]','readonly']) }}
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
                                                @if ($memory['lock_seal'] != "" || !empty($memory['lock_seal']))
                                                    @php
                                                        $lock = json_decode($memory['lock_seal']);
                                                    @endphp
                                                    @foreach ($lock as $lock_seal)
                                                    <div class="row">
                                                        <label for="memorizations[0][lock_seal_series]">Lock Seal</label>
                                                        <div class="lock_field" id="lock_field_0">
                                                            <div class="row">
                                                                <div class="col-md-3 p-1">
                                                                    {{ Form::text('memorizations[0][lock_seal_series][0]', old('memorizations[0][lock_seal_series][0]',$lock_seal->series), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][lock_seal_series][0]', 'readonly','disabled']) }}
                                                                </div>
                                                                <div class="col-md-4 p-1">
                                                                    {{ Form::text('memorizations[0][lock_seal_init][0]', old('memorizations[0][lock_seal_init][0]',$lock_seal->lock_seal_init), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][lock_seal_init][0]', 'readonly','disabled']) }}
                                                                </div>
                                                                <div class="col-md-4 p-1">
                                                                    {{ Form::text('memorizations[0][lock_seal_final][0]', old('memorizations[0][lock_seal_final][0]',$lock_seal->lock_seal_final), ['class' => 'form-control text-black tps_0', 'id' => 'memorizations[0][lock_seal_final][0]', 'readonly','disabled']) }}
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
                        <hr>
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
                        {{-- <h5 class="mt-4">Upload Dokumen & Foto</h5>
                        <i class="tx-danger tx-11">(Ekstention File : jpeg, png, jpg, .pdf, .zip)</i>
                        <div class="form-group mt-4">
                            <div class="row">
                                <label for="" class="col-sm-2 col-md-2">
                                    Dokumen Hasil Pemeriksaan Lapangan dan Lainnya
                                    <br><i class="tx-info tx-11">Maksimum: 10MB</i>
                                </label>
                                <div class="col-md-3 col-sm-3">
                                    <div class="dropzone" id="file-upload"></div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-success me-2" data-id="{{$id}}"  id="verify_btn"> Verify</button>
                        <button type="button" class="btn btn-secondary"> Kembali</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="flex justify-end mt-4">
            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
        </div> --}}
        {!! Form::close() !!}
    </div>
</x-app-layout>
<div class="modal fade" id="verifikasiHPLModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="verifikasiHPLModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verifikasiHPLModalLabel">Verifikasi HPLPS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {!! Form::model($data, ['route' => ['hplps.update', $id], 'method' => 'PUT' , 'enctype' => 'multipart/form-data','id'=>"form_approval"]) !!}
                <div class="modal-body">
                    <div class="row">
                        {{Form::hidden('ppbe_id',old('ppbe_id',$id),['class'=>'form-control','id'=>'ppbe_id','placeholder'=>'Catatan'])}}
                        <div class="mb-3">
                            <label for="hpl_new_status" class="col-form-label">Status:</label>
                            <select class="form-control select2Modal" name="hpl_new_status" id="hpl_new_status" style="width: 100%">
                                <option value="0">Tolak</option>
                                <option value="1">Verifikasi</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="hplps_reason" class="col-form-label">Alasan:</label>
                            {{Form::text('hplps_reason',null,['class'=>'form-control text-black','id'=>'hplps_reason','placeholder'=>'Catatan'])}}
                        </div>
                        <div class="mb-3 form-group">
                            <label for="hpl_feedback_file" class="col-form-label">File:</label>
                            {{Form::file('hpl_feedback_file',null,['class'=>'form-control','id'=>'hpl_feedback_file','placeholder'=>'Catatan'])}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="verifyBtn">
                        <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21.4274 2.5783C20.9274 2.0673 20.1874 1.8783 19.4974 2.0783L3.40742 6.7273C2.67942 6.9293 2.16342 7.5063 2.02442 8.2383C1.88242 8.9843 2.37842 9.9323 3.02642 10.3283L8.05742 13.4003C8.57342 13.7163 9.23942 13.6373 9.66642 13.2093L15.4274 7.4483C15.7174 7.1473 16.1974 7.1473 16.4874 7.4483C16.7774 7.7373 16.7774 8.2083 16.4874 8.5083L10.7164 14.2693C10.2884 14.6973 10.2084 15.3613 10.5234 15.8783L13.5974 20.9283C13.9574 21.5273 14.5774 21.8683 15.2574 21.8683C15.3374 21.8683 15.4274 21.8683 15.5074 21.8573C16.2874 21.7583 16.9074 21.2273 17.1374 20.4773L21.9074 4.5083C22.1174 3.8283 21.9274 3.0883 21.4274 2.5783Z" fill="currentColor"></path>
                            <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M3.01049 16.8079C2.81849 16.8079 2.62649 16.7349 2.48049 16.5879C2.18749 16.2949 2.18749 15.8209 2.48049 15.5279L3.84549 14.1619C4.13849 13.8699 4.61349 13.8699 4.90649 14.1619C5.19849 14.4549 5.19849 14.9299 4.90649 15.2229L3.54049 16.5879C3.39449 16.7349 3.20249 16.8079 3.01049 16.8079ZM6.77169 18.0003C6.57969 18.0003 6.38769 17.9273 6.24169 17.7803C5.94869 17.4873 5.94869 17.0133 6.24169 16.7203L7.60669 15.3543C7.89969 15.0623 8.37469 15.0623 8.66769 15.3543C8.95969 15.6473 8.95969 16.1223 8.66769 16.4153L7.30169 17.7803C7.15569 17.9273 6.96369 18.0003 6.77169 18.0003ZM7.02539 21.5683C7.17139 21.7153 7.36339 21.7883 7.55539 21.7883C7.74739 21.7883 7.93939 21.7153 8.08539 21.5683L9.45139 20.2033C9.74339 19.9103 9.74339 19.4353 9.45139 19.1423C9.15839 18.8503 8.68339 18.8503 8.39039 19.1423L7.02539 20.5083C6.73239 20.8013 6.73239 21.2753 7.02539 21.5683Z" fill="currentColor"></path>
                        </svg>
                    Verify HPLPS</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
