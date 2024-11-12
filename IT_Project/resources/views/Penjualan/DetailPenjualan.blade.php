@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Data Penjualan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('TampilPenjualan') }}">Penjualan</a></li>
                        <li class="breadcrumb-item active">Detail Penjualan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Penjualan</h3>
                        </div>
                        <div class="card-body">
                            <div style="align-content: center">
                                <div class="mb-3">
                                    <strong>ID Penjualan:</strong> {{ $penjualan->Id_Penjualan }}
                                </div>
                                <div class="mb-3">
                                    <strong>Kasir:</strong> {{ $penjualan->Id_Karyawan }}
                                </div>
                                <div class="mb-3">
                                    <strong>Total Harga:</strong>
                                    Rp{{ number_format($penjualan->Total_Harga, 0, ',', '.') }}
                                </div>
                                <div class="mb-3">
                                    <strong>Tanggal Penjualan:</strong> {{ $penjualan->Tanggal_Penjualan }}
                                </div>
                                <div class="mb-3">
                                    <strong>Metode Pembayaran:</strong> {{ $penjualan->Metode_Pembayaran }}
                                </div>

                                <h2 class="my-4">Barang yang Dibeli</h2>

                                <table class="table table-bordered table-striped">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga Satuan</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail_penjualan as $index => $detail)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $detail->Nama_Produk }}</td>
                                                <td>{{ $detail->Jumlah }}</td>
                                                <td>{{ number_format($detail->Harga_Satuan, 2, ',', '.') }}</td>
                                                <td>{{ number_format($detail->Jumlah * $detail->Harga_Satuan, 2, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <th>ID Produk</th>
                                            <th>Nama Produk</th>
                                            <th>Jumlah</th>
                                            <th>Harga Satuan</th>
                                            <th>Total</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
