@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Produk</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $produk)
            <tr>
                <td>{{ $produk->id }}</td>
                <td>{{ $produk->nama_produk }}</td>
                <td>{{ $produk->kategori }}</td>
                <td>Rp {{ number_format($produk->harga_satuan, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('products.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('products.destroy', $produk->id) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
