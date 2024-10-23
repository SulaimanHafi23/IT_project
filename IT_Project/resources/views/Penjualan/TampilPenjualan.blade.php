@extends('layouts.Sidebar')
@section('content')
    <div class="container mt-5">
        <h1 style="text-align: center">Halaman Penjualan</h1>
        <hr>
        <div style="align-content: center">
            <a href="{{ route('TambahPenjualan') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>

            <table class="table table-bordered table-striped">
                <thead class="table-light">
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
                        @if ($penjualan->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada penjualan yang ditemukan</td>
                            </tr>
                        @else
                            @foreach ($penjualan as $pjln)
                                <tr>
                                    <td>{{ $pjln->Id_Penjualan }}</td>
                                    <td>{{ $pjln->Tanggal_Penjualan }}</td>
                                    <td>{{ $pjln->Total_Harga }}</td>
                                    <td>{{ $pjln->Metode_Pembayaran }}</td>
                                    <td>
                                        <a href="{{ route('DetailPenjualan', $pjln->Id_Penjualan) }}"
                                            class="btn btn-info btn-sm">Detail</a>
                                        <a href="{{ route('EditPenjualan', $pjln->Id_Penjualan) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('DeletePenjualan', $pjln->Id_Penjualan) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus penjualan ini?')">Hapus</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="{{ route('DetailPembayaran', $pjln->Id_Penjualan) }}" class="btn btn-success"><i class="bi bi-info-circle"></i> Lihat Pembayaran</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
