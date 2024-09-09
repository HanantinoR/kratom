@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $tableTitle ?? 'List'}}</h4>
                        </div>
                        <div class="card-action">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($assets[1] == 'pengajuan_list')
                                <div class="col-md-4">
                                    <label for="pengajuan_code" class="form-label">Nomor Pengajuan:</label>
                                    {{Form::search('pengajuan_code_search',null,["class"=>"form-control form-control-sm","id"=>"pengajuan_code_search","aria-controls"=>"dataTable"])}}
                                </div>
                                <div class="col-md-4">
                                    <label for="pengajuan_code" class="form-label">Nama Perusahaan:</label>
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
<script>
$(document).ready(function(){
    if ($.fn.DataTable.isDataTable('#dataTable')) {
        // DataTable is already initialized
        // You might want to destroy it before reinitializing
        $('#dataTable').DataTable().destroy();
    }

    if('{{$assets[1]}}' == 'pengajuan_list')
    {
        var table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('pengajuan.index') }}",
                data: function(d) {
                    d.pengajuan_code_search  = $('#pengajuan_code_search').val();
                    d.company_name_search  = $('#company_name_search').val();
                }
            },
            columns:[
                {data : 'id', name : 'id'},
                {data : 'status', name : 'status'},
                {data : 'pengajuan_code', name : 'pengajuan_code'},
                {data : 'company_name', name : 'company_name'},
                {data : 'pengajuan_date', name : 'pengajuan_date'},
                {data : 'office_inspection', name : 'office_inspection'},
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
                    // d.pengajuan_code_search  = $('#pengajuan_code_search').val();
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
                {data: 'status', name: 'status'},
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
    $("#pengajuan_code_search").on("keyup", function(e) {
        table.draw();
    });
    $("#company_name_search").on("keyup", function(e) {
        table.draw();
    });
    $("#ls_search").on("keyup", function(e) {
        table.draw();
    });
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
</script>
