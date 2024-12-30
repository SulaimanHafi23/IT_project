@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Penjualan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Penjualan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Penjualan</h3>
                            <div class="card-tools">
                                <a href="{{ route('TambahPenjualan') }}">
                                    <button type="button" class="btn btn btn-primary">Tambah Penjualan</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Penjualan</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Aksi</th>
                                        <th>Lihat Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($penjualan as $pjln)
                                        <tr>
                                            <td>{{ $pjln->Id_Penjualan }}</td>
                                            <td>Rp {{ number_format($pjln->Total_Harga, 0, ',', '.') }}</td>
                                            <td>{{ $pjln->Tanggal_Penjualan }}</td>
                                            <td>{{ $pjln->Metode_Pembayaran }}</td>
                                            <td>
                                                <a href="{{ route('DetailPenjualan', $pjln->Id_Penjualan) }}"
                                                    class="btn btn-info btn-sm">Detail</a>
                                                <form action="{{ route('DeletePenjualan', $pjln->Id_Penjualan) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="hapus(this)" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                            <td>
                                                @if ($pjln->Metode_Pembayaran === 'Transfer')
                                                    <a href="{{ route('DetailPembayaran', $pjln->Id_Penjualan) }}"
                                                        class="btn btn-success">
                                                        <i class="bi bi-info-circle"></i> Lihat Pembayaran
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Total Harga</th>
                                        <th>Tanggal Penjualan</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Aksi</th>
                                        <th>Lihat Pembayaran</th>
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
