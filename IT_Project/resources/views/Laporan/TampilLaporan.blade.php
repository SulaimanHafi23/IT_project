@extends('layouts.SideBar')
@section('SideBar')
    <li>
        <a href="{{ route('Beranda') }}" class="nav-link ">
            <i class="bi bi-speedometer2"></i>
            Beranda
        </a>
    </li>
    <li>
        <a href="{{ route('TampilAkun') }}" class="nav-link ">
            <i class="bi bi-bi bi-person-circle"></i>
            Akun
        </a>
    </li>
    <li>
        <a href="{{ route('Karyawan') }}" class="nav-link ">
            <i class="bi bi-people"></i>
            Karyawan
        </a>
    </li>
    <li>
        <a href="{{ route('TampilPenjualan') }}" class="nav-link">
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
        <a href="{{ route('TampilLaporan') }}" class="nav-link active">
            <i class="bi bi-journal"></i>
            Laporan
        </a>
    </li>
    </ul>
@endsection

@section('content')
    <div class="container mt-5">
        <h1 style="text-align: center">Halaman Laporan</h1>
        <hr>
        <div class="container">
            <h1>Daftar Laporan</h1>
            <a href="{{ route('TambahLaporan') }}" class="btn btn-primary mb-3">Tambah Laporan</a>
            <table class="table table-bordered">
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
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->tanggal_laporan }}</td>
                            <td>{{ $item->tanggal_mulai }}</td>
                            <td>{{ $item->tanggal_akhir }}</td>
                            <td>
                                <a href="{{ route('EditLaporan', $item->Id_Laporan) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('DetailLaporan', $item->Id_Laporan) }}" class="btn btn-info">Detail</a>
                                <form action="{{ route('DeleteLaporan', $item->Id_Laporan) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
