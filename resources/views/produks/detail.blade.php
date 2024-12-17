@extends('layouts.SideBar')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Detail Produk</h1>
        <hr>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="card-title">Informasi Produk</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>ID Produk:</strong> {{ $produk->Id_Produk }}</li>
                            <li class="list-group-item"><strong>Nama Produk:</strong> {{ $produk->Nama_Produk }}</li>
                            <li class="list-group-item"><strong>Kategori:</strong> {{ $produk->Kategori }}</li>
                            <li class="list-group-item"><strong>Harga Satuan:</strong> Rp
                                {{ number_format($produk->Harga_Satuan, 2, ',', '.') }}</li>
                            <li class="list-group-item"><strong>Stok:</strong> {{ $produk->Stok }}</li>
                            <li class="list-group-item"><strong>Tanggal Masuk:</strong>
                                {{ \Carbon\Carbon::parse($produk->Tanggal_Masuk)->format('d-m-Y') }}</li>
                            <li class="list-group-item"><strong>Keterangan:</strong>
                                {{ $produk->Keterangan ?? 'Tidak ada keterangan' }}</li>
                            <li class="list-group-item"><strong>Ditambahkan oleh (ID Karyawan):</strong>
                                {{ $produk->Id_Karyawan }}</li>
                        </ul>
                    </div>
                </div>
                <a href="{{ route('produks.edit', $produk->Id_Produk) }}" class="btn btn-warning mt-3">Edit Produk</a>
                <a href="{{ route('produks.index') }}" class="btn btn-secondary mt-3">Kembali</a>
            </div>
        </div>
    </div>
@endsection
