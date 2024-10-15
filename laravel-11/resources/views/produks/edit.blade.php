@extends('layout')

@section('content')
    <h1>Edit Produk</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id_produk) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" value="{{ $product->nama_produk }}" required>
        
        <label for="kategori">Kategori:</label>
        <input type="text" name="kategori" value="{{ $product->kategori }}" required>
        
        <label for="tanggal_masuk">Tanggal Masuk:</label>
        <input type="date" name="tanggal_masuk" value="{{ $product->tanggal_masuk }}" required>
        
        <label for="keterangan">Keterangan:</label>
        <input type="text" name="keterangan" value="{{ $product->keterangan }}" required>
        
        <label for="harga_satuan">Harga Satuan:</label>
        <input type="number" name="harga_satuan" step="0.01" value="{{ $product->harga_satuan }}" required>
        
        <label for="id_karyawan">ID Karyawan:</label>
        <input type="number" name="id_karyawan" value="{{ $product->id_karyawan }}" required>

        <button type="submit">Update</button>
    </form>
@endsection
