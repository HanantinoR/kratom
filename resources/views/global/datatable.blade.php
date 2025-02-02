@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
<style>
    .dataTables_filter, .dataTables_info {
        display:none;
    }
    .bcops-header{
        padding:3% !important;
    }
    .form-bcops-adjust{
        padding:1% !important
    }
    .fs-14{
        font-size:14px !important;
    }
    .field-bcops-adjust{
        padding: 0.5rem 0.3rem !important;
    }
</style>
<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $pageTitle  ?? 'List'}}</h4>
                        </div>
                        <div class="card-action">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if(in_array('ppbe_search',$assets ?? []))
                                <div class="col-md-4">
                                    <label for="pengajuan_code" class="form-label">Nomor PPBE:</label>
                                    {{Form::search('ppbe_search',null,["class"=>"form-control form-control-sm","id"=>"ppbe_search","aria-controls"=>"dataTable"])}}
                                </div>
                            @endif
                            @if(in_array('company_search',$assets ?? []))
                                <div class="col-md-4">
                                    <label for="company_name_search" class="form-label">Nama Perusahaan:</label>
                                    {{Form::search('company_name_search',null,["class"=>"form-control form-control-sm","id"=>"company_name_search","aria-controls"=>"dataTable"])}}
                                </div>
                            @endif
                            @if(in_array('ls_search',$assets ?? []))
                                <div class="col-md-4">
                                    <label for="ls_search" class="form-label">Nomor LS</label>
                                    {{ Form::search('ls_search',null, ["class" => "form-control form-control-sm", "id" => 'ls_search', 'aria-conntrols' => 'dataTable']) }}
                                </div>
                            @endif
                            {{-- @elseif($assets[1] == 'inatrade_list')
                                <div class="col-md-3">
                                    <label for="ppbe_search" class="form-label">Nomor PPBE</label>
                                    {{Form::search('ppbe_search',null,["class"=>"form-control form-control-sm","id"=>"ppbe_search","aria-controls"=>"dataTable"])}}
                                </div>
                                <div class="col-md-3">
                                    <label for="company_name_search" class="form-label">Nama Perusahaan:</label>
                                    {{Form::search('company_name_search',null,["class"=>"form-control form-control-sm","id"=>"company_name_search","aria-controls"=>"dataTable"])}}
                                </div>
                                <div class="col-md-3">
                                <label for="ls_search" class="form-label">Nomor LS</label>
                                {{ Form::search('ls_search',null, ["class" => "form-control form-control-sm", "id" => 'ls_search', 'aria-conntrols' => 'dataTable']) }}
                            </div>--}}
                            @if($assets[1] == 'bcops')
                                @if(in_array('bcops_umum',$assets ?? []))
                                    {!! Form::open(['route' => ['bcops.umum_tambah'], 'method' => 'post', 'enctype' => 'multipart/form-data', 'novalidate', 'class' => 'needs-validation',"id"=>"form_bcops_umum"]) !!}
                                @else
                                    {!! Form::open(['route' => ['bcops.surveyor_tambah'], 'method' => 'post', 'enctype' => 'multipart/form-data', 'novalidate', 'class' => 'needs-validation',"id"=>"form_bcops_surveyor"]) !!}
                                @endif
                                    <div class="row mb-2">
                                        <div class="d-flex justify-content-between">
                                            <div class="col-md-6">
                                                Input BCOPS Baru:
                                            </div>
                                            <div class="col-md-6 col-lg-6">
                                               <div class="row">
                                                    <div class="col-md-6 col-lg-6">
                                                        @if(in_array('bcops_umum',$assets ?? []))
                                                        @else
                                                            <select name="surveyor_id" class="form-control select2" id="surveyor_id" placeholder="Select Surveyor">
                                                                <option value="">Select Surveyor</option>
                                                                @foreach($users as $key => $user)
                                                                    <option value="{{ $user->id }}" {{ old('surveyor_id') === $user->id ? 'selected' : '' }}>
                                                                        {{$user->first_name}} {{ $user->last_name}}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6 col-lg-6">
                                                        {{ Form::date('bcops_date',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'bcops_date', 'placeholder' => '','required' ]) }}
                                                    </div>
                                               </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-header text-white text-center bg-danger bcops-header">TPS Merah</div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="row fs-14">
                                                            <div class="col-md-3 form-bcops-adjust">
                                                                <label class="form-label" for="red_series">Seri</label>
                                                                {{ Form::text('red_series',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'red_series', 'placeholder' => 'No. Seri' ]) }}
                                                            </div>
                                                            <div class="col-md-6 form-bcops-adjust">
                                                                <label class="form-label" for="red_init">No. Urut Awal</label>
                                                                {{ Form::text('red_init',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'red_init', 'placeholder' => 'No. Urut Awal' ]) }}
                                                            </div>
                                                            <div class="col-md-3 form-bcops-adjust">
                                                                <label class="form-label" for="red_total">Jumlah</label>
                                                                {{ Form::text('red_total',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'red_total', 'placeholder' => 'Jumlah ' ]) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-6 mt-2">
                                                                <button type="button" class="btn btn-primary" id="red_verify_btn"> verify</button>
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <input type="text" name="red_status" class="form-control red_status text-danger" id="red_status" value="Error" readonly></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-header text-white text-center bg-success bcops-header">TPS Hijau</div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="row fs-14">
                                                            <div class="col-md-3 form-bcops-adjust">
                                                                <label class="form-label" for="green_series">Seri</label>
                                                                {{ Form::text('green_series',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'green_series', 'placeholder' => 'No. Seri' ]) }}
                                                            </div>
                                                            <div class="col-md-6 form-bcops-adjust">
                                                                <label class="form-label" for="green_init">No. Urut Awal</label>
                                                                {{ Form::text('green_init',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'green_init', 'placeholder' => 'No. Urut Awal' ]) }}
                                                            </div>
                                                            <div class="col-md-3 form-bcops-adjust">
                                                                <label class="form-label" for="green_total">Jumlah</label>
                                                                {{ Form::text('green_total',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'green_total', 'placeholder' => 'Jumlah ' ]) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-6 mt-2">
                                                                <button type="button" class="btn btn-primary" id="green_verify_btn"> verify</button>
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <input type="text" name="green_status" class="form-control green_status text-danger" id="green_status" value="Error" readonly></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-header text-center text-white bg-info bcops-header">Lock Seal</div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="row fs-14">
                                                            <div class="col-md-3 form-bcops-adjust">
                                                                <label class="form-label" for="lock_seal_series">Seri</label>
                                                                {{ Form::text('lock_seal_series',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'lock_seal_series', 'placeholder' => 'No. Seri' ]) }}
                                                            </div>
                                                            <div class="col-md-6 form-bcops-adjust">
                                                                <label class="form-label" for="lock_seal_init">No. Urut Awal</label>
                                                                {{ Form::text('lock_seal_init',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'lock_seal_init', 'placeholder' => 'No. Urut Awal' ]) }}
                                                            </div>
                                                            <div class="col-md-3 form-bcops-adjust">
                                                                <label class="form-label" for="lock_seal_total">Jumlah</label>
                                                                {{ Form::text('lock_seal_total',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'lock_seal_total', 'placeholder' => 'Jumlah ' ]) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-6 mt-2">
                                                                <button type="button" class="btn btn-primary" id="lock_seal_verify_btn"> verify</button>
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <input type="text" name="lock_seal_status" class="form-control lock_seal_status text-danger" id="lock_seal_status" value="Error" readonly></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-header text-center bg-info text-white bcops-header">Thread Seal</div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <div class="row fs-14">
                                                            <div class="col-md-3 form-bcops-adjust">
                                                                <label class="form-label" for="thread_series">Seri</label>
                                                                {{ Form::text('thread_series',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'thread_series', 'placeholder' => 'No. Seri' ]) }}
                                                            </div>
                                                            <div class="col-md-6 form-bcops-adjust">
                                                                <label class="form-label" for="thread_init">No. Urut Awal</label>
                                                                {{ Form::text('thread_init',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'thread_init', 'placeholder' => 'No. Urut Awal' ]) }}
                                                            </div>
                                                            <div class="col-md-3 form-bcops-adjust">
                                                                <label class="form-label" for="thread_total">Jumlah</label>
                                                                {{ Form::text('thread_total',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'thread_total', 'placeholder' => 'Jumlah ' ]) }}
                                                            </div>
                                                        </div>
                                                        <div class="row mt-2">
                                                            <div class="col-md-6 mt-2">
                                                                <button type="button" class="btn btn-primary" id="thread_verify_btn"> verify</button>
                                                            </div>
                                                            <div class="col-md-6 mt-2">
                                                                <input type="text" name="thread_status" class="form-control thread_status text-danger" id="thread_status" value="Error" readonly></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- {{ Form::hidden('success_counter',null, ['class' => 'form-control text-black field-bcops-adjust', 'id' => 'success_counter', 'placeholder' => 'Jumlah ' ]) }} --}}
                                    <div style="text-align:right !important">
                                        <button type="submit" class="btn btn-primary" id="subtmit_bcops">Submit</button>
                                    </div>
                                {!! Form::close() !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                        </div>
                        <div class="card-action">
                            {!! $headerAction ?? '' !!}
                        </div>
                    </div>
                    <div class="card-body px-0">
                        <div class="table-responsive">
                            {{ $dataTable->table(['class' => 'table text-center table-striped w-100'],true) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
@if ($assets[1] == 'penugasan_list')
    <?php
        $intervention = ["1" => "PEMERIKSAAN", "2" =>"PENGAWASAN", "3" => "PEMERIKSAAN & PENGAWASAN"]
    ?>
    <div class="modal fade" id="assignmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="assignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            {!! Form::open(['route' => ['penugasan.save'],'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignmentModalLabel">Penugasan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    {{ Form::hidden('ppbe_id', old('ppbe_id'), ['class' => 'form-control text-black m-0','id'=>'ppbe_id' ,'placeholder' => 'Nama']) }}
                    {{-- {{ Form::text('surveyor_id', old('surveyor_id'), ['class' => 'form-control text-black m-0','id'=>'surveyor_id' ,'placeholder' => 'Nama']) }} --}}
                    <div class="modal-body p-2">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="form-label" for="surveyor_id">Nama Surveyor: <span class="text-danger">*</span></label>
                                <select name="surveyor_id" class="form-control select2_modal" id="surveyor_id" placeholder="Select Company Name" style="width: 100%">
                                    <option value="">Select Company Name</option>
                                    @foreach($users as $key => $user)
                                        <option value="{{ $user->id }}" {{ old('surveyor_id') === $user->id ? 'selected' : '' }}>
                                            {{ $user->first_name. $user->last_name}}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- {{ Form::text('surveyor_id', old('surveyor_id'), ['class' => 'form-control text-black m-0','id'=>'surveyor_id' ,'placeholder' => 'Nama', 'required']) }} --}}
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label" for="intervention_type">Jenis Intervensi: <span class="text-danger">*</span></label>
                                <select name="intervention_type" class="form-control select2_modal" id="intervention_type" placeholder="Select Company Name" style="width: 100%">
                                    <option value="">Select Intervention</option>
                                    <option value="1">PEMERIKSAAN</option>
                                    <option value="2">PENGAWASAN</option>
                                    <option value="3">PEMERIKSAAN & PENGAWASAN</option>
                                </select>
                                {{-- {{ Form::select('intervention_type',$intervention ,old('intervention_type'), ['class' => 'form-control text-black m-0','id'=>'intervention_type' ,'placeholder' => 'Intervensi', 'required']) }} --}}
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label" for="letter_number">No Surat Penugasan ERP: <span class="text-danger">*</span></label>
                                {{ Form::text('letter_number', old('letter_number'), ['class' => 'form-control text-black m-0','id'=>'letter_number' ,'placeholder' => 'Number', 'required']) }}
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label" for="penugasan_date">Tanggal Penugasan: <span class="text-danger">*</span></label>
                                <input type="datetime-local" name="penugasan_date" id="penugasan_date" class="form-control text-black m-0 penugasan_date">
                                {{-- {{ Form::date('penugasan_date', old('penugasan_date'), ['class' => 'form-control text-black m-0 penugasan_date','id'=>'penugasan_date' ,'placeholder' => 'Tanggal', 'required']) }} --}}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@elseif (in_array('hplps_list',$assets))
    <div class="modal fade" id="requestBookingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestBookingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            {!! Form::open(['route' => ['hplps.booking'],'method' => 'post', 'enctype' => 'multipart/form-data','id'=>'form_request_booking']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="requestBookingModalLabel">Volume Request Booking</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="req_type">Jenis Permintaan: </label>
                                <select name="req_type" id="req_type" class="form-control select2_modal" style="width: 100%" required>
                                    <option value="">Pilih Jenis Permintaan</option>
                                    <option value="1">Permintaan Alokasi</option>
                                    <option value="2">Revisi Permintaan Alokasi</option>
                                    <option value="3">Pembatalan Permintaan Alokasi</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="code">No PPBE</label>
                                <input type="text" name="code" id="code" class="form-control text-black" readonly >
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="nib">NIB</label>
                                <input type="text" name="nib" id="nib" class="form-control text-black" readonly>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="npwp">NPWP</label>
                                <input type="text" name="npwp" id="npwp" class="form-control text-black" readonly>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="no_pe">No PE</label>
                                <input type="text" name="no_pe" id="no_pe" class="form-control text-black" readonly>
                            </div>
                            <div class="form-group col-lg-6 col-md-6">
                                <label for="pe_permit_date">Tanggal Izin PE</label>
                                <input type="text" name="pe_permit_date" id="pe_permit_date" class="form-control text-black" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row request_body"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"  id="request_alokasi_btn">Request</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="modal fade" id="checkLabModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="checkLabModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            {{-- {!! Form::open(['route' => ['hplps.booking'],'method' => 'post', 'enctype' => 'multipart/form-data','id'=>'form_request_booking']) !!} --}}
                @csrf
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="checkLabModalLabel">Check Hasil Lab</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <label for="nomer_erp">NOMOR ERP</label>
                                <input type="text" name="nomer_erp" id="nomer_erp" class="form-control text-black">
                                <input type="hidden" name="ppbe_id" id="ppbe_id" class="form-control text-black">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="btn" class="btn btn-primary"  id="check_lab_btn">Check</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            {{-- {!! Form::close() !!} --}}
        </div>
    </div>
@elseif ($assets[1] == 'ls_list')
    <div class="modal fade" id="lsPrintModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="lsPrintModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            {{-- {!! Form::open(['route' => ['penugasan.save'],'method' => 'post', 'enctype' => 'multipart/form-data']) !!} --}}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lsPrintModalLabel">Nomor Order ERP </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="ls_id" id="ls_id" class="ls_id text-black form-control mb-2">
                                <input type="text" name="nomor_order_lab" id="nomor_order_lab" class="form-control text-black nomor_order_lab" placeholder="Masukan Nomor Order">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="checkHasilLab()">Check</button>
                    </div>
                </div>
            {{-- {!! Form::close() !!} --}}
        </div>
    </div>
@endif

<div class="modal fade" id="PPBEBatalModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="PPBEBatalModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        {!! Form::open(['route' => ['ppbe.cancel'],'method' => 'post', 'enctype' => 'multipart/form-data','id'=>'form_ppbe_reject']) !!}
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="PPBEBatalModalLabel">PPBE BATAL </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="ppbe_id_reject" id="ppbe_id_reject" class="ppbe_id_reject text-black form-control mb-2">
                            <label for="ppbe_code">Nomor PPBE</label>
                            <input type="text" name="ppbe_code" id="ppbe_code" class="form-control text-black" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="cancel_notes">Alasan</label>
                            <textarea name="cancel_notes" id="cancel_notes" cols="50" rows="2" class="form-control text-black" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="reject_button_save">Simpan</button>
                </div>
            </div>
    {!! Form::close() !!}
    </div>
</div>



<script>
    const assets = @json($assets);
    $(document).ready(function(){
        if ($.fn.DataTable.isDataTable('#dataTable')) {
            // DataTable is already initialized
            // You might want to destroy it before reinitializing
            $('#dataTable').DataTable().destroy();
        }

        if('{{$assets[1]}}' == 'ppbe_list')
        {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('ppbe.index') }}",
                    data: function(d) {
                        d.ppbe_search  = $('#ppbe_search').val();
                        d.company_name_search  = $('#company_name_search').val();
                    }
                },
                columns:[
                    {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data : 'status', name : 'status'},
                    {data : 'code', name : 'code'},
                    {data : 'date_ppbe', name : 'date_ppbe'},
                    {data : 'name', name : 'name'},
                    {data : 'inspection_office', name : 'inspection_office'},
                    {data : 'action', name : 'action', orderable: false, searchable: false }
                ]
            });
        }
        else if('{{$assets[1]}}' == 'penugasan_list')
        {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('penugasan.index') }}",
                    data: function(d) {
                        d.ppbe_search  = $('#ppbe_search').val();
                        d.company_name_search  = $('#company_name_search').val();
                    }
                },
                columns:[
                    {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'code', name: 'code'},
                    {data: 'date_ppbe', name: 'date_ppbe',},
                    {data: 'company_name', name: 'company_name'},
                    {data: 'inspection_office', name: 'inspection_office'},
                    {data: 'inspection_date', name: 'inspection_date'},
                    {data: 'action', name:'action'}
                ]
            });
        }
        else if('{{$assets[1]}}' == 'hplps_list')
        {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('hplps.daftar') }}",
                    data: function(d) {
                        d.ppbe_search  = $('#ppbe_search').val();
                        d.company_name_search  = $('#company_name_search').val();
                    }
                },
                columns:[
                    {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data: 'status', name: 'status'},
                    {data: 'lab_id', name: 'lab_id',},
                    {data: 'is_request', name: 'is_request'},
                    {data: 'code', name: 'code'},
                    {data: 'date_ppbe', name: 'date_ppbe'},
                    {data: 'name', name: 'name'},
                    {data: 'inspection_office', name: 'inspection_office'},
                    {data: 'action', name:'action'}
                ]
            });
        }
        else if('{{$assets[1]}}' == 'perijinan_list')
        {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('perijinan.index') }}",
                    data: function(d) {
                        // d.ppbe_search  = $('#ppbe_search').val();
                        d.company_name_search  = $('#company_name_search').val();
                    }
                },
                columns:[
                    {data : 'id', name : 'id'},
                    {data : 'status', name : 'status'},
                    {data : 'nib', name : 'nib'},
                    {data : 'name', name : 'name'},
                    {data : 'nomor_et', name : 'nomor_et'},
                    {data : 'action', name : 'action'},
                ]
            });
        }
        else if('{{$assets[1]}}' == 'inatrade_list')
        {
            // var table = $('#dataTable').DataTable({
            //     processing: true,
            //     serverSide: true,
            //     ajax: {
            //         url: "{{ route('inatrade.daftar') }}",
            //         data: function(d) {
            //             d.ppbe_search  = $('#ppbe_search').val();
            //             d.company_name_search  = $('#company_name_search').val();
            //             d.ls_search = $('#ls_search').val();
            //         }
            //     },
            //     columns:[
            //         {data: 'id', name: 'id'},
            //         {data: 'company_name', name: 'company_name'},
            //         {data: 'status', name: 'status',},
            //         {data: 'ls_number', name: 'ls_number'},
            //         {data: 'ls_publish_date', name: 'ls_publish_date'},
            //         {data: 'ppbe_number', name: 'ppbe_number'},
            //         {data: 'ppbe_publish_date', name: 'ppbe_publish_date', orderable: false, searchable: false },
            //         {data: 'action', name:'action'}
            //     ]
            // });
        }
        else if($.inArray('bcops',assets) != -1)
        {
            $('#red_verify_btn, #green_verify_btn, #lock_seal_verify_btn, #thread_verify_btn').click(function(e){
                const id = $(this).attr('id');
                const split_id = id.split("_");
                split_id.splice(split_id.length-2,2);
                seal_type = split_id.join("_");

                updateStatusUmum(seal_type,id);

            });

            if($.inArray('bcops_umum',assets) != -1)
            {
                var table = 'umum';
            } else {
                var table = 'surveyor';
            }

            $('#form_bcops_'+table).on('submit',function(e){
                $('#form_bcops_'+table+' input[name$="status"]').each(function(index, elemen){
                    let field_id = elemen.id;
                    let split_name = field_id.split("_");
                    split_name.pop();
                    let name_id = split_name.join("_");
                    if($('#'+field_id).val() ==="Error"){
                        $('#'+name_id+'_series').val('');
                        $('#'+name_id+'_init').val('');
                        $('#'+name_id+'_total').val('');
                    }
                });

                var form = this;
                if (form.checkValidity() === false) {
                    // If the form is not valid, show validation errors
                    e.preventDefault();
                    e.stopPropagation();
                    form.reportValidity();

                    Swal.fire({
                        title: 'Error',
                        text: "Mohon Isi Minimal 1 TPS atau mohon Check Tanggal terima BCOPS",
                        icon: 'warning',
                    });
                } else {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda Yakin',
                        text: "Anda ingin mengajukan BCOPS Ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, submit it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.submit();
                        }
                    });
                }

            });

            $('#form_bcops_umum input').on('input',function(e){
                let target = e.currentTarget.id.split("_");
                target.pop();
                target = target.join("_");

                $('#'+target+'_status').val("Error").html("Error").removeClass('text-success').addClass('text-danger');
            });
        }
        else if('{{$assets[1]}}' == 'userlist')
        {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('users.index') }}",
                },
                columns:[
                    {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data : 'full_name', name : 'full_name'},
                    {data : 'email', name : 'email'},
                    {data : 'status', name : 'status'},
                    {data : 'user_role', name : 'user_role'},
                    {data : 'company.name', name : 'company.name'},
                    {data : 'action', name : 'action'},
                ]
            });


        }
        else if('{{$assets[1]}}' == 'ls_list')
        {
            var table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('ls.daftar') }}",
                    // data: function(d) {
                    //     d.ppbe_search  = $('#ppbe_search').val();
                    //     d.company_name_search  = $('#company_name_search').val();
                    // }
                },
                columns:[
                    {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
                    {data : 'status', name : 'status'},
                    {data : 'code_above', name : 'code_above'},
                    {data : 'code', name : 'code'},
                    {data : 'date_ppbe', name : 'date_ppbe'},
                    {data : 'name', name : 'name'},
                    {data : 'kantor_cabang', name : 'kantor_cabang'},
                    {data : 'action', name : 'action', orderable: false, searchable: false }
                ]
            });
        }


        $("#ppbe_search").on("keyup", function(e) {
            table.draw();
        });
        $("#ppbe_search").on("keyup", function(e) {
            table.draw();
        });
        $("#company_name_search").on("keyup", function(e) {
            table.draw();
        });
        $("#ls_search").on("keyup", function(e) {
            table.draw();
        });

        $('#assign_btn').on('click',function(){
            console.log('b');
        });

        $('#form_request_booking').on('submit',function(e){
            e.preventDefault();
            const type =$('#req_type').val();

            if(type == "")
            {
                swal.fire({
                    title:'Salah',
                    text: "Jenis Permintaan Belum Terisi",
                    icon: "error"
                });
            }

            Swal.fire({
                title: 'Peringatan!',
                text: 'Apakah Anda Yakin akan Kirim Data!',
                icon: "warning",
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                showConfirmButton: true,
                showCancelButton: true,
            }).then((result)=>{
                if (result.isConfirmed){
                    const swalLoading =  Swal.fire({
                        title: 'Please wait...',
                        text: 'Processing your request...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();  // Show the loading spinner
                        }
                    });

                    var formData = new FormData(this);
                    formData.append('_token', '{{ csrf_token() }}');

                    $.ajax({
                        // url : "{{route('hplps.booking')}}",
                        // method:"post",
                        url : $(this).attr('action'),
                        method:$(this).attr('method'),
                        data:formData,
                        processData: false,
                        contentType: false,
                        success:function(response){
                            console.log(response);
                            swal.fire({
                                title:'Success!',
                                text: response.responseJSON.data,
                                icon: "success"
                            });

                            location.reload();
                        },
                        error:function(response){
                            // swalLoading.close();
                            swal.fire({
                                title:'Error!',
                                text: response.responseJSON.data,
                                icon: "error"
                            });
                        },
                        complete: function() {
                            swalLoading.close();
                        }
                    });
                }
            });

        });

        $('#check_lab_btn').click(function(e){
            var nomor_erp = $('#nomer_erp').val();
            var ppbe_id = $('#ppbe_id').val();

            console.log(ppbe_id);
            if(nomor_erp == "")
            {
                swal.fire({
                    title:'Perhatian!',
                    text: "Harap isi Nomor ERP",
                    icon: "warning"
                });
            }

            const swalLoading =  Swal.fire({
                title: 'Please wait...',
                text: 'Processing your request...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();  // Show the loading spinner
                }
            });

            $.ajax({
                url : "{{route('hplps.check_lab')}}",
                method:"post",
                data:{
                    data_erp : nomor_erp,
                    data_ppbe_id : ppbe_id,
                    _token : "{{ csrf_token() }}",
                },
                // processData: false,
                // contentType: false,
                success:function(response){
                    // swalLoading.close();
                    swal.fire({
                        title:'Success!',
                        text: response.data,
                        icon: "success"
                    });
                    location.reload();
                },
                error:function(response){
                    // swalLoading.close();
                    swal.fire({
                        title:'Error!',
                        text: response.data,
                        icon: "error"
                    });
                },
                complete: function() {
                    swalLoading.close();
                }
            })
        });

        $('#reject_button_save').click(function(e){
            Swal.fire({
                title: 'Apakah Anda Yakin',
                text: "Anda ingin mengajukan Form Ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, submit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#form_ppbe_reject').submit();
                }
            });
        })
    });

    function deleteData(id){

        // var itemId = $id;
        var deleteform = $('#form-'+id);
        var urlDelete = deleteform.attr('action');
        Swal.fire({
            icon: "warning",
            text: "Apakah Anda Yakin Akan Hapus Data ini?",
            title: "Perhatian",
            showCancelButton: true,
            confirmButtonText: "Delete",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url:urlDelete,
                    type : 'DELETE',
                    data: {
                        _token : "{{ csrf_token() }}",
                        id : id,
                    },
                    cache : false,
                    success : function(respond){
                        swal.fire({
                            icon: "success",
                            text: "Data Berhasil diHapus",
                            title: "Hapus",
                        }).then((result)=>{
                            if(result.isConfirmed){
                                location.reload();
                            }
                        });
                    }
                })
            }
        });
    }

    function openModalFunction(id)
    {
        $.ajax({
            url : "{{route('ppbe.assignment',['id' => 'ppbe_id'])}}".replace('ppbe_id', id),
            method:"GET",
            data:{
                _token : "{{ csrf_token() }}",
            },
            success:function(response){
                if(response.ppbe != null)
                {
                    $('#surveyor_id').val(response.ppbe.surveyor_id).trigger('change');
                    $('#intervention_type').val(response.ppbe.intervention_type).trigger('change');
                    $('#letter_number').val(response.ppbe.letter_number);
                    $('#penugasan_date').val(response.ppbe.penugasan_date);
                }
            }
        });
        $('#ppbe_id').val(id)
        $('#assignmentModal').modal('show');

        $('.select2_modal').select2({
            placeholder: "Select",
            selectOnClose: true,
            width: 'resolve',
            dropdownParent: $('#assignmentModal')
        });
    }

    function openRequestBookingModal(id)
    {
        $(".request_body").empty();
        $("#req_type").val("");
        $.ajax({
            url : "{{route('hplps.data_booking',['id' => 'hplps_id'])}}".replace('hplps_id', id),
            method:"GET",
            data:{
                _token : "{{ csrf_token() }}",
            },
            success:function(response){
                $('#code').val(response.data.code)
                $('#nib').val(response.data.company.nib)
                $('#npwp').val(response.data.company.npwp)
                $('#no_pe').val(response.data.pe.nomor_pe)
                $('#pe_permit_date').val(response.data.pe.permit_date)
                $.each(response.data.goods,  function(key, value){
                    $('.request_body').append(`
                        <div class="form-group col-lg-4 col-md-4">
                            <label for="hs">NO HS</label>
                            <input type="text" name="goods[hs][`+key+`]" id="hs" class="form-control text-black" value="`+value.hs.hs+`" readonly>
                        </div>
                        <div class="form-group col-lg-4 col-md-4">
                            <label for="total_hs">Jumlah Volume</label>
                            <input type="text" name="goods[total_hs][`+key+`]" id="total_hs" class="form-control text-black" value="`+value.quantity_kg+`" readonly>
                        </div>
                        <div class="form-group col-lg-4 col-md-4">
                            <label for="satuan_hs">satuan</label>
                            <input type="text" name="goods[satuan_hs][`+key+`]" id="satuan_hs" class="form-control text-black" value="KGM" readonly>
                        </div>
                    `)
                });
            }
        });

        $('#requestBookingModal').modal('show');
        $('.select2_modal').select2({
            placeholder: "Select",
            selectOnClose: true,
            width: 'resolve',
            dropdownParent: $('#requestBookingModal')
        });
    }

    function openLSPrintModalFuction(id)
    {
        $('#ls_id').val(id);
        $('#lsPrintModal').modal('show');
    }

    function openPPBEBatalModal(id, code)
    {

        var ppbe_code = code ? code : "-" ;
        $('#ppbe_id_reject').val(id);
        $('#ppbe_code').val(ppbe_code);
        $('#PPBEBatalModal').modal('show');
    }

    function openCheckLabModal(id)
    {
        $('#nomer_erp').val("");
        $('#ppbe_id').val(id);
        $('#checkLabModal').modal('show');
    }

    function updateStatusUmum(seal_type,id)
    {
            var seal_series = $('#'+seal_type+'_series').val();
            var seal_init = $('#'+seal_type+'_init').val();
            var seal_total = $('#'+seal_type+'_total').val();

            var parse_init = parseInt(seal_init);
            var parse_total = parseInt(seal_total);

            if(seal_series === '' || seal_init === '' || seal_total === '')
            {
                Swal.fire({
                    title: 'Error',
                    text: "Masih Terdapat Kolom Kosong pada TPS ",
                    icon: 'warning',
                });
                seal_final=null;
            } else {
                seal_final = parse_init + parse_total-1;
            }

            if(isNaN(seal_final) || seal_final == "" || seal_final== null){
                Swal.fire({
                    title: 'Error',
                    text: "Mohon Masukan Nomor TPS",
                    icon: 'warning',
                });
                seal_final=null;
            } else{
                const data_form = {
                        seal_type :seal_type,
                        seal_series : seal_series,
                        seal_init : seal_init,
                        seal_final : seal_final,
                        seal_total : seal_total,
                        _token : "{{ csrf_token() }}",
                }

                if($.inArray('bcops_umum',assets) != -1)
                {
                    url = "{{route('bcops.umum_check')}}";
                }else{
                    const surveyor_id = $('#surveyor_id').val();
                    data_form['surveyor_id'] = surveyor_id;
                    url = "{{route('bcops.surveyor_umum')}}";
                }
                // console.log(url);

                $.ajax({
                    type:'POST',
                    url:url,
                    data: data_form,
                    success:function(response) {
                        if(response.result == "success")
                        {
                            $('#'+seal_type+'_status').val("success").removeClass('text-danger').addClass('text-success');
                            $('#'+seal_type+'_series').prop('readonly',true);
                            $('#'+seal_type+'_init').prop('readonly',true);
                            $('#'+seal_type+'_total').prop('readonly',true);
                            $('#'+seal_type+'_verify_btn').remove();
                            seal_final=null;
                        }
                    }, error:function(response) {
                        const message = response.responseJSON.message;
                        const result = response.responseJSON.result;
                        if(response.status == 400)
                        {
                            swal.fire({
                                title: "Perhatian",
                                text: message,
                                icon: result
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $('#'+seal_type+'_series').val('');
                                    $('#'+seal_type+'_init').val('');
                                    $('#'+seal_type+'_total').val('');
                                }
                            });
                        }
                    }
                });
            }
    }

    function updateStatusSurveyor()
    {
        console.log('a');
    }
</script>
