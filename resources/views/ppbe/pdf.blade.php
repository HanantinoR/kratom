<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['title']}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .no-border {
            border: none;
        }
        .full-width {
            width: 100%;
        }
        .center {
            text-align: center;
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Sample Table with Merged Columns</h2>
    <table class="full-width">
        <tr>
            <td class="no-border" rowspan="2">NAMA PELANGGAN:</td>
            <td class="no-border">PT. X</td>
        </tr>
        <tr>
            <td class="no-border">Alamat X</td>
        </tr>
        <tr>
            <td class="no-border">JENIS CONTOH:</td>
            <td class="no-border">KRATOM</td>
        </tr>
        <tr>
            <td class="no-border">TANGGAL DITERIMA:</td>
            <td class="no-border">…………. 2024</td>
        </tr>
        <tr>
            <td class="no-border">TANGGAL ANALISA:</td>
            <td class="no-border">……….. – …… September 2024</td>
        </tr>
        <tr>
            <td class="no-border">ANALISA / UJI:</td>
            <td class="no-border">Mitragynine, Logam Berat, Kadar Air, Aflatoxin, dan Mikrobiologi</td>
        </tr>
        <tr>
            <td class="no-border">KETERANGAN CONTOH:</td>
            <td class="no-border">
                Bentuk: ………. <br>
                Kemasan: Original <br>
                Jumlah:
            </td>
        </tr>
        <tr>
            <td class="no-border">IDENTIFIKASI CONTOH:</td>
            <td class="no-border">No. Bets: ……..</td>
        </tr>
        <tr>
            <td class="no-border">REFERENSI:</td>
            <td class="no-border">-</td>
        </tr>
    </table>
    <table class="full-width">
        <thead>
            <tr>
                <th rowspan="2">Parameter</th>
                <th rowspan="2">Satuan</th>
                <th rowspan="2">Hasil Uji</th>
                <th colspan="2">Persyaratan BPOM</th>
                <th rowspan="2">Metode</th>
            </tr>
            <tr>
                <th>Kratom Putih dan Hijau</th>
                <th>Kratom Merah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bold">- Mitragynine</td>
                <td>%</td>
                <td class="center">[Value]</td>
                <td class="center">≥ 1.2</td>
                <td class="center">≥ 0.8</td>
                <td>[Method]</td>
            </tr>
            <tr>
                <td class="bold">- Timbal (Pb)</td>
                <td>mg/kg</td>
                <td class="center">[Value]</td>
                <td class="center">≤ 10</td>
                <td class="center">≤ 10</td>
                <td>[Method]</td>
            </tr>
            <tr>
                <td class="bold">- Kadmium (Cd)</td>
                <td>mg/kg</td>
                <td class="center">[Value]</td>
                <td class="center">≤ 0.3</td>
                <td class="center">≤ 0.3</td>
                <td>[Method]</td>
            </tr>
            <tr>
                <td class="bold">- Arsen (As)</td>
                <td>mg/kg</td>
                <td class="center">[Value]</td>
                <td class="center">≤ 5</td>
                <td class="center">≤ 5</td>
                <td>[Method]</td>
            </tr>
            <tr>
                <td class="bold">- Merkuri (Hg)</td>
                <td>mg/kg</td>
                <td class="center">[Value]</td>
                <td class="center">≤ 0.5</td>
                <td class="center">≤ 0.5</td>
                <td>[Method]</td>
            </tr>
            <tr>
                <td class="bold">- Kadar Air</td>
                <td>%</td>
                <td class="center">[Value]</td>
                <td class="center">≤ 10</td>
                <td class="center">≤ 10</td>
                <td>[Method]</td>
            </tr>
            <tr>
                <td colspan="7" class="bold">Mikrobiologi:</td>
            </tr>
            <tr>
                <td class="bold">- Escherichia coli</td>
                <td>APM/g</td>
                <td class="center">[Value]</td>
                <td class="center">≤ 10</td>
                <td class="center">≤ 10</td>
                <td>[Method]</td>
            </tr>
            <tr>
                <td class="bold">- Salmonella sp</td>
                <td>Koloni/25g</td>
                <td class="center">[Value]</td>
                <td class="center">Negatif/g</td>
                <td class="center">Negatif/g</td>
                <td>[Method]</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
