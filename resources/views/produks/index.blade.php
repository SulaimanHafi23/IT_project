@extends('layouts.SideBar')
@section('content')
    <div class="container mt-2">
        <h1 style="text-align: center">Halaman Produk</h1>
        <hr>
        <a href="{{ route('produks.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-square-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
                @foreach ($produk as $no => $produk)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $produk->Nama_Produk }}</td>
                        <td>{{ $produk->Kategori }}</td>
                        <td>{{ $produk->Stok }}</td>
                        <td>Rp {{ number_format($produk->Harga_Satuan, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('produks.detail', $produk->Id_Produk) }}"
                                class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('produks.edit', $produk->Id_Produk) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('produks.destroy', $produk->Id_Produk) }}" method="POST"
                                class="d-inline">
                                <form action="{{ route('produks.destroy', $produk->Id_Produk) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                                </form>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
