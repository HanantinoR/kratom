<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export PPBE</title>
    <style>
        body {
            /* font-family: 'Helvetica', sans-serif; */
            font-family: 'FontName';
            font-size: 10px;
            color: #333;
        }
        h1 {
            text-align: center;
            color: #004085;
        }
        .container {
            /* border: 0.5px solid #004085; */
            /* padding: 20px; */
            margin-top: 25px;
            margin-bottom: 5px;
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
            border: 2px solid black;

            padding: 0;
            margin: 0;
        }
        .table, .table th, .table td {

            border: 2px solid #424242;

            padding: 0;
            margin: 0;
        }
        td {
            border: none;
        }
        .table th, .table td {
            padding: 3px;
            text-align: left;
            padding: 0;
            margin: 0;
            padding-left: 5px;
        }
        .table th {
            background-color: #f8f9fa;
            padding: 0;
            margin: 0;
        }
        .signature {
            text-align: center;
            width: 200px;
            margin-top: 50px;
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
    <div class="container" style="font-size:11px">
        <table class="table">
             <tr>
                <td style="text-align:center; font-weight:bold" colspan="6">LAPORAN SURVEYOR (LS)</td>
            </tr>
            <tr>
                <td style="border-right:none; width:60%; font-weight: bold; margin-right:50px" colspan="2">
                    A. KANTOR PENERBIT: {{$data['ls']->kantor_cabang}}
                </td>
                <td style="border-left:none; border-right:none; margin-left:10px" colspan="2">Nomor: {{$data['ls']->code_above}}</td>
                <td style="border-left:none;" colspan="2">Tanggal: {{date('d F Y', strtotime($data['ls']->created_at))}}</td>
            </tr>
            <tr>
                <td colspan="6"><b>B. PERNYATAAN EKSPORTIR</b></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="3">
                    EKSPORTIR (NPWP, Nama, Alamat)
                    <br>
                    {{$data['ls']->company_npwp}}
                    <br>
                    {{$data['ls']->company_name}}
                    <br>
                    {{$data['ls']->company_address}}
                </td>
                <td colspan="4">No.PPBE: {{$data['ls']->code}}, Tanggal:{{date('d F Y', strtotime($data['ls']->code_date))}}</td>
            </tr>
            <tr>
                <td colspan="4">PEMERIKSAAN AWAL: {{$data['ls']->kantor_cabang}} Tanggal: {{date('d F Y', strtotime($data['ls']->inspection_date))}}</td>
            </tr>
            <tr>
                <td colspan="4" >PEMERIKSAAN AKHIR: {{$data['ls']->inspection_address}} Tanggal: {{date('d F Y', strtotime($data['ls']->stuffin_date))}}.</td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2">
                    Nomor IB: {{$data['ls']->nib}}
                    <br>
                    Tanggal: {{date('d F Y', strtotime($data['ls']->date_nib))}}
                </td>
                <td colspan="4">
                    Nomor ET: {{$data['ls']->nomor_et}}
                    <br>
                    Tanggal ET: {{date('d F Y', strtotime($data['ls']->date_et))}}
                </td>
            </tr>
            <tr><td colspan="4">
                Nomor PE: {{$data['ls']->nomor_pe}}
                <br>
                Tanggal PE: {{date('d F Y', strtotime($data['ls']->date_pe))}}
            </td></tr>
            <tr>
                <td colspan="2" rowspan="2">
                    IMPORTIR (Nama dan Alamat)
                    <br>
                    {{$data['ls']->buyer_name}}
                    <br>
                    {{$data['ls']->buyer_address}}
                </td>
                <td colspan="4">
                    No.Packing:  {{$data['ls']->packing_list_number}}
                    <br>
                    Tgl.Packing: {{date('d F Y', strtotime($data['ls']->packing_list_date))}}
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    No.Invoice: {{$data['ls']->invoice_number}}
                    <br>
                    Tgl.Invoice: {{date('d F Y', strtotime($data['ls']->invoice_date))}}
                </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="4">
                    URAIAN BARANG:
                    <br>
                    @foreach ($data['ls']->goods as $index => $good)
                        {{$good->quantity_kg}} KG {{$good->description}} <br>
                    @endforeach
                </td>
                <td colspan="2">
                    Valuta: {{$data['ls']->fob_currency}}
                </td>
                <td colspan="2">
                    NILAI FOB: {{$data['ls']->fob_total}}
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    PELABUHAN TUJUAN: {{$data['ls']->nama_pelabuhan_tujuan}}
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    PELABUHAN MUAT: {{$data['ls']->nama_pelabuhan_muat}}
                </td>
            </tr>
            <tr>
                <td colspan="4">
                     PELABUHAN ASAL: {{$data['ls']->nama_pelabuhan_muat}} {{--nanti diganti jadi asal (origin) --}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <b>C. HASIL PEMERIKSAAN</b>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    JUMLAH DAN JENIS KEMASAN:
                    <br>
                    20 BUNTELAN
                </td>
                <td colspan="3">
                    MEREK DAN NOMOR KEMASAN:
                    <br>
                    -
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    NO. PETI KEMAS DAN SEGEL ATAU NO. TANDA PENGENAL SURVEYOR SERTA CARA PENGAPALAN
                </td>
            </tr>
            @foreach ($data['ls']->memorys as $index => $memory)
            <tr>
                    @php
                        if($memory->tps_merah != "" || $memory->tps_merah != null)
                        {
                            $tps_merah = json_decode($memory->tps_merah);
                        } else {
                            $tps_merah = "";
                        }

                        if ($memory->tps_hijau != "" || $memory->tps_hijau != null) {
                            $tps_hijau = json_decode($memory->tps_hijau);
                        } else {
                            $tps_hijau = "";
                        }

                        if (isset($memory->thread_seal)) {
                            $thread_seal = json_decode($memory->thread_seal);
                        } else {
                            $thread_seal = "";
                        }
                    @endphp

                <td style="border: none;text-align:center;" colspan="2">
                    {{$memory->create_number}}
                </td>
                <td style="border: none;text-align:center;" >
                    {{$memory->create_type}}
                </td>
                <td style="border: none;text-align:center;" colspan="2">
                    @if($tps_merah != "" || $tps_merah != null)
                        @foreach ($tps_merah as $index => $merah)
                            {{$merah->series}} {{$merah->red_init}} {{$merah->red_final}} <br>
                        @endforeach
                    @endif
                    @if($tps_hijau != "" || $tps_hijau != null)
                        @foreach ($tps_hijau as $index => $hijau)
                            {{$hijau->series}} {{$hijau->green_init}} {{$hijau->green_final}} <br>
                        @endforeach
                    @endif
                    @if($thread_seal != "" || $thread_seal != null)
                        @foreach ($thread_seal as $index => $seal)
                            {{$seal->series}} {{$seal->thread_seal_init}} {{$seal->thread_seal_final}} <br>
                        @endforeach
                    @endif
                </td>
                <td colspan="1" style="border: none;text-align:center;">
                    {{$memory->type}}
                </td>
            </tr>
            @endforeach
            <tr class="mt-2">
                <th style="text-align:center">NO</th>
                <th style="text-align:center">HS</th>
                <th style="text-align:center" colspan="2">URAIAN BARANG</th>
                <th style="text-align:center">SATUAN</th>
                <th style="text-align:center">JUMLAH</th>
            </tr>
            @foreach ($data['ls']->goods as $index => $good)
                <tr>
                    <td style="border: none; text-align:center;">{{$index+1}}</td>
                    <td style="border: none; text-align:center;">{{$good->processed_level_id}}</td>
                    <td style="border: none; text-align:center;" colspan="2">{{$good->description}}</td>
                    <td style="border: none; text-align:center;">KG</td>
                    <td style="border: none; text-align:center;">{{$good->quantity_kg}}</td>
                </tr>
            @endforeach
            <tr>
                <th style="text-align:center" rowspan="2">Parameter</th>
                <th style="text-align:center" rowspan="2">Satuan</th>
                <th style="text-align:center" rowspan="2">Hasil Uji</th>
                <th style="text-align:center" colspan="2">Persyaratan BPOM</th>
                <th style="text-align:center" rowspan="2">Metode</th>
            </tr>
            <tr>
                <th style="text-align:center; width:15%">Kratom Putih dan Hijau</th>
                <th style="text-align:center; ">Kratom Merah</th>
            </tr>
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
            <tr>
                <td colspan="6">
                    <b>CATATAN PEMERIKSAAN:</b>
                    <br>

                </td>
            </tr>
            <tr>
                <td colspan="6">
                    <b>KESIMPULAN PEMERIKSAAN:</b>
                    <br>
                    Dapat Diekspor sesuai dengan ketentuan peraturan menteri perdagangan RI No. 19 Tahun 2021
                </td>
            </tr>
            <tr>
                <td style="border-right:none; text-align:center; font-weight:bold; width:25%">
                    <i style="font-style: italic">
                        Certificate Of Analyst
                    </i> <br>
                    <img style="margin-right: 10px" src="{{asset('images/teskotak.jpg')}}" alt=""><br>
                </td>
                <td colspan="4" style="border-right:none; border-left:none;"></td>
                <td style="border-left:none;font-weight:bold; text-align:center;">
                    PT.SUCOFINDO <br>
                    <img style="margin-right: 10px" src="{{asset('images/teskotak.jpg')}}" alt=""><br>
                    {{$data['user']->first_name}} {{$data['user']->last_name}}
                </td>
            </tr>

        </table>
        <div style="text-align:center">
            {{$data['ls']->code_below}}
        </div>
    </div>
</body>
</html>
