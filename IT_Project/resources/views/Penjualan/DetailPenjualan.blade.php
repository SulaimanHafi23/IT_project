@extends('layouts.SideBar')

@section('content')
    <div class="container mt-2">
        <h1 style="text-align: center">Detail Penjualan</h1>
        <hr>
        <div style="align-content: center">
            <h1 class="my-4">Detail Penjualan</h1>

            <div class="mb-3">
                <strong>ID Penjualan:</strong> {{ $penjualan->Id_Penjualan }}
            </div>
            <div class="mb-3">
                <strong>Kasir:</strong> {{ $penjualan->Id_Karyawan}}
            </div>
            <div class="mb-3">
                <strong>Total Harga:</strong> Rp{{ number_format($penjualan->Total_Harga, 0, ',', '.') }}
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
                        <td>{{ number_format($detail->Jumlah * $detail->Harga_Satuan, 2, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection