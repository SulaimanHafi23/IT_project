@extends('layouts.konten')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Data Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('produks.index') }}">Produk</a></li>
                        <li class="breadcrumb-item active">Ubah Produk</li>
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
                            <h3 class="card-title">Form Ubah Data Produk</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('produks.update', $produk->Id_Produk) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="Nama_Produk" class="form-label">Nama Produk</label>
                                    <input type="text" name="Nama_Produk" class="form-control @error('Nama_Produk') is-invalid @enderror" id="Nama_Produk"
                                        value="{{ old('Nama_Produk', $produk->Nama_Produk) }}" required>
                                    @error('Nama_Produk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Kategori" class="form-label">Kategori</label>
                                    <input type="text" name="Kategori" class="form-control @error('Kategori') is-invalid @enderror" id="Kategori"
                                        value="{{ old('Kategori', $produk->Kategori) }}" required>
                                    @error('Kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Stok" class="form-label">Stok</label>
                                    <input type="number" name="Stok" class="form-control @error('Stok') is-invalid @enderror" id="Stok"
                                        value="{{ old('Stok', $produk->Stok) }}" required>
                                    @error('Stok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Keterangan" class="form-label">Keterangan</label>
                                    <textarea name="Keterangan" class="form-control @error('Keterangan') is-invalid @enderror" id="Keterangan" rows="4"
                                        required>{{ old('Keterangan', $produk->Keterangan) }}</textarea>
                                    @error('Keterangan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="Harga_Satuan" class="form-label">Harga Satuan</label>
                                    <input type="number" name="Harga_Satuan" class="form-control @error('Harga_Satuan') is-invalid @enderror" id="Harga_Satuan"
                                        value="{{ old('Harga_Satuan', $produk->Harga_Satuan) }}" required>
                                    @error('Harga_Satuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                <a href="{{ route('produks.index') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
