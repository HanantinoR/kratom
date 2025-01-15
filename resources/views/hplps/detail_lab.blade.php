<x-app-layout :assets="$assets ?? []">
    <div class="row">
        {{-- {{dd($lab_json)}} --}}
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-center">
                    <h3 class="card-title">Hasil Analisa Lab</h3>
                    <div class="card-action">
                        {{-- <a href="{{ route('ppbe.index') }}" class="btn btn-sm btn-primary" role="button">Back</a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nomor_erp" class="form-label">Nomor ERP: <span class="text-danger">*</span></label>
                            <h4 class="ms-4 mt-2 text-info text-center">{{$lab_json->data->order->no_erp}}</h4>
                            {{-- {{ Form::text('nomor_erp', old('nomor_erp',$lab_json->data->order->no_erp), ['class' => 'form-control text-black', 'id' => 'nomor_erp', 'readonly']) }} --}}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nomor_order" class="form-label">Nomor Order: <span class="text-danger">*</span></label>
                            <h4 class="ms-4 mt-2 text-info text-center" id="nomor_order" name="nomor_oreder">{{$lab_json->data->order->no_order}}</h4>
                            {{-- {{ Form::text('nomor_erp', old('nomor_erp',$lab_json->data->order->no_erp), ['class' => 'form-control text-black', 'id' => 'nomor_erp', 'readonly']) }} --}}
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nama_pelanggan" class="form-label">Nama Pelanggan: <span class="text-danger">*</span></label>
                            {{ Form::text('nama_pelanggan', old('nama_pelanggan',$lab_json->data->order->nama_pelanggan), ['class' => 'form-control text-black', 'id' => 'nama_pelanggan', 'readonly']) }}
                        </div>
                        <div class="form-group col-md-6">
                            <label for="tanggal_order_erp" class="form-label">Tanggal Order: <span class="text-danger">*</span></label>
                            {{ Form::text('tanggal_order_erp', old('tanggal_order_erp',$lab_json->data->order->tanggal_order), ['class' => 'form-control text-black', 'id' => 'tanggal_order_erp', 'readonly']) }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mt-4">
                            <div class="row">
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="komoditi_label">Komoditi :</label>
                                    <h4 class="text-blue mb-4" id="komoditi_label">{{$lab_json->data->komoditi[0]->komoditi_label}}</h4>
                                </div>
                                <div class="form-group col-lg-6 col-md-6">
                                    <label for="komoditi_label">No Lab :</label>
                                    <h4 class="text-blue mb-4" id="komoditi_label">{{$lab_json->data->komoditi[0]->no_lab}}</h4></div>
                            </div>
                            @foreach ($lab_json->data->komoditi[0]->sample as $key => $sample)
                                {{-- {{dd($sample)}} --}}
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="nama_sample" class="form-label">PPBE Sample: <span class="text-danger">*</span></label>
                                        {{ Form::text('nama_sample', old('nama_sample',$sample->kode_sample), ['class' => 'form-control text-black', 'id' => 'nama_sample', 'readonly']) }}
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="kemasan_label" class="form-label">Kemasan Sample: <span class="text-danger">*</span></label>
                                        {{ Form::text('kemasan_label', old('kemasan_label',$sample->kemasan_label), ['class' => 'form-control text-black', 'id' => 'kemasan_label', 'readonly']) }}
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table form-table table-bordered table-responsive-lg table-hover" role="grid">
                                        <thead>
                                            <tr class="text-white bg-primary">
                                                <th style="text-align:center; align-content:center;" rowspan="2">Parameter</th>
                                                <th style="text-align:center; align-content:center;" rowspan="2">Satuan</th>
                                                <th style="text-align:center; align-content:center;" rowspan="2">Hasil Uji</th>
                                                <th style="text-align:center; align-content:center;" colspan="2">Persyaratan BPOM</th>
                                                <th style="text-align:center; align-content:center;" rowspan="2">Metode</th>
                                            </tr>
                                            <tr class="text-white bg-primary">
                                                <th style="text-align:center;align-content:center; width:15%">Kratom Putih dan Hijau</th>
                                                <th style="text-align:center;align-content:center; ">Kratom Merah</th>
                                            </tr>
                                        </thead>
                                        {{-- <tbody>
                                            <tr>
                                                <td> - Mitragynine</td>
                                                <td style="text-align:center">%</td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center"> &ge; 1.2</td>
                                                <td style="text-align:center"> &ge; 0.8</td>
                                                <td style="text-align:center"></td>
                                            </tr>
                                            <tr>
                                                <td> - Timbal (Pb)</td>
                                                <td style="text-align:center">mg/kg</td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center">&le; 10</td>
                                                <td style="text-align:center">&le; 10</td>
                                                <td style="text-align:center"></td>
                                            </tr>
                                            <tr>
                                                <td> - Kadmium (Cd)</td>
                                                <td style="text-align:center">mg/kg</td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center">&le; 0.3</td>
                                                <td style="text-align:center">&le; 0.3</td>
                                                <td style="text-align:center"></td>
                                            </tr>
                                            <tr>
                                                <td> - Arsen (As)</td>
                                                <td style="text-align:center">mg/kg</td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center">&le; 5</td>
                                                <td style="text-align:center">&le; 5</td>
                                                <td style="text-align:center"></td>
                                            </tr>
                                            <tr>
                                                <td> - Merkuri (Hg)</td>
                                                <td style="text-align:center">mg/kg</td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center">&le; 0.5</td>
                                                <td style="text-align:center">&le; 0.5</td>
                                                <td style="text-align:center"></td>
                                            </tr>
                                            <tr>
                                                <td> - Kadar Air</td>
                                                <td style="text-align:center">%</td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center">&le; 10</td>
                                                <td style="text-align:center">&le; 10</td>
                                                <td style="text-align:center"></td>
                                            </tr>
                                            <tr>
                                                <td style="font-style: italic;"> - Ukuran Partikel</td>
                                                <td style="text-align:center">μm</td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center">&le; 600</td>
                                                <td style="text-align:center">&le; 600</td>
                                                <td style="text-align:center"></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align:center">Mikrobiologi:</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td style="font-style: italic;"> - Escherichia coli</td>
                                                <td style="text-align:center">APM/g</td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center">&le; 10</td>
                                                <td style="text-align:center">&le; 10</td>
                                                <td style="text-align:center"></td>
                                            </tr>
                                            <tr>
                                                <td style="font-style: italic;"> - Salmonella sp</td>
                                                <td style="text-align:center">Koloni/25g</td>
                                                <td style="text-align:center"></td>
                                                <td style="text-align:center">Negatif/g</td>
                                                <td style="text-align:center">Negatif/g</td>
                                                <td style="text-align:center"></td>
                                            </tr>
                                        </tbody> --}}
                                        <tbody>
                                            @foreach ($sample->hasil_analisa as $key => $result)
                                                {{-- {{dd($key,$result)}} --}}
                                                <tr>
                                                    <td> {{$result->nama_parameter}}</td>
                                                    <td> {{$result->unit_satuan}}</td>
                                                    <td> {{$result->nilai_uji}}</td>
                                                    <td> {{$result->nilai_uji_min}}</td>
                                                    <td> {{$result->nilai_uji_min}}</td>
                                                    <td> {{$result->metode_label}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
