@extends('layouts.konten')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('produks.index') }}">Produk</a></li>
                        <li class="breadcrumb-item active">Tambah Produk</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Input Data Produk</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('produks.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <!-- Kolom pertama -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Nama_Produk" class="form-label">Nama Produk</label>
                                            <input type="text" name="Nama_Produk" class="form-control" id="nama_produk"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Kategori" class="form-label">Kategori</label>
                                            <input type="text" name="Kategori" class="form-control" id="kategori"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Stok" class="form-label">Stok</label>
                                            <input type="number" name="Stok" class="form-control" id="Stok"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Harga_Satuan" class="form-label">Harga Satuan</label>
                                            <input type="number" name="Harga_Satuan" class="form-control" id="harga_satuan"
                                                required>
                                        </div>
                                    </div>

                                    <!-- Kolom kedua -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Tanggal_Masuk" class="form-label">Tanggal Masuk</label>
                                            <input type="date" name="Tanggal_Masuk" class="form-control"
                                                id="Tanggal_Masuk" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Keterangan" class="form-label">Keterangan</label>
                                            <textarea name="Keterangan" class="form-control" id="Keterangan" rows="4" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Id_Karyawan" class="form-label">Karyawan</label>
                                            <select class="form-select" id="Id_Karyawan" name="Id_Karyawan" required>
                                                <option value="" disabled selected>Pilih Karyawan</option>
                                                @foreach ($karyawan as $pegawai)
                                                    <option value="{{ $pegawai->Id_Karyawan }}">
                                                        {{ $pegawai->Nama_Karyawan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-left">
                                        <button type="submit" class="btn btn-primary">Tambah Produk</button>
                                        <a href="{{ route('produks.index') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
