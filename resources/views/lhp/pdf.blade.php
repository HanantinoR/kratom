<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LHP - {{$data['lhp']->code_above}}</title>
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
                <td style="text-align:center; font-weight:bold" colspan="10">LAPORAN SURVEYOR (LS)</td>
            </tr>
            <tr>
                <td colspan="3"style="border-right:none; font-weight: bold;">A. KANTOR PENERBIT: {{$data['lhp']->kantor_cabang}}</td>
                <td colspan="4" style="border-left:none; border-right:none; text-align:center;">Nomor: {{$data['lhp']->code_above}}</td>
                <td colspan="3" style="border-left:none; text-align:center;">Tanggal: {{date('d F Y', strtotime($data['lhp']->created_at))}}</td>
            </tr>
            <tr>
                <td colspan="10"><b>B. PERNYATAAN EKSPORTIR</b></td>
            </tr>
            <tr>
                <td colspan="4" rowspan="3">
                    EKSPORTIR (NPWP, Nama, Alamat)
                    <br>
                    {{$data['lhp']->company_npwp}}
                    <br>
                    {{$data['lhp']->company_name}}
                    <br>
                    {{$data['lhp']->company_address}}
                </td>
                <td colspan="6">No.PPBE: {{$data['lhp']->code}}, Tanggal:{{date('d F Y', strtotime($data['lhp']->code_date))}}</td>
            </tr>
            <tr>
                <td colspan="6">PEMERIKSAAN AWAL: {{$data['lhp']->kantor_cabang}} Tanggal: {{date('d F Y', strtotime($data['lhp']->inspection_date))}}</td>
            </tr>
            <tr>
                <td colspan="6" >PEMERIKSAAN AKHIR: {{$data['lhp']->inspection_address}} Tanggal: {{date('d F Y', strtotime($data['lhp']->stuffin_date))}}.</td>
            </tr>
            <tr>
                <td colspan="4" rowspan="2">
                    Nomor IB: {{$data['lhp']->nib}}
                    <br>
                    Tanggal: {{date('d F Y', strtotime($data['lhp']->date_nib))}}
                </td>
                <td colspan="6">
                    Nomor ET: {{$data['lhp']->nomor_et}}
                    <br>
                    Tanggal ET: {{date('d F Y', strtotime($data['lhp']->date_et))}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    Nomor PE: {{$data['lhp']->nomor_pe}}
                    <br>
                    Tanggal PE: {{date('d F Y', strtotime($data['lhp']->date_pe))}}
                </td>
            </tr>
            <tr>
                <td colspan="4" rowspan="2">
                    IMPORTIR (Nama dan Alamat)
                    <br>
                    {{$data['lhp']->buyer_name}}
                    <br>
                    {{$data['lhp']->buyer_address}}
                </td>
                <td colspan="6">
                    No.Packing:  {{$data['lhp']->packing_list_number}}
                    <br>
                    Tgl.Packing: {{date('d F Y', strtotime($data['lhp']->packing_list_date))}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    No.Invoice: {{$data['lhp']->invoice_number}}
                    <br>
                    Tgl.Invoice: {{date('d F Y', strtotime($data['lhp']->invoice_date))}}
                </td>
            </tr>
            <tr>
                <td colspan="4" rowspan="4">
                    URAIAN BARANG:
                    <br>
                    @foreach ($data['lhp']->goods as $index => $good)
                        {{$good->quantity_kg}} KG {{$good->description}} <br>
                    @endforeach
                </td>
                <td colspan="2">
                    Valuta: {{$data['lhp']->fob_currency}}
                </td>
                <td colspan="4">
                    NILAI FOB: {{$data['lhp']->fob_total}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    PELABUHAN TUJUAN: {{$data['lhp']->nama_pelabuhan_tujuan}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                    PELABUHAN MUAT: {{$data['lhp']->nama_pelabuhan_muat}}
                </td>
            </tr>
            <tr>
                <td colspan="6">
                     PELABUHAN ASAL: {{$data['lhp']->nama_pelabuhan_muat}} {{--nanti diganti jadi asal (origin) --}}
                </td>
            </tr>
            <tr>
                <td colspan="10">
                    <b>C. HASIL PEMERIKSAAN</b>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    JUMLAH DAN JENIS KEMASAN:
                    <br>
                    20 BUNTELAN
                </td>
                <td colspan="6">
                    MEREK DAN NOMOR KEMASAN:
                    <br>
                    -
                </td>
            </tr>
            <tr>
                <td colspan="10">
                    NO. PETI KEMAS DAN SEGEL ATAU NO. TANDA PENGENAL SURVEYOR SERTA CARA PENGAPALAN
                </td>
            </tr>
            @foreach ($data['lhp']->memorys as $index => $memory)
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
                <td style="border: none;text-align:center;" colspan="1">
                    {{$memory->create_type}}
                </td>
                <td style="border: none;text-align:center;" colspan="3">
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
                <td style="border: none;text-align:center;" colspan="4">
                    {{-- {{$memory->type}} --}}
                    @switch($memory->type)
                        @case(1)
                            FCL
                            @break
                        @case(2)
                            LCL
                            @break
                        @case(3)
                            LOCK SEAL
                            @break
                        @case(4)
                            THREAD SEAL
                            @break

                    @endswitch
                </td>
            </tr>
            @endforeach
            <tr class="mt-2">
                <th style="text-align:center" colspan="1">NO</th>
                <th style="text-align:center" colspan="3">HS</th>
                <th style="text-align:center" colspan="4">URAIAN BARANG</th>
                <th style="text-align:center" colspan="1">SATUAN</th>
                <th style="text-align:center" colspan="1">JUMLAH</th>
            </tr>
            @foreach ($data['lhp']->goods as $index => $good)
                <tr>
                    <td style="border: none; text-align:center;" colspan="1">{{$index+1}}</td>
                    <td style="border: none; text-align:center;" colspan="3">{{$good->hs->hs}}</td>
                    <td style="border: none; text-align:center;" colspan="4">{{$good->description}}</td>
                    <td style="border: none; text-align:center;" colspan="1">KG</td>
                    <td style="border: none; text-align:center;" colspan="1">{{$good->quantity_kg}}</td>
                </tr>
            @endforeach
            <tr>
                <th style="text-align:center" rowspan="2" colspan="1">Parameter</th>
                <th style="text-align:center" rowspan="2" colspan="1">Satuan</th>
                <th style="text-align:center" colspan="6">Hasil Uji</th>
                <th style="text-align:center; width:10px" colspan="2">Permendag No 23 Tahun 2023 &
                    No 21 Tahun 2024</th>
            </tr>
            <tr>
                <th style="text-align:center; " colspan="2">Kratom Merah</th>
                <th style="text-align:center; " colspan="2">Kratom Hijau</th>
                <th style="text-align:center; " colspan="2">Kratom Putih</th>
                <th style="text-align:center; " colspan="1">Kratom Putih &Hijau</th>
                <th style="text-align:center; " colspan="1">Kratom Merah</th>
            </tr>
            <tr>
                <td> - Mitragynine</td>
                <td style="text-align:center">%</td>
                <td style="text-align:center"colspan="2"></td>
                <td style="text-align:center"colspan="2"></td>
                <td style="text-align:center"colspan="2"></td>
                <td style="text-align:center"colspan="1"> &ge; 1.2</td>
                <td style="text-align:center"colspan="1"> &ge; 0.8</td>
            </tr>
            {{-- <tr>
                <td> - Timbal (Pb)</td>
                <td style="text-align:center">mg/kg</td>
                <td style="text-align:center"></td>
                <td style="text-align:center">&le; 10</td>
                <td style="text-align:center">&le; 10</td>
            </tr>
            <tr>
                <td> - Kadmium (Cd)</td>
                <td style="text-align:center">mg/kg</td>
                <td style="text-align:center"></td>
                <td style="text-align:center">&le; 0.3</td>
                <td style="text-align:center">&le; 0.3</td>
            </tr>
            <tr>
                <td colspan="2"> - Arsen (As)</td>
                <td style="text-align:center">mg/kg</td>
                <td style="text-align:center"></td>
                <td style="text-align:center">&le; 5</td>
                <td style="text-align:center">&le; 5</td>
            </tr>
            <tr>
                <td> - Merkuri (Hg)</td>
                <td style="text-align:center">mg/kg</td>
                <td style="text-align:center"></td>
                <td style="text-align:center">&le; 0.5</td>
                <td style="text-align:center">&le; 0.5</td>
            </tr>
            <tr>
                <td> - Kadar Air</td>
                <td style="text-align:center">%</td>
                <td style="text-align:center"></td>
                <td style="text-align:center">&le; 10</td>
                <td style="text-align:center">&le; 10</td>
            </tr>
            <tr>
                <td style="font-style: italic;"> - Ukuran Partikel</td>
                <td style="text-align:center">μm</td>
                <td style="text-align:center"></td>
                <td style="text-align:center">&le; 600</td>
                <td style="text-align:center">&le; 600</td>
            </tr>
            <tr>
                <td style="text-align:center">Mikrobiologi:</td>
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
            </tr>
            <tr>
                <td style="font-style: italic;"> - Salmonella sp</td>
                <td style="text-align:center">Koloni/25g</td>
                <td style="text-align:center"></td>
                <td style="text-align:center">Negatif/g</td>
                <td style="text-align:center">Negatif/g</td>
            </tr> --}}
            <tr>
                <td colspan="10">
                    <b>CATATAN PEMERIKSAAN:</b>
                    <br>

                </td>
            </tr>
            <tr>
                <td colspan="10">
                    <b>KESIMPULAN PEMERIKSAAN:</b>
                    <br>
                    Tidak Dapat Diekspor sesuai dengan ketentuan peraturan menteri perdagangan RI No. 23 Tahun 2023 & No. 21 Tahun 2024
                </td>
            </tr>
            <tr>
                {{-- <td style="border-right:none; text-align:center; font-weight:bold; width:25%">
                    <i style="font-style: italic">
                        Certificate Of Analyst
                    </i> <br>
                    <img style="margin-right: 10px" src="{{asset('images/teskotak.jpg')}}" alt=""><br>
                </td> --}}
                <td colspan="6" style="border-right:none; border-left:none;"></td>
                <td style="border-left:none;font-weight:bold; text-align:center; margin-bottom: -5px" colspan="4">
                    PT.SUCOFINDO
                    {{-- <br><img src="{{$data['qr_code']}}" height="50px" width="50px" alt=""> --}}
                    {{-- <img style="margin-right: 10px" src="{{asset('images/teskotak.jpg')}}" alt=""><br> --}}
                    <br>{{$data['user']->first_name}} {{$data['user']->last_name}}
                </td>
            </tr>

        </table>
        <div style="text-align:center">
            {{$data['lhp']->code_below}}
        </div>
    </div>
</body>
</html>
