@extends('layouts.Sidebar')
@section('content')
    <div class="container mt-2">
        <h1 style="text-align: center">Halaman Pembayaran</h1>
        <hr>
        <div style="text-align: center">
            <h3>Scan QR Code untuk Melakukan Pembayaran</h3>
            <img src="{{ asset('path/to/your/qr-code.png') }}" alt="QR Code Pembayaran" style="width: 250px; height: 250px; margin: 20px 0;">
            
            <div>
                <a href="{{ route('succes') }}" class="btn btn-success">Selesai</a>
            </div>
        </div>
    </div>
@endsection
