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
                border: 1px solid #ddd;
            }
            .table th, .table td {
                padding: 10px;
                text-align: left;
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
        <h2 style="text-align: center!important">Daftar Penugasan Surveyor</h2>
        <p>Hari dan Tanggal: 17 Agustus 2024</p>
        <p style="margin-top:-15px">Wilayah: Bandung</p>

        <table class="table" style="font-size: 13px">
            <thead style="background:yellow">
                <tr>
                   <td rowspan="2">No.</td> 
                   <td rowspan="2">No. PPBE</td> 
                   <td rowspan="2">Nama Eksportir</td>
                   <td colspan="3">Barang Ekspor</td>
                   <td rowspan="2">Jenis Intervensi</td>
                   <td rowspan="2">Nama Surveyor/NPP</td>
                   <td colspan="3">Cara Pengapalan</td> 
                </tr>
                <tr>
                    <td>Jenis</td>
                    <td>JML & Satuan</td>
                    <td>JML & Jenis Kemasan</td>
                    <td>FCL</td>
                    <td>LCL</td>
                    <td>Conv</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
                <tr>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                    <td><br></td>
                </tr>
            </tbody>
        </table>
        <p style="font-size:12px">Catatan:</p>
        <p style="font-size:12px; margin-top:-10px">Jenis Intervensi Diisi dengan:</p>
        <p style="font-size:12px; margin-top:-10px">   1. Pengawasan Barang Ekspor</p>
        <p style="font-size:12px; margin-top:-10px">   2. Pengawasan Stuffing</p>
        <p style="font-size:12px; margin-top:-10px">   3. Pemeriksaan Barang Ekspor dan Pengawasan Stuffing</p>

        <div class="">
            <p style="font-size:15px">Disiapkan oleh Koord. Operasi:</p>
            <br><br><br>
            <div class="">(TESTING ORANG)</div>
            <div>NPP: 99.123.5123</div>
        </div>
    </body>
</html>