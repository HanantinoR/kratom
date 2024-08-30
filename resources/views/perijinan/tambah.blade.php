<x-app-layout :assets="$assets ?? []">
    <div>
       {!! Form::open(['route' => ['perijinan.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
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
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="fname">NIB: <span class="text-danger">*</span></label>
                                    {{ Form::text('nib', null, ['class' => 'form-control', 'id' => 'nib', 'placeholder' => 'NIB', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="lname">Tanggal NIB <span class="text-danger">*</span></label>
                                    {{ Form::date('date_nib', null, ['class' => 'form-control', 'id' => 'date_nib', 'placeholder' => '' ,'required']) }}
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="add1">Nama Perusahaan: <span class="text-danger">*</span></label>
                                    {{ Form::text('company_name', null, ['class' => 'form-control', 'id' => 'company_name', 'placeholder' => 'Nama Perusahaan']) }}
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="form-label" for="add2">Jenis Usaha: </label>
                                    {{-- <small style="color:red">Required</small> --}}
                                    {{ Form::select('company_type', ['0' => 'Jenis Usaha', '1' => 'Locale', '2' => 'Furniture', '3' => 'Construction'], '0', ['class' => 'form-control', 'id' => 'company_industry']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="cname">Kategori Usaha: </label>
                                    {{ Form::select('company_category', ['0' => 'Jenis Usaha', '1' => 'Locale', '2' => 'Furniture', '3' => 'Construction'], '0', ['class' => 'form-control', 'id' => 'company_industry']) }}
                                </div>
                                <div class="form-group col-sm-12">
                                    <label class="form-label" id="address">Alamat Kantor: <span class="text-danger">*</span></label>
                                    {{ Form::textarea('company_address', null, ['class' => 'form-control', 'id' => 'address', 'rows' => '2']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="province">Provinsi:</label>
                                    {{ Form::select('province', ['0' => 'Pilih Provinsi', '1' => 'Jakarta', '2' => 'Jawa Tengah', '3' => 'Sumatra Utara'], '0', ['class' => 'form-control', 'id' => 'province']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="city">Kabupaten/Kota:</label>
                                    {{ Form::select('city', ['0' => 'Pilih Kota', '1' => 'Jakarta', '2' => 'Semarang', '3' => 'Medan'], '0', ['class' => 'form-control', 'id' => 'city']) }}
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="factory_address">Alamat Pabrik: <span class="text-danger">*</span></label>
                                    {{-- <small style="color:red">Required</small> --}}
                                    {{ Form::textarea('factory_address', null, ['class' => 'form-control', 'placeholder' => 'Alamat Pabrik', 'required', 'rows' => '2']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="branch_location">Lokasi Kantor Cabang:</label>
                                    {{ Form::text('branch_location', null, ['class' => 'form-control', 'id' => 'pin_code','step' => 'any']) }}
                                </div>
                                <div class="form-group col-md-6"></div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="pic">Penanggung Jawab: <span class="text-danger">*</span></label>
                                    {{ Form::text('pic', null, ['class' => 'form-control', 'id' => 'pic', 'placeholder' => 'Nama Penanggung Jawab']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="position">Jabatan:</label>
                                    {{ Form::text('position', null, ['class' => 'form-control', 'id' => 'position', 'placeholder' => 'Jabatan Penanggung Jawab']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="npwp">NPWP:</label>
                                    {{ Form::text('npwp', null, ['class' => 'form-control', 'id' => 'npwp', 'placeholder' => 'Nomor NPWP']) }}
                                </div>
                                <div class="form-group col-md-6"></div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="phone">Telepon: <span class="text-danger">*</span></label>
                                    {{ Form::text('phone', null, ['class' => 'form-control', 'id' => 'phone', 'placeholder' => 'Nomor Telepon']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="hp">HP: </label>
                                    {{ Form::text('hp', null, ['class' => 'form-control', 'id' => 'hp', 'placeholder' => 'Nomor HP']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="email">Email:</label>
                                    {{ Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="pic_status">Status Aktif:</label>
                                    {{ Form::select('pic_status', ['0' => 'Pilih Status', '1' => 'Aktif', '2' => 'Tidak Aktif'], '0', ['class' => 'form-control', 'id' => 'pic_status']) }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Perijinan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
 </x-app-layout>
 