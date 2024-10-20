@extends('layouts.SideBar')

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

    <form action="{{ route('produks.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="Nama_Produk" class="form-label">Nama Produk</label>
            <input type="text" name="Nama_Produk" class="form-control" id="nama_produk" required>
        </div>
        <div class="mb-3">
            <label for="Kategori" class="form-label">Kategori</label>
            <input type="text" name="Kategori" class="form-control" id="kategori" required>
        </div>
        <div class="mb-3">
            <label for="Stok" class="form-label">Stok</label>
            <input type="text" name="Stok" class="form-control" id="Stok" required>
        </div>
        <div class="mb-3">
            <label for="Harga_Satuan" class="form-label">Harga Satuan</label>
            <input type="number" name="Harga_Satuan" class="form-control" id="harga_satuan" required>
        </div>

        <!-- Tambahkan field tambahan berikut -->
        <div class="mb-3">
            <label for="Tanggal_Masuk" class="form-label">Tanggal Masuk</label>
            <input type="date" name="Tanggal_Masuk" class="form-control" id="Tanggal_Masuk" required>
        </div>
        <div class="mb-3">
            <label for="Keterangan" class="form-label">Keterangan</label>
            <textarea name="Keterangan" class="form-control" id="keterangan" required></textarea>
        </div>
        <div class="mb-3">
            <label for="Id_Karyawan" class="form-label">ID Karyawan</label>
            <input type="number" name="Id_Karyawan" class="form-control" id="id_karyawan">
        </div>
        <!-- Field tambahan selesai -->

        <button type="submit" class="btn btn-primary">Tambah Produk</button>
    </form>
</div>
@endsection
