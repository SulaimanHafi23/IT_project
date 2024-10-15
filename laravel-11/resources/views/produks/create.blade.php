@extends('layout')

@section('content')
    <h1>Tambah Produk</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" required>
        
        <label for="kategori">Kategori:</label>
        <input type="text" name="kategori" required>
        
        <label for="tanggal_masuk">Tanggal Masuk:</label>
        <input type="date" name="tanggal_masuk" required>
        
        <label for="keterangan">Keterangan:</label>
        <input type="text" name="keterangan" required>
        
        <label for="harga_satuan">Harga Satuan:</label>
        <input type="number" name="harga_satuan" step="0.01" required>
        
        <label for="id_karyawan">ID Karyawan:</label>
        <input type="number" name="id_karyawan" required>

        <button type="submit">Simpan</button>
    </form>
@endsection
