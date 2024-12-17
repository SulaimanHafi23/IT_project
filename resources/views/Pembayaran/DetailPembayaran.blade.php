@extends('layouts.Sidebar')
@section('content')
    <div class="container mt-2">
        <h1 class="text-center mb-4">Detail Pembayaran Penjualan #{{ $penjualan->Id_Penjualan }}</h1>
        <hr>

        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4>Detail Penjualan</h4>
            </div>
            <div class="card-body">
                <p><strong>ID Penjualan:</strong> {{ $penjualan->Id_Penjualan }}</p>
                <p><strong>Tanggal Penjualan:</strong> {{ $penjualan->Tanggal_Penjualan }}</p>
                <p><strong>Total:</strong> Rp {{ number_format($penjualan->Total_Harga, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Detail Pembayaran</h4>
            </div>
            <div class="card-body">
                @if($penjualan->pembayaran)
                    <p><strong>ID Pembayaran:</strong> {{ $penjualan->pembayaran->Id_Pembayaran }}</p>
                    <p><strong>Tanggal Pembayaran:</strong> {{ $penjualan->pembayaran->tanggal }}</p>
                    <p><strong>Jumlah Dibayar:</strong> Rp {{ number_format($penjualan->pembayaran->Total_Harga, 0, ',', '.') }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge badge-pill {{ $penjualan->pembayaran->status == 'sukses' ? 'badge-success' : 'badge-danger' }}">
                            {{ ucfirst($penjualan->pembayaran->status) }}
                        </span>
                    </p>
                @else
                    <p>Pembayaran belum dilakukan untuk penjualan ini.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
