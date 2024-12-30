
@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Data Pembayaran</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('TampilPenjualan') }}">Penjualan</a></li>
                        <li class="breadcrumb-item active">Detail Pembayaran</li>
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
                            <h3 class="card-title">Detail Pembayaran Penjualan #{{ $penjualan->Id_Penjualan }}</h3>
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

                                <h2 class="my-4">Detail Pembayaran</h2>
                                
                                @if($penjualan->pembayaran)
                                <div class="mb-3">
                                    <p><strong>ID Pembayaran:</strong> {{ $penjualan->pembayaran->Id_Pembayaran }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Tanggal Pembayaran:</strong> {{ $penjualan->pembayaran->Tanggal_Pembayaran }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Jumlah Dibayar:</strong> Rp {{ number_format($penjualan->pembayaran->Total_Pembayaran, 0, ',', '.') }}</p>
                                </div>
                                <div class="mb-3">
                                    <p><strong>Status:</strong> 
                                        <span class="badge badge-pill {{ $penjualan->pembayaran->Status_Pembayaran == 'Terbayar' ? 'badge-success' : 'badge-danger' }}">
                                            {{ ucfirst($penjualan->pembayaran->Status_Pembayaran) }}
                                        </span>
                                        @if ($penjualan->pembayaran->Status_Pembayaran === 'Terbuat')
                                        <div class="text-center mt-2">
                                            <button id="pay-button" class="btn btn-primary">Lanjutkan Pembayaran</button>
                                        </div>
                                            
                                        @endif
                                    </p>
                                </div>   
                                @else
                                    <p>Pembayaran belum dilakukan untuk penjualan ini.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('{{$penjualan->pembayaran->Referensi_Pembayaran}}', {
            onSuccess: function(result){
              /* You may add your own implementation here */
              alert("Pembayaran Berhasil!"); console.log(result);
            },
            onPending: function(result){
              /* You may add your own implementation here */
              alert("Menunggu Pembayaran anda!"); console.log(result);
            },
            onError: function(result){
              /* You may add your own implementation here */
              alert("Pembayaran Gagal"); console.log(result);
            },
            onClose: function(){
              /* You may add your own implementation here */
              alert('Kamu Menutup Tampilan Pembayaran Tanpa Melakukan Pembayaran');
            }
          })
        });
      </script>
@endsection 