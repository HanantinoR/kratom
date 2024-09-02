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
                            <h4 class="card-title">{{ $pageTitle ?? 'List'}}</h4>
                        </div>
                        <div class="card-action">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="pengajuan_code" class="form-label">Nomor Pengajuan:</label>
                                {{Form::search('pengajuan_code_search',null,["class"=>"form-control form-control-sm","id"=>"pengajuan_code_search","aria-controls"=>"dataTable"])}}
                            </div>
                            <div class="col-md-4">
                                <label for="pengajuan_code" class="form-label">Nama Perusahaan:</label>
                                {{Form::search('company_name_search',null,["class"=>"form-control form-control-sm","id"=>"company_name_search","aria-controls"=>"dataTable"])}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">{{ $tableTitle ?? 'List'}}</h4>
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
    // console.log($assets);
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

    $("#pengajuan_code_search").on("keyup", function(e) {
        table.draw();
    });
    $("#company_name_search").on("keyup", function(e) {
        table.draw();
    });
});
</script>
