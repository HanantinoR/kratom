<x-app-layout :assets="$assets ?? []">
    <div>
       {!! Form::open(['route' => ['inatrade.store'], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
        <div class="row">
            <div class="col-xl-12 col-lg-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Inatrade</h4>
                        </div>
                        {{-- <div class="card-action">
                                <a href="{{route('users.index')}}" class="btn btn-sm btn-primary" role="button">Back</a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="new-user-info">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="fname">Nomor LS</label>
                                    {{ Form::text('ls_number', null, ['class' => 'form-control', 'id' => 'ls_number', 'placeholder' => 'Nomor LS', 'required']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="lname">Nomor Permohonan</label>
                                    {{ Form::text('ppbe_number', null, ['class' => 'form-control', 'id' => 'ppbe_number', 'placeholder' => 'Nomor Permohonan']) }}
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="add1">Tanggal LS</label>
                                    {{ Form::date('ls_publish_date', null, ['class' => 'form-control', 'id' => 'ls_publish_date', 'placeholder' => 'Tanggal LS']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="send_status">Status Kirim</label>
                                    {{ Form::select('send_status', ['0' => 'Pilih Status', '1' => 'Perubahan', '2' => 'Pembatalan'], '0', ['class' => 'form-control', 'id' => 'send_status']) }}
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="form-label" for="ls_file">URL PDF LS</label>
                                    {{ Form::text('ls_file', null, ['class' => 'form-control', 'id' => 'ls_file', 'placeholder' => 'Link untuk File LS']) }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h5 class="mb-3">I. Data Exportir</h5>
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="company_name">Nama Perusahaan</label>
                                    {{ Form::text('company_name', null, ['class' => 'form-control', 'id' => 'company_name', 'placeholder' => 'Nama Perusahaan']) }}
                                </div>
                                <div class="form-group col-sm-12">
                                    <label class="form-label" id="company_address">Alamat: <span class="text-danger">*</span></label>
                                    {{ Form::textarea('company_address', null, ['class' => 'form-control', 'id' => 'company_address', 'rows' => '2']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="npwp">NPWP</label>
                                    {{ Form::text('npwp', null, ['class' => 'form-control', 'id' => 'npwp', 'placeholder' => 'NPWP']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="nib">NIB</label>
                                    {{ Form::text('nib', null, ['class' => 'form-control', 'id' => 'nib', 'placeholder' => 'nib']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="company_city">Kota/Kabupaten</label>
                                    {{ Form::text('company_city', null, ['class' => 'form-control', 'id' => 'company_city', 'placeholder' => 'Kota/Kabupaten']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="nib">Provinsi</label>
                                    {{ Form::text('company_province', null, ['class' => 'form-control', 'id' => 'company_province', 'placeholder' => 'Provinsi']) }}
                                </div>
                                <div class="form-group col-md-6"></div>
                            </div>
                            <hr>
                            <div class="row">
                                <h5 class="mb-3">II. Data Importir</h5>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="importing_company_name">Nama Perusahaan</label>
                                    {{ Form::text('importing_company_name', null, ['class' => 'form-control', 'id' => 'importing_company_name', 'placeholder' => 'Nama Perusahaan Pengimpor']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="importing_company_country">Negara</label>
                                    {{ Form::text('importing_company_country', null, ['class' => 'form-control', 'id' => 'importing_company_country', 'placeholder' => 'Negara Pengimpor']) }}
                                </div>
                                <div class="form-group col-sm-12">
                                    <label class="form-label" id="importing_company_address">Alamat Perusahaan</label>
                                    {{ Form::textarea('company_address', null, ['class' => 'form-control', 'id' => 'company_address', 'rows' => '2']) }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h5 class="mb-3">III. Transportasi</h5>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="transport_method">Mode Transportasi</label>
                                    {{ Form::select('transport_method', ['0' => 'Pilih Metode Transportasi', '1' => 'Laut', '2' => 'Udara'], '0', ['class' => 'form-control', 'id' => 'transport_method']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="docking_port_code">Kode Pelabuhan Muat: </label>
                                    {{ Form::text('docking_port_code', null, ['class' => 'form-control', 'id' => 'docking_port_code', 'placeholder' => 'Kode Pelabuhan Muat']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="destination_port_code">Kode Pelabuhan Tujuan: </label>
                                    {{ Form::text('destination_port_code', null, ['class' => 'form-control', 'id' => 'destination_port_code', 'placeholder' => 'Kode Pelabuhan Tujuan']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="destination_country_code">Kode Negara Tujuan</label>
                                    {{ Form::text('destination_country_code', null, ['class' => 'form-control', 'id' => 'destination_country_code', 'placeholder' => 'Kode Negara Tujuan']) }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h5 class="mb-3">IV. Referensi</h5>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="document_type">Jenis Dokumen</label>
                                    {{ Form::select('document_type', ['0' => 'Pilih Metode Transportasi', '1' => 'Packing List', '2' => 'Commercial Invoice'], '0', ['class' => 'form-control', 'id' => 'document_type']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="document_number">Nomor Dokumen</label>
                                    {{ Form::text('document_number', null, ['class' => 'form-control', 'id' => 'document_number', 'placeholder' => 'Nomor Dokumen']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="document_date">Tanggal Dokumen</label>
                                    {{ Form::text('document_date', null, ['class' => 'form-control', 'id' => 'destination_port_code', 'placeholder' => 'Tanggal Dokumen']) }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h5 class="mb-3">V. Barang</h5>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="fob_value">Nilai FOB</label>
                                    {{ Form::text('fob_value', null, ['class' => 'form-control', 'id' => 'fob_value', 'placeholder' => 'Nilai']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="currency">Mata Uang</label>
                                    {{ Form::text('currency', null, ['class' => 'form-control', 'id' => 'currency', 'placeholder' => 'Mata Uang']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="crosscheck_date">Tanggal Periksa</label>
                                    {{ Form::text('crosscheck_date', null, ['class' => 'form-control', 'id' => 'crosscheck_date', 'placeholder' => 'Tanggal Periksa']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="crosscheck_location">Lokasi Periksa</label>
                                    {{ Form::text('crosscheck_location', null, ['class' => 'form-control', 'id' => 'crosscheck_location', 'placeholder' => 'Lokasi Periksa']) }}
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="crosscheck_notes">Catatan Pemeriksaan</label>
                                    {{ Form::text('crosscheck_notes', null, ['class' => 'form-control', 'id' => 'crosscheck_notes', 'placeholder' => 'Catatan Pemeriksaan']) }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h5 class="mb-3">VI. Komoditas</h5>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="hs_number">NO HS</label>
                                    {{ Form::text('hs_number', null, ['class' => 'form-control', 'id' => 'hs_number', 'placeholder' => 'Nomor HS']) }}
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="form-label" for="item_description">Uraian Barang</label>
                                    {{ Form::text('item_description', null, ['class' => 'form-control', 'id' => 'item_description', 'placeholder' => 'Uraian Barang']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="item_amount">Jumlah Barang</label>
                                    {{ Form::text('item_amount', null, ['class' => 'form-control', 'id' => 'item_amount', 'placeholder' => 'Jumlah Barang']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="item_price">Harga Barang</label>
                                    {{ Form::text('item_price', null, ['class' => 'form-control', 'id' => 'item_price', 'placeholder' => 'Harga Barang']) }}
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="form-label" for="currency_commodity">Mata Uang</label>
                                    {{ Form::text('currency_commodity', null, ['class' => 'form-control', 'id' => 'currency_commodity', 'placeholder' => 'Mata Uang']) }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <h5 class="mb-3">VII. Kontainer</h5>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="container_type">Jenis Kontainer</label>
                                    {{ Form::text('container_type', null, ['class' => 'form-control', 'id' => 'container_type', 'placeholder' => 'Jenis Kontainer']) }}
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label" for="container_number">Nomor Kontainer</label>
                                    {{ Form::text('container_number', null, ['class' => 'form-control', 'id' => 'container_number', 'placeholder' => 'Nomor Kontainer']) }}
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Inatrade</button>
                            <button type="submit" class="btn btn-danger">Kembalikan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
 </x-app-layout>
 