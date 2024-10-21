@extends('layouts.SideBar')
@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Daftar Produk</h2>
    <a href="{{ route('produks.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

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
                <th>Stok</th>
                <th>Harga Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $no =>$produk)
            <tr>
                <td>{{ $no + 1  }}</td>
                <td>{{ $produk->Nama_Produk }}</td>
                <td>{{ $produk->Kategori }}</td>
                <td>{{ $produk->Stok }}</td>
                <td>Rp {{ number_format($produk->Harga_Satuan, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('produks.edit', $produk->Id_Produk) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('produks.destroy', $produk->Id_Produk) }}" method="POST" class="d-inline">
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
