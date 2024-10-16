@extends('layouts.Sidebar')

@section('SideBar')
    <li>
        <a href="{{ route('Beranda') }}" class="nav-link">
            <i class="bi bi-speedometer2"></i>
            Beranda
        </a>
    </li>
    <li>
        <a href="{{ route('TampilAkun') }}" class="nav-link">
            <i class="bi bi-bi bi-person-circle"></i>
            Akun
        </a>
    </li>
    <li>
        <a href="{{ route('Karyawan') }}" class="nav-link">
            <i class="bi bi-people"></i>
            Karyawan
        </a>
    </li>
    <li>
        <a href="{{ route('TampilPenjualan') }}" class="nav-link active">
            <i class="bi bi-table"></i>
            Penjualan
        </a>
    </li>
    <li>
        <a href="{{ route('Produk') }}" class="nav-link">
            <i class="bi bi-grid"></i>
            Produk
        </a>
    </li>
    <li>
        <a href="{{ route('TampilLaporan') }}" class="nav-link">
            <i class="bi bi-journal"></i>
            Laporan
        </a>
    </li>
    </ul>
@endsection

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
                        <th>Aksi</th>
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
