@extends('layouts.SideBar')

@section('content')
<div class="container">
    <h1>Detail Laporan</h1>
    <div class="card">
        <div class="card-header">
            Laporan ID: {{ $laporan->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">Tanggal Laporan: {{ $laporan->tanggal_laporan }}</h5>
            <p class="card-text">Tanggal Mulai: {{ $laporan->tanggal_mulai }}</p>
            <p class="card-text">Tanggal Akhir: {{ $laporan->tanggal_akhir }}</p>
            
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
                    @foreach($penjualan as $no => $item)
                        <tr>
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $item->Tanggal_Penjualan }}</td>
                            <td>{{ $item->Metode_Pembayaran }}</td>
                            <td>{{ $item->Total_Harga }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <a href="{{ route('TampilLaporan') }}" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
@endsection
