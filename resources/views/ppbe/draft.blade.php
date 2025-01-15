<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekaman PPBE</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
        }
        h4 {
            text-align: center;
            color: #000000;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        .table, .table th, .table td {
            border: 1px solid #000000;
        }
        .table td {
            padding: 3px;
            text-align: left;
            color: #000000
        }
    </style>
</head>
<body>
    {{-- {{dd($data_ppbe)}} --}}
    <h4 style="margin-top:-10px">{{$data['title']}}</h4>
    <div class="container" style="margin-top:-10px">
        <table class="table table-bordered">
            <tbody>
                <tr style="background: rgb(236, 229, 229)">
                    <td style="width: 18px ">No</td>
                    <td style="width: 144px">Elemen Data</td>
                    <td style="width: 355px">Data</td>
                    <td style="width: 25px ">Check</td>
                </tr>
                <tr>
                    <td style="font-weight:bold;" >I</td>
                    <td style="font-weight:bold;" colspan="3">Data Pemohon</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Nomor PPBE</td>
                    <td>{{$data_ppbe->code}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Tanggal PPBE</td>
                    <td>{{date('d F Y', strtotime($data_ppbe->date))}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Nama</td>
                    <td>{{$data_ppbe->company->company_name}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Alamat</td>
                    <td>{{$data_ppbe->company->company_address}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>No, Tanggal NIB</td>
                    <td>{{$data_ppbe->company->nib}}, Tanggal : {{date('d F Y', strtotime($data_ppbe->company->date_nib))}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Nomor, Tanggal ET</td>
                    <td>{{$data_ppbe->company->nomor_et}}, Tanggal : {{date('d F Y', strtotime($data_ppbe->company->date_et))}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Nomor, Tanggal PE</td>
                    <td>{{$data_ppbe->company->nomor_pe}}, Tanggal : {{date('d F Y', strtotime($data_ppbe->company->date_pe))}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Nomor NPWP</td>
                    <td>{{$data_ppbe->company->company_npwp}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;" >II</td>
                    <td style="font-weight:bold;" colspan="3">Barang Ekspor</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Jenis Komoditas</td>
                    <td>Kratom</td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td colspan="2">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>HS</td>
                                    <td>Jenis</td>
                                    <td>Uraian Brang</td>
                                    <td>Jumlah</td>
                                    <td>Nilai FOB</td>
                                </tr>
                                @foreach ($data_ppbe->goods as $key=>$good)
                                <tr>
                                    <td>{{$good->processed_level_id}}</td>
                                    <td>{{$key}}</td>
                                    <td>{{$good->description}}</td>
                                    <td>{{$good->quantity_kg}} KG</td>
                                    <td>{{$good->fob_value}} {{$data_ppbe->currency_code}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Total Kemasan</td>
                    <td>{{$data_ppbe->packing_total}} {{$data_ppbe->packing_type}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Nilai FOB</td>
                    <td>{{$data_ppbe->fob_total}} {{$data_ppbe->currency_code}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Nomor, Tanggal Invoice</td>
                    <td>{{$data_ppbe->invoice_number}}, Tanggal : {{$data_ppbe->invoice_date}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Nomor, Tanggal Packing List</td>
                    <td>{{$data_ppbe->packing_list_number}}, Tanggal : {{$data_ppbe->packing_list_date}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Nama Importir</td>
                    <td>{{$data_ppbe->buyer_name}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Alamat Importir</td>
                    <td>{{$data_ppbe->buyer_address}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Pelabuhan Asal</td>
                    <td>{{$data_ppbe->origin_name}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Pelabuhan Muat</td>
                    <td>{{$data_ppbe->loading_name}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Pelabuhan Tujuan</td>
                    <td>{{$data_ppbe->destination_name}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Negara Pelabuhan</td>
                    <td>{{$data_ppbe->country_destination_name}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Negara Tujuan</td>
                    <td>{{$data_ppbe->country_name}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;" >III</td>
                    <td style="font-weight:bold;" colspan="3">Kesiapan Barang</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Tempat Penyimpanan Barang</td>
                    <td>
                        @if ($data_ppbe->goods_storage === "pabrik")
                            Gudang Pabrik
                        @else
                            Gudang Konsolidator
                        @endif
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Tanggal Periksa</td>
                    <td>{{date('d F Y', strtotime($data_ppbe->inspection_date))}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Tempat Periksa</td>
                    <td>{{$data_ppbe->inspection_address}}</td>
                    <td></td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>Petugas </td>
                    <td>{{$data_ppbe->inspection_pic_name}}</td>
                    <td></td>
                </tr>

                <tr>
                    <td>5</td>
                    <td>Tanggal Stuffing</td>
                    <td>{{$data_ppbe->stuffing_date}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Tempat Stuffing</td>
                    <td>{{date('d F Y', strtotime($data_ppbe->stuffing_address))}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="font-weight:bold;" >IV</td>
                    <td style="font-weight:bold;" colspan="3">Cara Pengapalan</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Cara Pengapalan</td>
                    <td>
                        @if ($data_ppbe->memorize_type == 1)
                            FCL
                        @elseif ($data_ppbe->memorize_type === 2)
                            LCL
                        @else
                            KONV
                        @endif
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Ukuran Container</td>
                    <td>{{$data_ppbe->memorize_size}} Feet : {{$data_ppbe->memorize_total}} Unit</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <p style="font-size: 12px"> SURABAYA, {{now()->format('d F Y')}}</p>
        <p style="font-size: 12px"> Petugas Verifikator</p>
        <p></p>
        <p></p>
        <p style="font-size: 12px">(User)</p>
        <p style="font-size: 12px">NPP</p>
    </div>
</body>
</html>
