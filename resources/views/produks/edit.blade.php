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
            @method('PUT')
            <div class="mb-3">
                <label for="Nama_Produk" class="form-label">Nama Produk</label>
                <input type="text" name="Nama_Produk" class="form-control" id="Nama_Produk"
                    value="{{ $produk->Nama_Produk }}" required>
            </div>
            <div class="mb-3">
                <label for="Kategori" class="form-label">Kategori</label>
                <input type="text" name="Kategori" class="form-control" id="Kategori" value="{{ $produk->Kategori }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="Stok" class="form-label">Stok</label>
                <input type="text" name="Stok" class="form-control" id="Stok" value="{{ $produk->Stok }}"
                    required>
            </div>
            <div class="mb-3">
                <label for="Keterangan" class="form-label">Keterangan</label>
                <textarea name="Keterangan" class="form-control" id="Keterangan" rows="4" value="{{ $produk->Keterangan }}"
                    required>{{ $produk->Keterangan }}</textarea>
            </div>
            <div class="mb-3">
                <label for="Harga_Satuan" class="form-label">Harga Satuan</label>
                <input type="number" name="Harga_Satuan" class="form-control" id="Harga_Satuan"
                    value="{{ $produk->Harga_Satuan }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('produks.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
    a
@endsection
