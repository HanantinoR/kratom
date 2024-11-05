<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Surat Tugas</title>
        <style>
            body {
                font-family: 'Helvetica', sans-serif;
                color: #333;
            }
            h1 {
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
                border: 1px solid #000000;
            }
            .table th, .table td {
                padding: 10px;
                text-align: left;
            }
            .table th {
                background-color: #68b1f9;
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
            .container-twopart {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
                flex-wrap: nowrap;
                width:100%;
                overflow:hidden;
            }
            .left-section, .right-section {
                padding: 10px;
                border: 1px solid #000;
                box-sizing: border-box;
                flex-grow: 1;
                flex-shrink: 1;
                margin-right: 10px;
            }
            .left-section {
                float:left;
                width: 40%;
            }
            .right-section {
                float:right;
                margin-right:0;
                width:50%;
                font-size:10px;
            }
            .float-escape::after {
            content: "";
            display: table;
            clear: both;
        }
        </style>
    </head>
    <body>
        {{-- {{dd($data['tugas'])}} --}}
        <h2 style="text-align: center">Surat Tugas</h2>
        @foreach ($data['tugas'] as $tugas)
            <div class="container">
                <table style="width: 100%; font-size:14px; margin-top:-10px">
                    <tr>
                        <td style="width: 20%;">Nomor PPBE</td>
                        <td style="width: 5%">:</td>
                        <td><strong>{{$tugas->code}}</strong></td>
                    </tr>
                </table>
                <h4 style="margin-top:5px">Pimpinan PT. SUCOFINDO (Persero) Memerintahkan Kepada:</h4>
                <table style="width: 100%; font-size:14px; margin-top:-15px">
                    <tr>
                        <td style="width:2%">1.</td>
                        <td style="width:10%">Nama</td>
                        <td style="width:2%">:</td>
                        <td>{{$tugas->first_name}} {{$tugas->last_name}}</td>
                    </tr>
                    <tr>
                        <td style="width:2%">2.</td>
                        <td style="width:10%">NPP.</td>
                        <td style="width:2%">:</td>
                        <td>............</td>
                    </tr>
                </table>
                <h4 style="margin-top:-2px">Untuk Melakukan Pemeriksaan Diatas:</h4>
                <table style="width: 100%; font-size:14px; margin-top:-15px">
                    <tr>
                        <td style="width:2%">1.</td>
                        <td style="width:20.3%">Komoditi</td>
                        <td style="width:2%">:</td>
                        <td style="width:15%"></td>
                        <td style="width:10%"></td>
                        <td style="width:10%"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>REALISASI:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Kuantitas/Satuan</td>
                        <td>:</td>
                        <td>
                            @foreach ($tugas->goods as $good)
                                {{$good->quantity_kg}} KG <br>
                            @endforeach
                        </td>
                        <td>
                            @foreach ($tugas->goods as $good)
                                [.................]
                            @endforeach
                        </td>
                    </tr>
                    <br>
                    <tr>
                        <td>3.</td>
                        <td>Jenis Intervensi</td>
                        <td>:</td>
                        <td></td>
                        <td>Jam:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>  a. Pemeriksaan Barang</td>
                        <td>:</td>
                        <td>{{date("d F Y", strtotime($tugas->inspection_date))}}</td>
                        <td>[ {{date("H:i", strtotime($tugas->inspection_date))}} ]</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>  b. Pengawasan Stuffing</td>
                        <td>:</td>
                        <td>{{date("d F Y", strtotime($tugas->stuffing_date))}}</td>
                        <td>[ {{date("H:i", strtotime($tugas->stuffing_date))}} ]</td>
                    </tr>
                </table>
                <br>
                <table style="width: 100%; font-size:14px; margin-top:-15px">
                    <tr>
                        <td style="width:2%">4.</td>
                        <td style="width:35%">Nama Eksportir</td>
                        <td style="width:2%">:</td>
                        <td>{{$tugas->company_name}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{$tugas->company_address}}</td>
                    </tr>
                    <br>
                    <tr>
                        <td>5.</td>
                        <td>Tempat Pelaksanaan</td>
                        <td>:</td>
                        <td>{{$tugas->inspection_address}}</td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Rencana Berangkat</td>
                        <td>:</td>
                        <td>{{$tugas->inspection_date}}</td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>Rencana Selesai</td>
                        <td>:</td>
                        <td>{{$tugas->inspection_date}}</td>
                    </tr>
                </table>
                <div class="signature">
                    <p style="font-size:15px margin-top:0px">Yang Memberi Tugas:</p>
                    <br><br><br>
                    <div class="">(Nama:........................)</div>
                    <div>NPP:........................ </div>
                </div>
                <div class="container-twopart float-escape">
                    <div class="left-section" style="background: rgb(120, 245, 120); font-size:14px;">
                        <p><strong>Diisi Oleh Pelanggan</strong></p>
                        <p>Tgl.Mulai : ....../....../......Jam :......</p>
                        <p>Tgl.selesai : ....../....../.....Jam :.....</p>
                        Tanda Tangan & Stempel Pelanggan
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p></p>
                        <p>(Nama : .......................................)</p>
                        Jabatan : ......................................
                    </div>

                    <div class="right-section">
                        <table class="table" >
                            <thead >
                                <tr>
                                    <th rowspan="2" style="text-align: center;">Tanggal</th>
                                    <th colspan="3" style="text-align: center;">JAM KERJA</th>
                                    <th rowspan="2" style="text-align: center;">Paraf</th>
                                </tr>
                                <tr>
                                    <th style="text-align: center;">Mulai</th>
                                    <th style="text-align: center;">Selesai</th>
                                    <th style="text-align: center;">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                        <p></p>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="font-size: 14px;"><strong> TOTAL JAM</strong></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        @endforeach
    </body>
</html>
