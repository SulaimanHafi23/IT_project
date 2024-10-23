@extends('layouts.Sidebar')
@section('content')
    <div class="container mt-5">
        <h1 style="text-align: center">Halaman Pembayaran</h1>
        <hr>
        <div style="text-align: center">
            <!-- Display QR Code -->
            <h3>Scan QR Code untuk Melakukan Pembayaran</h3>
            <img src="{{ asset('path/to/your/qr-code.png') }}" alt="QR Code Pembayaran" style="width: 250px; height: 250px; margin: 20px 0;">
            
            <!-- Buttons for navigation -->
            <div>
                <a href="{{ route('TampilPenjualan') }}" class="btn btn-success">Selesai</a>
            </div>
        </div>

        <!-- Optional success message after transaction -->
        
    </div>
@endsection
