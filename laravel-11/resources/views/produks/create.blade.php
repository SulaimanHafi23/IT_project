@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Tambah Produk</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" id="nama_produk" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" id="kategori" required>
        </div>
        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga Satuan</label>
            <input type="number" name="harga_satuan" class="form-control" id="harga_satuan" required>
        </div>

        <!-- Tambahkan field tambahan berikut -->
        <div class="mb-3">
            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control" id="tanggal_masuk" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control" id="keterangan" required></textarea>
        </div>
        <div class="mb-3">
            <label for="id_karyawan" class="form-label">ID Karyawan</label>
            <input type="number" name="id_karyawan" class="form-control" id="id_karyawan">
        </div>
        <!-- Field tambahan selesai -->

        <button type="submit" class="btn btn-primary">Tambah Produk</button>
    </form>
</div>
@endsection
