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
                                    {{ Form::text('nib', old('nib'), ['class' => 'form-control text-black', 'id' => 'nib', 'placeholder' => 'NIB', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="date_nib">Tanggal NIB <span class="text-danger">*</span></label>
                                    {{ Form::text('date_nib', old('date_nib'), ['class' => 'form-control text-black form_date_picker', 'id' => 'date_nib', 'placeholder' => '' ,'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="nomor_et">Nomor ET: <span class="text-danger">*</span></label>
                                    {{ Form::text('nomor_et', old('nomor_et'), ['class' => 'form-control text-black', 'id' => 'nomor_et', 'placeholder' => 'Nomor ET', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="date_et">Tanggal ET <span class="text-danger">*</span></label>
                                    {{ Form::text('date_et', old('date_et'), ['class' => 'form-control text-black form_date_picker', 'id' => 'date_et', 'placeholder' => '' ,'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="nomor_pe">Nomor PE: <span class="text-danger">*</span></label>
                                    {{ Form::text('nomor_pe', old('nomor_pe'), ['class' => 'form-control text-black', 'id' => 'nomor_pe', 'placeholder' => 'Nomor PE', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="date_pe">Tanggal PE <span class="text-danger">*</span></label>
                                    {{ Form::text('date_pe', old('date_pe'), ['class' => 'form-control text-black form_date_picker', 'id' => 'date_pe', 'placeholder' => '' ,'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_name">Nama Perusahaan: <span class="text-danger">*</span></label>
                                    {{ Form::text('company_name', old('company_name'), ['class' => 'form-control text-black', 'id' => 'company_name', 'placeholder' => 'Nama Perusahaan','required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <div class="row">
                                        {{-- <div class="col-md-4">
                                            <label class="form-label" for="used_quota">Kuota Pemakaian: <span class="text-danger">*</span></label>
                                            {{ Form::text('used_quota', old('',$data), ['class' => 'form-control text-black', 'id' => 'used_quota', 'placeholder' => 'Kuota Pemakaian']) }}
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="remaining_quota">Sisa Kuota: <span class="text-danger">*</span></label>
                                            {{ Form::text('remaining_quota', null, ['class' => 'form-control text-black', 'id' => 'remaining_quota', 'placeholder' => 'Kuota Sisa']) }}
                                        </div> --}}
                                        <div class="col-md-6">
                                            <label class="form-label" for="company_quota">Kuota: <span class="text-danger">*</span></label>
                                            {{ Form::text('company_quota', old('company_quota'), ['class' => 'form-control text-black', 'id' => 'company_quota', 'placeholder' => 'Kuota', 'required']) }}
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="form-group col-md-8">
                                    <label class="form-label" for="add2">Jenis Usaha: </label>
                                    {{ Form::select('company_type', ['0' => 'Jenis Usaha', '1' => 'Locale', '2' => 'Furniture', '3' => 'Construction'], '0', ['class' => 'form-control text-black', 'id' => 'company_industry']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="cname">Kategori Usaha: </label>
                                    {{ Form::select('company_category', ['0' => 'Jenis Usaha', '1' => 'Locale', '2' => 'Furniture', '3' => 'Construction'], '0', ['class' => 'form-control text-black', 'id' => 'company_industry']) }}
                                </div> --}}
                                <div class="form-group col-sm-12">
                                    <label class="form-label" id="company_address">Alamat Kantor: <span class="text-danger">*</span></label>
                                    {{ Form::textarea('company_address', old('company_address'), ['class' => 'form-control text-black', 'id' => 'company_address', 'rows' => '2','required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_provincy">Provinsi:</label>
                                    {{ Form::select('company_provincy', ['0' => 'Pilih Provinsi', '1' => 'Jakarta', '2' => 'Jawa Tengah', '3' => 'Sumatra Utara'], old('company_provincy'), ['class' => 'form-control text-black', 'id' => 'company_provincy','required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_city">Kabupaten/Kota:</label>
                                    {{ Form::select('company_city', [ '0' => 'Pilih Kabupaten','1' => 'Jakarta', '2' => 'Semarang', '3' => 'Medan'], old('company_city'), ['class' => 'form-control text-black', 'id' => 'company_city','required']) }}
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="company_factory">Alamat Pabrik: <span class="text-danger">*</span></label>
                                    {{-- <small style="color:red">Required</small> --}}
                                    {{ Form::textarea('company_factory', old('company_factory'), ['class' => 'form-control text-black', 'placeholder' => 'Alamat Pabrik','id'=>'company_factory', 'required', 'rows' => '2']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_inspection_office">Lokasi Kantor Cabang:</label>
                                    {{ Form::text('company_inspection_office', "PONTIANAK", ['class' => 'form-control text-black', 'required', 'id' => 'company_inspection_office']) }}
                                </div>
                                <div class="form-group col-md-6"></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_pic">Penanggung Jawab: <span class="text-danger">*</span></label>
                                    {{ Form::text('company_pic', old('company_pic'), ['class' => 'form-control text-black', 'id' => 'company_pic', 'placeholder' => 'Nama Penanggung Jawab', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_position">Jabatan:</label>
                                    {{ Form::text('company_position', old('company_position'), ['class' => 'form-control text-black', 'id' => 'company_position', 'placeholder' => 'Jabatan Penanggung Jawab', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_npwp">NPWP:</label>
                                    {{ Form::text('company_npwp', old('company_npwp'), ['class' => 'form-control text-black', 'id' => 'company_npwp', 'placeholder' => 'Nomor NPWP', 'required']) }}
                                </div>
                                <div class="form-group col-md-6"></div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_telp">Telepon: <span class="text-danger">*</span></label>
                                    {{ Form::text('company_telp', old('company_telp'), ['class' => 'form-control text-black', 'id' => 'company_telp', 'placeholder' => 'Nomor Telepon','required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_hp">HP: </label>
                                    {{ Form::text('company_hp', old('company_hp'), ['class' => 'form-control text-black', 'id' => 'company_hp', 'placeholder' => 'Nomor HP','required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_email">Email:</label>
                                    {{ Form::email('company_email', old('company_email'), ['class' => 'form-control text-black', 'id' => 'company_email', 'placeholder' => 'Email','required']) }}
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
                            <hr>
                            <h6 class="mb-4">Kelengkapan Dokumen
                                <br>
                                <i class="text-danger">Ekstensi File : .pdf, .jpeg, .jpg, .png</i>
                            </h6>
                            <div class="row">
                                @if(isset($id))
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_et">ET: </label>
                                            <div class="col-md-6 col-sm-9">
                                                <div class="row mb-4">
                                                <a href="{{url('perijinan/'.$data->file_et)}}" target="_blank" class="me-2 text-left">
                                                        <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                        </svg>
                                                        Download File ET
                                                    </a>
                                                </div>
                                                <div class="row">
                                                    <i class="text-danger text-sm-left">Unggah File jika Anda ingin Merubah</i>
                                                    {{ Form::file('file_et',['class' => 'dropify', 'id'=>'file_et','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" ]) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_pe">PE: </label>
                                            <div class="col-md-6 col-sm-9">
                                                <div class="row mb-4">
                                                    <a href="{{url('perijinan/'.    $data->file_pe)}}" target="_blank" class="me-2">
                                                        <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                                        </svg>
                                                        Download File PE
                                                    </a>
                                                </div>
                                                <div class="row">
                                                    <i class="text-danger text-sm-left">Unggah File jika Anda ingin Merubah</i>
                                                    {{ Form::file('file_pe',['class' => 'dropify', 'id'=>'file_pe','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" ]) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <div class="fom-group row">
                                            <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_et">ET: </label>
                                            <div class="col-md-6 col-sm-9">
                                                {{ Form::file('file_et',['class' => 'dropify', 'id'=>'file_et','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" , 'required']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="fom-group row">
                                            <label class="form-label control-label col-sm-3 align-self-center mb-0" for="file_et">PE: </label>
                                            <div class="col-md-6 col-sm-9">
                                                {{ Form::file('file_pe',['class' => 'dropify', 'id'=>'file_pe','placeholder' => 'input', "data-height"=>'110',"data-max-file-size"=>"2M","accept"=>".jpg,.png,.pdf,.zip", "data-allowed-file-extensions"=>"pdf jpeg jpg png zip" , 'required']) }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                @if(isset($id))
                                    <button type="submit" class="btn btn-primary" id="saveBtn">Simpan</button>
                                @else
                                    <button type="submit" class="btn btn-primary" id="TambahBtn">Tambah Perijinan</button>
                                @endif
                                    <button type="button" class="btn btn-danger" id="backBtn">kembali</button>
                            </div>
                            <div class="col-md-4"></div>
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
                            <h4 class="card-title">History Perijinan</h4>
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
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
 </x-app-layout>



{{--
request akses GIT
untuk kebutuhan vepik
helpdesk isb@sucofindo.com

--}}
