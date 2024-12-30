@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Data Laporan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('TampilLaporan') }}">Laporan</a></li>
                        <li class="breadcrumb-item active">Detail Laporan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="padding:6px 20px;">
                            <h3 class="card-title">Detail Laporan ID: {{ $laporan->Id_Laporan }}</h3>
                            <div class="card-tools" >
                                <!-- Tombol Cetak Laporan -->
                                <a href="{{ route('laporan.cetak', $laporan->Id_Laporan) }}" target="_blank">
                                    <button type="button" class="btn btn-secondary" style="margin: 0px">Cetak Laporan</button>
                                </a>
                            </div>

                        </div>
                        <div class="card-body">
                            <strong>
                                <h2 class="card-title"><Strong>Tanggal Laporan :</Strong> {{ $laporan->tanggal_laporan }}</h2>
                            </strong>
                            <br><br>
                            <p class="card-text">Tanggal Mulai : {{ $laporan->tanggal_mulai }}</p>
                            <p class="card-text">Tanggal Akhir : {{ $laporan->tanggal_akhir }}</p>

                            <h3><strong>Daftar Penjualan</strong></h3>
                            <hr>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped">
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
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <a href="{{ route('TampilLaporan') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
