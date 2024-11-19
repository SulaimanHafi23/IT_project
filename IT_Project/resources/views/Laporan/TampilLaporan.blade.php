@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Laporan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Laporan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-square-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Laporan</h3>
                            <div class="card-tools">
                                <!-- Tombol Tambah Laporan -->
                                <a href="{{ route('TambahLaporan') }}">
                                    <button type="button" class="btn btn-primary">Tambah Laporan</button>
                                </a>
                                
                                <!-- Tombol Cetak Laporan -->
                                <a href="{{ route('laporan.cetak') }}" target="_blank">
                                    <button type="button" class="btn btn-secondary">Cetak Laporan</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporan as $item)
                                        <tr>
                                            <td>{{ $item->Id_Laporan }}</td>
                                            <td>{{ $item->tanggal_laporan }}</td>
                                            <td>{{ $item->tanggal_mulai }}</td>
                                            <td>{{ $item->tanggal_akhir }}</td>
                                            <td>
                                                <a href="{{ route('DetailLaporan', $item->Id_Laporan) }}"
                                                    class="btn btn-info">Detail</a>
                                                <a href="{{ route('EditLaporan', $item->Id_Laporan) }}"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('DeleteLaporan', $item->Id_Laporan) }}"
                                                    method="POST" style="display:inline;"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Akhir</th>
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
