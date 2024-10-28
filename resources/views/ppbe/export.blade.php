<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export PPBE</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            color: #333;
        }
        h4 {
            text-align: center;
            color: #004085;
        }
        .container {
            border: 2px solid #004085;
            padding: 20px;
            margin: 20px;
        }
        .customer-info {
            margin-bottom: 20px;
        }
        .customer-info p {
            margin: 0;
            font-size: 14px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid #ddd;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
        }
        .table-listing td{
            padding:3px !important;
        }
        .table th {
            background-color: #f8f9fa;
        }
        .signature {
            text-align: center;
            width: 200px;
            margin-top: 10px;
            margin-left: auto;

        }
        .signature-line {
            border-bottom: 1px dotted #000;
            width: 100%;
            margin: 0 auto;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f1f1f1;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <h4>{{$data['title']}}</h4>
    <div class="container">
        <!-- Customer Info Section -->
        <h5 style="margin-top:-20px; margin-bottom:10px">I. Data Pemohon</h5>
        <table style="width: 100%; font-size:11px; margin-top:-10px;margin-bottom:-20px">
            <tr>
                <td style="width: 40%;">Nama Perusahaan Exportir</td>
                <td style="width: 1%">:</td>
                <td>{{ $data_company->company_name}}</td>
            </tr>
            <tr>
                <td style="width: 40%">Alamat, Telepon dan Fax</td>
                <td>:</td>
                <td>{{ $data_company->company_address}}, {{ $data_company->company_telp}}/{{$data_company->company_hp}} </td>
            </tr>
            <tr>
                <td style="width: 40%">Alamat Email</td>
                <td>:</td>
                <td>{{ $data_company->company_email }}</td>
            </tr>
            <tr>
                <td style="width: 40%">No. dan Tanggal NIB</td>
                <td>:</td>
                <td>{{ $data_company->nib }}, {{ $data_company->date_nib }}</td>
            </tr>
            <tr>
                <td style="width: 40%">No. dan Tanggal ET (Eksportir Terdaftar)</td>
                <td>:</td>
                <td>{{ $data_company->nomor_et }}, {{ $data_company->date_et }}</td>

            </tr>
            <tr>
                <td style="width: 40%">No. dan Tanggal PE (Persetujuan Eksport)</td>
                <td>:</td>
                <td>{{ $data_company->nomor_pe }}, {{ $data_company->date_pe }}</td>

            </tr>
            <tr>
                <td style="width: 40%">NPWP</td>
                <td>:</td>
                <td>{{ $data_company->company_npwp }}</td>
            </tr>
        </table>

        <!-- Table Section -->
        <h5>II. Barang Ekspor</h5>
        <table class="table table-listing" style="font-size:11px; margin-top:-20px; margin-bottom:10px">
            <thead>
                <tr>
                    <th>NOMOR HS & URAIAN BARANG</th>
                    <th>KUANTITAS & SATUAN</th>
                    <th>MEREK & NOMOR KEMASAN</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_ppbe_goods as $goods)
                    <tr>
                        <td>{{ $goods->processed_level_id}} - {{ $goods->description }}</td>
                        <td>{{ $goods->quantity_kg }}Kg</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table style="width: 100%; font-size:11px; margin-top:-10px; margin-bottom:-20px">
            <tr>
                <td style="width: 3%">1. </td>
                <td style="width: 30%;">Nilai FOB</td>
                <td style="width: 1%">:</td>
                <td style="width: 40%">{{ $data_ppbe->fob_total }} {{ $data_ppbe->getCurrency()->code }}</td>
                <td style="width: 5%"></td>
                <td style="width: 5%"></td>
                <td></td>
            </tr>
            <tr>
                <td>2. </td>
                <td>Nomor dan Tanggal Invoice</td>
                <td>:</td>
                <td colspan="4">{{ $data_ppbe->invoice_number }}, {{ $data_ppbe->invoice_date }}</td>
            </tr>
            <tr>
                <td>3. </td>
                <td>Nomor dan Tanggal Packaging List</td>
                <td>:</td>
                <td>{{ $data_ppbe->packaging_list_number }}, {{ $data_ppbe->pakcaging_list_date }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>4. </td>
                <td>Nama dan Alamat Pembeli</td>
                <td>:</td>
                <td>{{ $data_ppbe->buyer_name }}, {{ $data_ppbe->buyer_address }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>5. </td>
                <td>Pelabuhan Muat</td>
                <td>:</td>
                <td>{{ $data_ppbe->getLoadingPort()->name }}</td>
                <td>Kode</td>
                <td>:</td>
                <td>{{ $data_ppbe->getLoadingPort()->code }}</td>
            </tr>
            <tr>
                <td>6. </td>
                <td>Pelabuhan Tujuan</td>
                <td>:</td>
                <td>{{ $data_ppbe->getDestinationPort()->name }}</td>
                <td>Kode</td>
                <td>:</td>
                <td>{{ $data_ppbe->getDestinationPort()->code }}</td>
            </tr>
            <tr>
                <td>7. </td>
                <td>Negara Tujuan</td>
                <td>:</td>
                <td>{{ $data_ppbe->getCountry()->name }}</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <h5>III. Kesiapan Barang</h5>
        <table style="width: 100%; font-size:11px; margin-top:-20px; margin-bottom:-20px">
            <tr>
                <td style="width:1%">1.</td>
                <td style="width:30%">Tempat Penyimpanan Barang</td>
                <td style="width:1%">:</td>
                <td style="width:25%"></td>
                <td style="width:1%">
                    <input type="checkbox" name="" id="check" {{strtolower($data_ppbe->goods_storage) == 'pabrik' ? 'checked' : ''}}>
                </td>
                <td style=>
                    <label for="check" class="mt-1">
                        Gudang Pabrik
                    </label>
                </td>
                <td style="width:1%">
                    <input type="checkbox" name="" id="" {{strtolower($data_ppbe->goods_storage) == 'konsolidator' ? 'checked' : ''}}>
                </td>
                <td style="">
                    Gudang Konsolidator
                </td>
            </tr>
            <tr>
                <td>2.</td>
                <td>Barang Tersebut Siap Diekspor dan Pemeriksaan Diminta Pada:</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>a. Hari/Tanggal</td>
                <td>:</td>
                <td colspan="5">{{ date('l, d F Y', strtotime($data_ppbe->inspection_date)) }}</td>
            </tr>
            <tr>
                <td></td>
                <td>b. Jam</td>
                <td>:</td>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td></td>
                <td>c. Alamat/Telepon</td>
                <td>:</td>
                <td colspan="5">{{ $data_ppbe->inspection_pic_phone }}</td>
            </tr>
            <tr>
                <td></td>
                <td>d. Petugas yang Dapat Dihubungi</td>
                <td>:</td>
                <td colspan="5">{{ $data_ppbe->inspection_pic_name }}</td>
            </tr>
            <tr>
                <td>3.</td>
                <td>Tanggal Pengambilan Sampel Uji</td>
                <td>:</td>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td></td>
                <td>Jam</td>
                <td>:</td>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td>4.</td>
                <td>Tanggal dan Tempat Pelaksanaan Stuffing</td>
                <td>:</td>
                <td colspan="5">{{ $data_ppbe->getLoadingPort()->name }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Jam</td>
                <td>:</td>
                <td></td>
                <td></td>
            </tr>
        </table>

        <h5>IV. Cara Pengapalan</h5>
        <table style="width: 100%; font-size:11px; margin-top:-20px">
            @if($data_ppbe->memorize_type == 1)
                <tr>
                    <td style="width:5%">
                        <input type="checkbox" id="" {{$data_ppbe->memorize_type == 1 ? 'checked' : ''}}>
                    </td>
                    <td style="width:23%">FCL</td>
                    <td style="width:20%">Jumlah Peti Kemas:</td>
                    <td style="width:2%"></td>
                    <td style="width:8%">20 Feet:</td>
                    <td style="width:12%">_____ Unit</td>
                    <td style="width:2%"></td>
                    <td style="width:8%">40 Feet:</td>
                    <td style="">_____ Unit</td>
                </tr>
            @elseif($data_ppbe->memorize_type == 2)
                <tr>
                    <td style="width:5%">
                        <input type="checkbox" id="" {{$data_ppbe->memorize_type == 2 ? 'checked' : ''}}>
                    </td>
                    <td style="width:15%">LCL</td>
                    <td style="width:20%">Jumlah Peti Kemas:</td>
                    <td style="width:2%"></td>
                    <td style="width:8%">20 Feet:</td>
                    <td style="width:12%">_____ Unit</td>
                    <td style="width:2%"></td>
                    <td style="width:8%">40 Feet:</td>
                    <td style="">_____ Unit</td>
                </tr>
            @elseif($data_ppbe->memorize_type == 3)
                <tr>
                    <td>
                        <input type="checkbox" id="" {{$data_ppbe->memorize_type == 3 ? 'checked' : ''}}>
                    </td>
                    <td>Konvensional (Udara, dll)</td>
                </tr>
            @endif
        </table>

        <h5 style="margin-top:0px">Bersama Ini kami Sampaikan Kelengkapan Dokumen</h5>
        <table style="width: 100%; font-size:11px; margin-top:-20px">
            <tr>
                <td style="width:5%"><input type="checkbox" name="" id=""></td>
                <td>Copy NIB</td>
            </tr>
            <tr>
                <td style="width:5%"><input type="checkbox" name="" id=""></td>
                <td>Copy PE</td>
            </tr>
            <tr>
                <td style="width:5%"><input type="checkbox" name="" id=""></td>
                <td>Packing List</td>
            </tr>
            <tr>
                <td style="width:5%"><input type="checkbox" name="" id=""></td>
                <td>Invoice</td>
            </tr>
        </table>
        <div class="signature">
            <p style="font-size:12px">Pemohon:</p>
            <br><br><br>
            <div class="signature-line"></div>
        </div>
    </div>

    {{-- <div class="footer">
        Generated on: {{ date('Y-m-d H:i:s') }}
    </div> --}}
</body>
</html>
