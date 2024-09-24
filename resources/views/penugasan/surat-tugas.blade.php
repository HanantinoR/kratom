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
        <h2>Surat Tugas</h2>
        <div class="container">
            <table style="width: 100%; font-size:14px; margin-top:-10px">
                <tr>
                    <td style="width: 20%;">Nomor PPBE</td>
                    <td style="width: 5%">:</td>
                    <td></td>
                </tr>
            </table>
            <h4>Pimpinan PT. SUCOFINDO (Persero) Memerintahkan Kepada:</h4>
            <table style="width: 100%; font-size:14px; margin-top:-15px">
                <tr>
                    <td style="width:2%">1.</td>
                    <td style="width:10%">Nama</td>
                    <td style="width:2%">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td style="width:2%">2.</td>
                    <td style="width:10%">NPP.</td>
                    <td style="width:2%">:</td>
                    <td></td>
                </tr>
            </table>
            <h4>Untuk Melakukan Pemeriksaan Diatas:</h4>
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
                    <td></td>
                    <td>[.................]</td>
                    <td>[........................]</td>
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
                    <td></td>
                    <td>[________]</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>  b. Pengawasan Stuffing</td>
                    <td>:</td>
                    <td></td>
                    <td>[________]</td>
                    <td></td>
                </tr>
            </table>
            <br>
            <table style="width: 100%; font-size:14px; margin-top:-15px">
                <tr>
                    <td style="width:2%">4.</td>
                    <td style="width:35%">Nama Eksportir</td>
                    <td style="width:2%">:</td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>PLACEHOLDERALAMAT</td>
                </tr>
                <br>
                <tr>
                    <td>5.</td>
                    <td>Tempat Pelaksanaan</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Rencana Berangkat</td>
                    <td>:</td>
                    <td></td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>Rencana Selesai</td>
                    <td>:</td>
                    <td></td>
                </tr>
            </table>
            <div class="signature">
                <p style="font-size:15px">Yang Memberi Tugas:</p>
                <br><br><br>
                <div class="">(Nama: TESTING ORANG)</div>
                <div>NPP: 99.123.5123</div>
            </div>
            <div class="container-twopart float-escape">
                <div class="left-section">
                    <p><strong>Name:</strong> John Doe</p>
                    <p><strong>Address:</strong> 1234 Street Name, City</p>
                    <p><strong>Date:</strong> August 29, 2024</p>
                </div>
            
                <div class="right-section">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Mulai</th>
                                <th>Selesai</th>
                                <th>Jumlah</th>
                                <th>Paraf</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>August 28, 2024</td>
                                <td>Task 1</td>
                                <td>Completed</td>
                                <td>Completed</td>
                                <td>Completed</td>
                            </tr>
                            <tr>
                                <td>August 29, 2024</td>
                                <td>Task 2</td>
                                <td>In Progress</td>
                                <td>In Progress</td>
                                <td>In Progress</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>