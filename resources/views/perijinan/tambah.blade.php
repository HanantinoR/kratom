<x-app-layout :assets="$assets ?? []">
    <div>
        @if(isset($id))
        {!! Form::model($data, ['route' => ['perijinan.update',$id], 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
        @else
        {!! Form::open(['route' => ['perijinan.store'], 'method' => 'post', 'enctype' => 'multipart/form-data', 'novalidate', 'class' => 'needs-validation',"id"=>"perijinanTambahForm"]) !!}
        @endif
        <div class="row">
            <div class="col-xl-12 col-lg-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Tambah Data Perijinan Baru</h4>
                        </div>
                        {{-- <div class="card-action">
                                <a href="{{route('users.index')}}" class="btn btn-sm btn-primary" role="button">Back</a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="new-user-info">
                            <div class="row" >
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="nib">NIB: <span class="text-danger">*</span></label>
                                    {{-- {{dd($auth_user->user_type)}} --}}
                                    {{-- @if ($auth_user->user_type == 'admin') --}}
                                        {{ Form::text('nib', old('nib'), ['class' => 'form-control text-black', 'id' => 'nib', 'placeholder' => 'NIB', 'required']) }}
                                    {{-- @else
                                        {{ Form::text('nib', old('nib'), ['class' => 'form-control text-black', 'id' => 'nib', 'placeholder' => 'NIB', 'required','readonly']) }}
                                    @endif --}}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="date_nib">Tanggal NIB <span class="text-danger">*</span></label>
                                    {{ Form::text('date_nib', old('date_nib'), ['class' => 'form-control text-black form_date_picker', 'id' => 'date_nib', 'placeholder' => '' ,'required']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="nomor_et">Nomor ET: <span class="text-danger">*</span></label>
                                    {{-- @if ($auth_user->user_type == 'admin') --}}
                                        {{ Form::text('nomor_et', old('nomor_et'), ['class' => 'form-control text-black', 'id' => 'nomor_et', 'placeholder' => 'Nomor ET', 'required']) }}
                                    {{-- @else
                                        {{ Form::text('nomor_et', old('nomor_et'), ['class' => 'form-control text-black', 'id' => 'nomor_et', 'placeholder' => 'Nomor ET', 'required','readonly']) }}
                                    @endif --}}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="date_et">Tanggal ET <span class="text-danger">*</span></label>
                                    {{ Form::text('date_et', old('date_et'), ['class' => 'form-control text-black form_date_picker', 'id' => 'date_et', 'placeholder' => '' ,'required']) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="npwp">NPWP:</label>
                                    {{-- @if ($auth_user->user_type == 'admin') --}}
                                        {{ Form::text('npwp', old('npwp'), ['class' => 'form-control text-black', 'id' => 'npwp', 'placeholder' => 'Nomor NPWP', 'required']) }}
                                    {{-- @else
                                        {{ Form::text('npwp', old('npwp'), ['class' => 'form-control text-black', 'id' => 'npwp', 'placeholder' => 'Nomor NPWP', 'required','readonly']) }}
                                    @endif --}}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="name">Nama Perusahaan: <span class="text-danger">*</span></label>
                                    {{ Form::text('name', null, ['class' => 'form-control text-black', 'id' => 'name', 'placeholder' => 'Nama Perusahaan','required']) }}
                                </div>
                                {{-- <div class="form-group col-md-6">
                                    <label for="hasil_json" class="form-label">Hasil Check</label>
                                    {{ Form::textarea('hasil_json', old('hasil_json'), ['class' => 'form-control text-black', 'id' => 'hasil_json', 'placeholder' => 'Hasil Check', 'required', 'rows'=>2,'readonly']) }}
                                </div> --}}
                            </div>
                            @if (isset($id))
                                <div class="row">
                                    <hr>
                                    <div class="form-group col-sm-12">
                                        <label class="form-label" id="company_address">Alamat Kantor: <span class="text-danger">*</span></label>
                                        {{ Form::textarea('company_address', old('company_address'), ['class' => 'form-control text-black', 'id' => 'company_address', 'rows' => '2','required']) }}
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="form-label" for="province_id">Provinsi: <span class="text-danger">*</span></label>
                                        <select name="province_id" class="form-control select2" id="province_id" placeholder="Provinsi" style="width: 100%">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach($provinces as $key => $province)
                                                <option value="{{ $province->id }}" {{ $data->province_id === $province->id ? 'selected' : '' }}>
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="form-label" for="city_id">Kabupaten: <span class="text-danger">*</span></label>
                                        <select name="city_id" class="form-control select2" id="city_id" placeholder="Kota/Kabupaten" style="width: 100%">
                                            <option value="">Pilih Kota/Kabupaten</option>
                                            @foreach($cities as $key => $city)
                                                <option value="{{ $city->id }}" {{ $data->city_id === $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="factory_address">Alamat Pabrik: <span class="text-danger">*</span></label>
                                        {{-- <small style="color:red">Required</small> --}}
                                        {{ Form::textarea('factory_address', old('factory_address'), ['class' => 'form-control text-black', 'placeholder' => 'Alamat Pabrik','id'=>'factory_address', 'required', 'rows' => '2']) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="company_branch_office">Kantor Cabang:</label>
                                        <select name="branch_office" class="form-control select2" id="branch_office" placeholder="Kantor Cabang">
                                            <option value="">Pilih Kantor Cabang</option>
                                            @foreach($office_branch as $key => $office)
                                                <option value="{{ $office->id }}" {{ $data->branch_office === $office->id ? 'selected' : '' }}>
                                                    {{ $office->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Status:</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                {{ Form::radio('status', '1',old('status') || true, ['class' => 'form-check-input', 'id' => 'status-active']); }}
                                                <label class="form-check-label" for="status-active">
                                                    Aktif
                                                </label>
                                            </div>
                                            <div class="col-md-6">
                                                {{ Form::radio('status', '0',old('status') || true, ['class' => 'form-check-input', 'id' => 'status-active']); }}
                                                <label class="form-check-label" for="status-active">
                                                Tidak Aktif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <hr>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="pic">Penanggung Jawab: <span class="text-danger">*</span></label>
                                        {{ Form::text('pic', old('pic'), ['class' => 'form-control text-black', 'id' => 'pic', 'placeholder' => 'Nama Penanggung Jawab', 'required']) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="position">Jabatan:</label>
                                        {{ Form::text('position', old('position'), ['class' => 'form-control text-black', 'id' => 'position', 'placeholder' => 'Jabatan Penanggung Jawab', 'required']) }}
                                    </div>
                                    {{-- <div class="form-group col-md-6">
                                        <label class="form-label" for="telp">Telepon: <span class="text-danger">*</span></label>
                                        {{ Form::text('telp', old('telp'), ['class' => 'form-control text-black', 'id' => 'telp', 'placeholder' => 'Nomor Telepon','required']) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="hp">HP: </label>
                                        {{ Form::text('hp', old('hp'), ['class' => 'form-control text-black', 'id' => 'hp', 'placeholder' => 'Nomor HP','required']) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="email">Email:</label>
                                        {{ Form::email('email', old('email'), ['class' => 'form-control text-black', 'id' => 'email', 'placeholder' => 'Email','required']) }}
                                    </div> --}}
                                </div>
                                <div class="row">
                                    <hr>
                                    <h6 class="mb-4">Kelengkapan Dokumen
                                        <br>
                                        <i class="text-danger">Ekstensi File : .pdf, .jpeg, .jpg, .png</i>
                                    </h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_et">ET: </label>
                                                <div class="col-md-6 col-sm-9">
                                                    @if ($data->file_et === "" || $data->file_et === null)
                                                        -
                                                    @else
                                                        <div class="row mb-4">
                                                            <a href="{{url('perijinan_file/'.$data->file_et)}}" target="_blank" class="me-2 text-left">
                                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                                </svg>
                                                                Download File ET
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <i class="text-danger text-sm-left" >Unggah File jika Anda ingin Merubah</i>
                                                        {{ Form::file('file_et',['class' => 'form-control', 'id'=>'file_et','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" ]) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_nib">NIB: </label>
                                                <div class="col-md-6 col-sm-9">

                                                    @if ($data->file_nib === "" || $data->file_nib === null)
                                                        -
                                                    @else
                                                    <div class="row mb-4">
                                                        <a href="{{url('perijinan_file/'.$data->file_nib)}}" target="_blank" class="me-2 text-left">
                                                            <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                            </svg>
                                                            Download File NIB
                                                        </a>
                                                    </div>
                                                    @endif
                                                    <div class="row">
                                                        <i class="text-danger text-sm-left">Unggah File jika Anda ingin Merubah</i>
                                                        {{ Form::file('file_nib',['class' => 'form-control', 'id'=>'file_nib','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" ]) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_ktp">KTP: </label>
                                                <div class="col-md-6 col-sm-9">
                                                    @if ($data->file_ktp == "" || $data->file_ktp == null)
                                                    -
                                                    @else
                                                        <div class="row mb-4">
                                                            <a href="{{asset('perijinan_file/'.    $data->file_ktp)}}" target="_blank" class="me-2">
                                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                                </svg>
                                                                Download File KTP
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <i class="text-danger text-sm-left">Unggah File jika Anda ingin Merubah</i>
                                                        {{ Form::file('file_ktp',['class' => 'form-control', 'id'=>'file_ktp','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" ]) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_npwp">NPWP: </label>
                                                <div class="col-md-6 col-sm-9">
                                                    @if ($data->file_npwp === "" || $data->file_npwp === null)
                                                        -
                                                    @else
                                                        <div class="row mb-4">
                                                            <a href="{{asset('perijinan_file/'.    $data->file_npwp)}}" target="_blank" class="me-2">
                                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                                </svg>
                                                                Download File NPWP
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="row">
                                                        <i class="text-danger text-sm-left">Unggah File jika Anda ingin Merubah</i>
                                                        {{ Form::file('file_npwp',['class' => 'form-control', 'id'=>'file_npwp','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" ]) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="form-label control-label col-sm-3 align-self-center mb-0" for="perijinan_notes">Alasan: </label>
                                                <div class="col-md-8 col-sm-9">
                                                    {{ Form::textarea('perijinan_notes',null,['class' => 'form-control text-black', 'id'=>'perijinan_notes','placeholder' => 'Alasan Perubahan', 'rows'=>'4']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row data_company" hidden>
                                    <div class="form-group col-sm-12">
                                        <label class="form-label" id="company_address">Alamat Kantor: <span class="text-danger">*</span></label>
                                        {{ Form::textarea('company_address', null, ['class' => 'form-control text-black', 'id' => 'company_address', 'rows' => '2','required']) }}
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="form-label" for="province_id">Provinsi: <span class="text-danger">*</span></label>
                                        <select name="province_id" class="form-control select2" id="province_id" placeholder="Provinsi" style="width: 100%">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach($provinces as $key => $province)
                                                <option value="{{ $province->id }}" {{ old('province_id') === $province->id ? 'selected' : '' }}>
                                                    {{ $province->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6 col-sm-12">
                                        <label class="form-label" for="city_id">Kabupaten: <span class="text-danger">*</span></label>
                                        <select name="city_id" class="form-control select2" id="city_id" placeholder="Kota/Kabupaten" style="width: 100%">
                                            <option value="">Pilih Kota/Kabupaten</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label" for="factory_address">Alamat Pabrik: <span class="text-danger">*</span></label>
                                        {{-- <small style="color:red">Required</small> --}}
                                        {{ Form::textarea('factory_address', null, ['class' => 'form-control text-black', 'placeholder' => 'Alamat Pabrik','id'=>'factory_address', 'required', 'rows' => '2']) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="pic">Penanggung Jawab: <span class="text-danger">*</span></label>
                                        {{ Form::text('pic', null, ['class' => 'form-control text-black', 'id' => 'pic', 'placeholder' => 'Nama Penanggung Jawab', 'required']) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="position">Jabatan:</label>
                                        {{ Form::text('position', null, ['class' => 'form-control text-black', 'id' => 'position', 'placeholder' => 'Jabatan Penanggung Jawab', 'required']) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label" for="branch_office">Kantor Cabang:</label>
                                        <select name="branch_office" class="form-control select2" id="branch_office" placeholder="Kantor Cabang" style="width: 100%">
                                            <option value="">Pilih Kantor Cabang</option>
                                            @foreach($office_branch as $key => $office)
                                                <option value="{{ $office->id }}" {{ old('branch_office') === $office->id ? 'selected' : '' }}>
                                                    {{ $office->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <div class="form-group col-md-6">
                                            <label class="form-label">Status:</label>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    {{ Form::radio('status', '1',old('status') || true, ['class' => 'form-check-input', 'id' => 'status-active']); }}
                                                    <label class="form-check-label" for="status-active">
                                                        Aktif
                                                    </label>
                                                </div>
                                                <div class="col-md-6">
                                                    {{ Form::radio('status', '0',old('status') || true, ['class' => 'form-check-input', 'id' => 'status-active']); }}
                                                    <label class="form-check-label" for="status-active">
                                                    Tidak Aktif
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row data_company" hidden>
                                    <hr>
                                    <h6 class="mb-4">Kelengkapan Dokumen
                                        <br>
                                        <i class="text-danger">Ekstensi File : .pdf, .jpeg, .jpg, .png</i>
                                    </h6>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="fom-group row">
                                                <label class="form-label control-label col-sm-2 align-self-center mb-0" for="file_et">ET: </label>
                                                <div class="col-md-9 col-sm-9">
                                                    {{ Form::file('file_et',['class' => 'form-control', 'id'=>'file_et','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" , 'required']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="fom-group row">
                                                <label class="form-label control-label col-sm-2 align-self-center mb-0" for="file_ktp">KTP: </label>
                                                <div class="col-md-9 col-sm-9">
                                                    {{ Form::file('file_ktp',['class' => 'form-control', 'id'=>'file_ktp','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" , 'required']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6">
                                            <div class="fom-group row">
                                                <label class="form-label control-label col-sm-2 align-self-center mb-0" for="file_nib">NIB: </label>
                                                <div class="col-md-9 col-sm-9">
                                                    {{ Form::file('file_nib',['class' => 'form-control', 'id'=>'file_nib','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" , 'required']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="fom-group row">
                                                <label class="form-label control-label col-sm-2 align-self-center mb-0" for="file_npwp">NPWP: </label>
                                                <div class="col-md-9 col-sm-9">
                                                    {{ Form::file('file_npwp',['class' => 'form-control', 'id'=>'file_npwp','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" , 'required']) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            @if (isset($id))
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Simpan</button>
                                </div>
                            @else
                                <div class="col-md-4"></div>
                                <div class="col-md-2 action_company" hidden>
                                    <button type="submit" class="btn btn-primary" id="TambahBtn">Tambah</button>
                                </div>
                                <div class="col-md-2 check_et_button">
                                    <button type="button" class="btn btn-info" id="checkETbtn">check</button>
                                </div>
                            @endif
                            <div class="col-md-2">
                                <a href="{{route('perijinan.index')}}" type="button" class="btn btn-danger" id="backBtn">kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
        @if(isset($id))
            <div class="row">
                <div class="col-xl-12 col-lg-10">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">History Perubahan Perijinan</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>KATEGORY</th>
                                                    <th>DATA SEBELUM PERUBAHAN</th>
                                                    <th>DATA SETELAH PERUBAHAN</th>
                                                    <th>KETERANGAN</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_history as $index => $item)
                                                    <tr>
                                                        <td>{{$index+1}}</td>
                                                        <td>
                                                            @switch($item->field)
                                                            @case('nib')
                                                                NIB
                                                                @break
                                                            @case('nomor_et')
                                                                Nomor ET
                                                                @break
                                                            @case('date_nib')
                                                                Tanggal NIB
                                                                @break
                                                            @case('date_et')
                                                                Tanggal ET
                                                                @break
                                                            @case('name')
                                                                Nama Perusahaan
                                                                @break
                                                            @case('company_address')
                                                                Alamat Kantor
                                                                @break
                                                            @case('province_id')
                                                                Provinsi
                                                                @break
                                                            @case('city_id')
                                                                Kabupaten
                                                                @break
                                                            @case('factory_address')
                                                                Alamat Pabrik
                                                                @break
                                                            @case('branch_office')
                                                                Kantor Cabang
                                                                @break
                                                            @case('pic')
                                                                PIC
                                                                @break
                                                            @case('position')
                                                                Jabatan
                                                                @break
                                                            @case('npwp')
                                                                NPWP
                                                                @break
                                                            @case('status')
                                                                Status
                                                                @break
                                                            @case('file_et')
                                                                File ET
                                                                @break
                                                            @case('file_pe')
                                                                File PE
                                                                @break
                                                            @case('file_nib')
                                                                File PE
                                                                @break
                                                            @case('file_npwp')
                                                                File PE
                                                                @break
                                                            @case('file_ktp')
                                                                File PE
                                                                @break
                                                            @endswitch
                                                        </td>
                                                        <td>@if($item->field === 'status')
                                                                @if($item->old_value === '0')
                                                                    Tidak Aktif
                                                                @else
                                                                    Aktif
                                                                @endif
                                                            {{-- @elseif($item->field === 'branch_office') --}}

                                                            @else
                                                                {{$item->old_value}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                        @if($item->field === 'status')
                                                            @if($item->new_value === '0')
                                                                Tidak Aktif
                                                            @else
                                                                Aktif
                                                            @endif
                                                        @else
                                                            {{$item->new_value}}
                                                        @endif
                                                            </td>
                                                        <td>{{$item->notes}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-10">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <div class="card-title">
                                    <h4>Check PE</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- Batas Pemakaian PE Maksimal Tanggal ........ <i class="text-small text-danger"> harap rubah PE</i> --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label" for="nomor_pe">Nomor PE: <span class="text-danger">*</span></label>
                                    {{ Form::text('nomor_pe', old('nomor_pe'), ['class' => 'form-control text-black', 'id' => 'nomor_pe', 'placeholder' => 'Nomor PE', 'required']) }}
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label control-label col-sm-2 align-self-center" for="file_et">PE: </label>
                                    {{ Form::file('file_pe',['class' => 'form-control', 'id'=>'file_pe','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" , 'required']) }}
                                </div>
                                <div class="col-md-2">
                                    <a type="button" class="btn btn-primary mt-4" id="checkPEbtn">check</a>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="table-responsive">
                                    <table class="table table-resonsive">
                                        <thead>
                                            <tr>
                                                <th>Nomor PE</th>
                                                <th>File PE</th>
                                                <th>Status PE</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->pe as $pe)
                                                <tr>
                                                    <td>{{$pe->nomor_pe}}</td>
                                                    <td>
                                                        <a href="{{url('pe_file/'.$pe->file_pe)}}" target="_blank" class="me-2 text-left">
                                                            <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                            </svg>
                                                            Download File PE
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-info">{{$pe->status}}</span>
                                                    </td>
                                                    <td>
                                                        <a href="{{route('perijinan.pe_detail',$pe->id)}}" class="btn btn-sm btn-info mt-4" id="detailPEbtn" target="_blank">
                                                            <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path opacity="0.4" d="M22 11.9998C22 17.5238 17.523 21.9998 12 21.9998C6.477 21.9998 2 17.5238 2 11.9998C2 6.47776 6.477 1.99976 12 1.99976C17.523 1.99976 22 6.47776 22 11.9998Z" fill="currentColor"></path>
                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.52075 10.8035C6.85975 10.8035 6.32275 11.3405 6.32275 11.9995C6.32275 12.6595 6.85975 13.1975 7.52075 13.1975C8.18175 13.1975 8.71875 12.6595 8.71875 11.9995C8.71875 11.3405 8.18175 10.8035 7.52075 10.8035ZM11.9999 10.8035C11.3389 10.8035 10.8019 11.3405 10.8019 11.9995C10.8019 12.6595 11.3389 13.1975 11.9999 13.1975C12.6609 13.1975 13.1979 12.6595 13.1979 11.9995C13.1979 11.3405 12.6609 10.8035 11.9999 10.8035ZM15.2813 11.9995C15.2813 11.3405 15.8183 10.8035 16.4793 10.8035C17.1403 10.8035 17.6773 11.3405 17.6773 11.9995C17.6773 12.6595 17.1403 13.1975 16.4793 13.1975C15.8183 13.1975 15.2813 12.6595 15.2813 11.9995Z" fill="currentColor"></path>
                                                            </svg>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
