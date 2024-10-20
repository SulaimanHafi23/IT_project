@extends('layouts.SideBar')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Edit Produk</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('produks.update', $produk->Id_Produk) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="Nama_Produk" class="form-control" id="nama_produk" value="{{ $produk->Nama_Produk }}" required>
        </div>
        <div class="mb-3">
            <label for="kategori" class="form-label">Kategori</label>
            <input type="text" name="Kategori" class="form-control" id="kategori" value="{{ $produk->Kategori }}" required>
        </div>
        <div class="mb-3">
            <label for="Stok" class="form-label">Stok</label>
            <input type="text" name="Stok" class="form-control" id="kategori" value="{{ $produk->Stok }}" required>
        </div>
        <div class="mb-3">
            <label for="Keterangan" class="form-label">Keterangan</label>
            <input type="text" name="Keterangan" class="form-control" id="Keterangan" value="{{ $produk->Keterangan }}">
        </div>  
        <div class="mb-3">
            <label for="harga_satuan" class="form-label">Harga Satuan</label>
            <input type="number" name="Harga_Satuan" class="form-control" id="harga_satuan" value="{{ $produk->Harga_Satuan }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection
