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
                                <div class="mb-1">
                                    <strong>ID Penjualan:</strong> {{ $penjualan->Id_Penjualan }}
                                </div>
                                <div class="mb-1">
                                    <strong>Kasir:</strong> {{ $penjualan->Id_Karyawan }}
                                </div>
                                <div class="mb-1">
                                    <strong>Total Harga:</strong>
                                    Rp{{ number_format($penjualan->Total_Harga, 0, ',', '.') }}
                                </div>
                                <div class="mb-1">
                                    <strong>Tanggal Penjualan:</strong> {{ $penjualan->Tanggal_Penjualan }}
                                </div>
                                <div class="mb-1">
                                    <strong>Metode Pembayaran:</strong> {{ $penjualan->Metode_Pembayaran }}
                                </div>
                                <h2 class="my-4">Detail barang</h2>

                                <div class="card">

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
                                <div class="text-center mt-2">
                                    <button id="pay-button" class="btn btn-primary">bayar</button>
                                </div>
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
          window.snap.pay('{{$snapToken}}', {
            onSuccess: function(result){
                /* SweetAlert untuk menampilkan sukses */
                Swal.fire({
                    title: 'Pembayaran Berhasil',
                    text: 'Pembayaran Anda telah berhasil diproses.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Redirect setelah pembayaran berhasil
                    window.location.href = "{{ route('TampilPenjualan') }}";
                });
                console.log(result);
            },
            onPending: function(result){
              /* SweetAlert untuk menampilkan status menunggu */
              Swal.fire({
                    title: 'Menunggu Pembayaran',
                    text: 'Pembayaran Anda sedang diproses. Silakan selesaikan pembayaran Anda.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                console.log(result);
            },
            onError: function(result){
              /* SweetAlert untuk menampilkan error */
              Swal.fire({
                    title: 'Pembayaran Gagal',
                    text: 'Terjadi kesalahan dalam proses pembayaran. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                console.log(result);
            },
            onClose: function(){
              /* SweetAlert untuk menampilkan jika pengguna menutup */
              Swal.fire({
                    title: 'Menutup Pembayaran',
                    text: 'Anda menutup tampilan pembayaran tanpa menyelesaikan transaksi.',
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }
          })
        });
      </script>
@endsection
