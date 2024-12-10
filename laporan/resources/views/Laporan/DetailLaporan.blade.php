@extends('layouts.konten')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body print-area">
                            <!-- Header Apotek -->
                            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                <div>
                                    <h2>Laporan Penjualan</h2>
                                </div>
                                <div style="text-align: right;">
                                    <p><strong>Nama Apotek:</strong> Apotek Hafidzah</p>
                                    <p><strong>Lokasi:</strong> Jl. A. Syairani RT. 009 Kel. Sarang Halang</p>
                                    <p><strong>Kontak:</strong> +62 821 5498 5400</p>
                                </div>
                            </div>

                            <!-- Detail Laporan -->
                            <h3>Tanggal Laporan: {{ $laporan->tanggal_laporan }}</h3>
                            <p>Tanggal Mulai: {{ $laporan->tanggal_mulai }}</p>
                            <p>Tanggal Akhir: {{ $laporan->tanggal_akhir }}</p>

                            <!-- Tabel Penjualan -->
                            <h3>Daftar Penjualan</h3>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penjualan as $no => $item)
                                        <tr>
                                            <td>{{ $no + 1 }}</td>
                                            <td>{{ $item->Tanggal_Penjualan }}</td>
                                            <td>{{ $item->Metode_Pembayaran }}</td>
                                            <td>{{ $item->Total_Harga }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Tombol Cetak -->
                        <div style="text-align: left; margin-top: 30px; padding-left: 20px; margin-bottom: 20px;">
                            <a href="{{ route('TampilLaporan') }}" class="btn btn-primary" style="margin-right: 10px;">Kembali</a>
                            <a href="javascript:void(0)" onclick="printReport()" class="btn btn-success">Cetak Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printReport() {
            const printContents = document.querySelector('.print-area').innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>

    <style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            .btn, .breadcrumb, .pagination {
                display: none !important;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid black;
            }

            th, td {
                padding: 8px;
                text-align: left;
            }

            .card-body {
                font-family: Arial, sans-serif;
                font-size: 12px;
            }

            /* Header apotek */
            h2 {
                margin: 0;
                padding: 0;
            }

            p {
                margin: 0;
                font-size: 12px;
            }
        }

        /* Styling tombol */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
        }

        .btn-success {
            background-color: #28a745; /* Warna hijau seperti tombol pada foto */
            color: white;
            border: none;
        }
    </style>
@endsection
