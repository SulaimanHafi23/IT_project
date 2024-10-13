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
        <a href="{{ route('Laporan') }}" class="nav-link">
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
            <a href="{{ route('penjualan.create') }}" class="btn btn-primary mb-3">Tambah Penjualan</a>

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
                    @if ($penjualans->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada penjualan yang ditemukan</td>
                        </tr>
                    @else
                        @foreach ($penjualans as $penjualan)
                            <tr>
                                <td>{{ $penjualan->Tanggal_Penjualan }}</td>
                                <td>{{ $penjualan->Total_Harga }}</td>
                                <td>{{ $penjualan->Metode_Pembayaran }}</td>
                                <td>
                                    <a href="{{ route('penjualan.show', $penjualan->Id_Penjualan) }}"
                                        class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('penjualan.edit', $penjualan->Id_Penjualan) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('penjualan.destroy', $penjualan->Id_Penjualan) }}"
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
