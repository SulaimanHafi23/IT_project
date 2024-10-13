@extends('layouts.SideBar')

@section('content')
    <div class="container mt-5">
        <h1 style="text-align: center">Detail Penjualan</h1>
        <hr>
        <div style="align-content: center">
            <h1 class="my-4">Detail Penjualan</h1>

            <div class="mb-3">
                <strong>ID Penjualan:</strong> {{ $penjualan->Id_Penjualan }}
            </div>
            <div class="mb-3">
                <strong>Total Harga:</strong> {{ number_format($penjualan->Total_Harga, 0, ',', '.') }}
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
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <td>{{ $detail->Id_Produk }}</td>
                            <td>{{ number_format($detail->Harga_Satuan, 0, ',', '.') }}</td>
                            <td>{{ $detail->Jumlah }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
