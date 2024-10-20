@extends('layouts.SideBar')
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
        <a href="{{ route('TampilPenjualan') }}" class="nav-link">
            <i class="bi bi-table"></i>
            Penjualan
        </a>
    </li>
    <li>
        <a href="{{ route('produks.index') }}" class="nav-link active">
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
    <h2 class="text-center mb-4">Daftar Produk</h2>
    <a href="{{ route('produks.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga Satuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produk as $no =>$produk)
            <tr>
                <td>{{ $no + 1  }}</td>
                <td>{{ $produk->Nama_Produk }}</td>
                <td>{{ $produk->Kategori }}</td>
                <td>Rp {{ number_format($produk->Harga_Satuan, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('produks.edit', $produk->Id_Produk) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('produks.destroy', $produk->Id_Produk) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
