<x-app-layout :assets="$assets ?? []">
    <div class="row">
        <div class="col-xl-12 col-lg-10">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="header-title  text-center pb-3">
                        <h4 class="card-title text-white">DETAIL PE</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="new-user-info">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">Nomor PE</label>
                                <input type="text" name="" id="" class="form-control text-black" value="{{$data_pe->nomor_pe}}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Tanggal Izin</label>
                                <input type="text" name="" id="" class="form-control text-black" value="{{$data_pe->date_start}}" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="">File Pe</label>
                                <div class="row mt-2">
                                    <a href="{{url('pe_file/'.$data_pe->file_pe)}}" target="_blank" class="me-2 text-left">
                                        <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2 16.08V7.91C2 4.38 4.271 2 7.66 2H16.33C19.72 2 22 4.38 22 7.91V16.08C22 19.62 19.72 22 16.33 22H7.66C4.271 22 2 19.62 2 16.08ZM12.75 14.27V7.92C12.75 7.5 12.41 7.17 12 7.17C11.58 7.17 11.25 7.5 11.25 7.92V14.27L8.78 11.79C8.64 11.65 8.44 11.57 8.25 11.57C8.061 11.57 7.87 11.65 7.72 11.79C7.43 12.08 7.43 12.56 7.72 12.85L11.47 16.62C11.75 16.9 12.25 16.9 12.53 16.62L16.28 12.85C16.57 12.56 16.57 12.08 16.28 11.79C15.98 11.5 15.51 11.5 15.21 11.79L12.75 14.27Z" fill="currentColor"></path>
                                        </svg>
                                        Download File PE
                                    </a>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="">Tanggal Awal</label>
                                <input type="text" name="" id="" class="form-control text-black" value="{{$data_pe->date_start}}" readonly>
                            </div>
                        </div>
                        <hr>
                        <h5 class="text-black">Komoditas</h5>
                        @foreach ($data_pe->pe_detail as $detail)
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="">No HS</label>
                                    <input type="text" name="" id="" class="form-control text-black" value="{{$detail->hs}}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="">Barang</label>
                                    <input type="text" name="" id="" class="form-control text-black" value="{{$detail->detail}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Kuota</label>
                                    <input type="text" name="" id="" class="form-control text-black" value="{{$detail->volume_total}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Kuota Sisa</label>
                                    <input type="text" name="" id="" class="form-control text-black" value="{{$detail->volume_sisa}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Kuota Tersedia</label>
                                    <input type="text" name="" id="" class="form-control text-black" value="{{$detail->volume_tersedia}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Terpakai LS</label>
                                    <input type="text" name="" id="" class="form-control text-black" value="{{$detail->terpakai_ls}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Booking LS</label>
                                    <input type="text" name="" id="" class="form-control text-black" value="{{$detail->booking_ls}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="">Satuan</label>
                                    <input type="text" name="" id="" class="form-control text-black" value="KGM" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="">Pelabuhan Muat</label>
                                    <input type="text" name="" id="" class="form-control text-black" value="" readonly>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-info">
                    <div class="header-title text-center pb-3">
                        <h4 class="card-title text-white">TRANSAKSI PE</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table form-table table-responsive lg">
                            <thead>
                                <tr>
                                    <th>no</th>
                                    <th>PPBE</th>
                                    <th style="width:15%">LS</th>
                                    <th style="">Request Alokasi</th>
                                    <th style="">Inatrade</th>
                                    <th style="">Kuota Tersedia</th>
                                    <th style="">Kuota Sisa</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- <tr>
                                    <td>1</td>
                                    <td>23.25.00001-K</td>
                                    <td>-</td>
                                    <td>300</td>
                                    <td>-</td>
                                    <td>700</td>
                                    <td>1000</td>
                                    <td>PPBE Ter-verifikasi</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>23.25.00001-K</td>
                                    <td>23.1.25.00001-K</td>
                                    <td>300</td>
                                    <td>300</td>
                                    <td>700</td>
                                    <td>700</td>
                                    <td>LS Ter-verifikasi</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>23.25.00002-K</td>
                                    <td>-</td>
                                    <td>100</td>
                                    <td>-</td>
                                    <td>600</td>
                                    <td>700</td>
                                    <td>PPBE Ter-verifikasi</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>23.25.00002-K</td>
                                    <td>-</td>
                                    <td>+100</td>
                                    <td>-</td>
                                    <td>700</td>
                                    <td>700</td>
                                    <td>PPBE Batal</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>23.25.00001-K</td>
                                    <td>23.1.25.00001-K</td>
                                    <td>-</td>
                                    <td>+300</td>
                                    <td>700</td>
                                    <td>1000</td>
                                    <td>LS Batal</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="d-flex h-64 bg-gray-100 mb-4" style="justify-content:center; align-items:center;">
                <a href="{{route('perijinan.edit',$data_pe->company_id)}}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</x-app-layout>
