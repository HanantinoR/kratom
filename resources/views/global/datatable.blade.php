@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
<style>
    .dataTables_filter{
        display:none;
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
                            @if($assets[1] == 'pengajuan_list')
                                <div class="col-md-4">
                                    <label for="pengajuan_code" class="form-label">Nomor PPBE:</label>
                                    {{Form::search('ppbe_search',null,["class"=>"form-control form-control-sm","id"=>"ppbe_search","aria-controls"=>"dataTable"])}}
                                </div>
                                <div class="col-md-4">
                                    <label for="pengajuan_code" class="form-label">Nama Perusahaan:</label>
                                    {{Form::search('company_name_search',null,["class"=>"form-control form-control-sm","id"=>"company_name_search","aria-controls"=>"dataTable"])}}
                                </div>
                            @elseif($assets[1] == 'penugasan_list')
                                <div class="col-md-3">
                                    <label for="ppbe_search" class="form-label">Nomor PPBE</label>
                                    {{Form::search('ppbe_search',null,["class"=>"form-control form-control-sm","id"=>"ppbe_search","aria-controls"=>"dataTable"])}}
                                </div>
                                <div class="col-md-3">
                                    <label for="company_name_search" class="form-label">Nama Perusahaan:</label>
                                    {{Form::search('company_name_search',null,["class"=>"form-control form-control-sm","id"=>"company_name_search","aria-controls"=>"dataTable"])}}
                                </div>
                            @elseif($assets[1] == 'perijinan_list')
                                <div class="col-md-3">
                                    <label for="company_name_search" class="form-label">Nama Perusahaan:</label>
                                    {{Form::search('company_name_search',null,["class"=>"form-control form-control-sm","id"=>"company_name_search","aria-controls"=>"dataTable"])}}
                                </div>
                            @elseif($assets[1] == 'inatrade_list')
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
                                </div>
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
    <div class="modal fade" id="assignmentModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="assignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            {!! Form::open(['route' => ['penugasan.save'],'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignmentModalLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                     {{ Form::hidden('ppbe_id', old('ppbe_id'), ['class' => 'form-control text-black m-0','id'=>'ppbe_id' ,'placeholder' => 'Nama']) }}
                    <div class="modal-body p-2">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="form-label" for="surveyor_id">Nama Surveyor: <span class="text-danger">*</span></label>
                                {{ Form::text('surveyor_id', old('surveyor_id'), ['class' => 'form-control text-black m-0','id'=>'surveyor_id' ,'placeholder' => 'Nama', 'required']) }}
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label" for="intervention_type">Jenis Intervensi: <span class="text-danger">*</span></label>
                                {{ Form::text('intervention_type', old('intervention_type'), ['class' => 'form-control text-black m-0','id'=>'intervention_type' ,'placeholder' => 'Intervensi', 'required']) }}
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label" for="letter_number">No Surat Penugasan ERP: <span class="text-danger">*</span></label>
                                {{ Form::text('letter_number', old('letter_number'), ['class' => 'form-control text-black m-0','id'=>'letter_number' ,'placeholder' => 'Number', 'required']) }}
                            </div>
                            <div class="col-lg-3">
                                <label class="form-label" for="penugasan_date">Tanggal Penugasan: <span class="text-danger">*</span></label>
                                {{ Form::text('penugasan_date', old('penugasan_date'), ['class' => 'form-control text-black m-0','id'=>'penugasan_date' ,'placeholder' => 'Tanggal', 'required']) }}
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
<script>
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
                {data : 'id', name : 'id'},
                {data : 'status', name : 'status'},
                {data : 'code', name : 'code'},
                {data : 'date', name : 'date'},
                {data : 'company_name', name : 'company_name'},
                {data : 'inspection_office_id', name : 'inspection_office_id'},
                {data : 'action', name : 'action', orderable: false, searchable: false }
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
                {data : 'company_name', name : 'company_name'},
                {data : 'nomor_et', name : 'nomor_et'},
                {data : 'nomor_pe', name : 'nomor_pe'},
                {data : 'company_npwp', name : 'company_npwp'},
                {data : 'date_nib', name : 'date_nib'},
                {data : 'company_email', name : 'company_email'},
                {data : 'action', name : 'action'},
            ]
        });


    }
    else if('{{$assets[1]}}' == 'inatrade_list')
    {
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('inatrade.daftar') }}",
                data: function(d) {
                    d.ppbe_search  = $('#ppbe_search').val();
                    d.company_name_search  = $('#company_name_search').val();
                    d.ls_search = $('#ls_search').val();
                }
            },
            columns:[
                {data: 'id', name: 'id'},
                {data: 'company_name', name: 'company_name'},
                {data: 'status', name: 'status',},
                {data: 'ls_number', name: 'ls_number'},
                {data: 'ls_publish_date', name: 'ls_publish_date'},
                {data: 'ppbe_number', name: 'ppbe_number'},
                {data: 'ppbe_publish_date', name: 'ppbe_publish_date', orderable: false, searchable: false },
                {data: 'action', name:'action'}
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

    if('{{$assets[1]}}' == 'penugasan_list')
    {
        console.log('b');
        $('#assign_btn').on('click',function(){
            console.log('a');
        });
    }
    $('#assign_btn').on('click',function(){
        console.log('b');
    })
});
    function deleteData(id){

        // var itemId = $id;
        var deleteform = $('#form-'+id);
        var urlDelete = deleteform.attr('action');
        // console.log(urlDelete);
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
            url : "/data_ppbe/"+id,
            method:"GET",
            data:id,
            success:function(response){
                console.log(response);
                if(response.ppbe != null)
                {
                    $('#surveyor_id').val(response.ppbe.surveyor_id)
                    $('#intervention_type').val(response.ppbe.intervention_type)
                    $('#letter_number').val(response.ppbe.letter_number)
                }
            }
        });
        $('#ppbe_id').val(id);
        $('#assignmentModal').modal('show');

    }
</script>
