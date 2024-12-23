@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Laporan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('TampilLaporan') }}">Laporan</a></li>
                        <li class="breadcrumb-item active">Tambah Laporan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Input Data Laporan</h3>
                        </div>
                        <div class="card-body">
                            <div style="align-content: center">
                                <form action="{{ route('BuatLaporan') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="tanggal_laporan">Tanggal Laporan</label>
                                        <input type="date" name="tanggal_laporan" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_mulai">Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal_akhir">Tanggal Akhir</label>
                                        <input type="date" name="tanggal_akhir" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('TampilLaporan') }}" class="btn btn-secondary">Batal</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
