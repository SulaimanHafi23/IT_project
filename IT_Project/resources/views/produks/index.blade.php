@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Produk</h3>
                            <div class="card-tools">
                                <a href="{{ route('produks.create') }}">
                                    <button type="button" class="btn btn btn-primary">Tambah Produk</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
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
                                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('produks.destroy', $produk->Id_Produk) }}"
                                                    method="POST" class="d-inline">
                                                    <form action="{{ route('produks.destroy', $produk->Id_Produk) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="hapus(this)" class="btn btn-danger btn-sm"><i
                                                                class="fas fa-trash"></i></button>
                                                    </form>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Harga Satuan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
