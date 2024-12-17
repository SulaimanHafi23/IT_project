@extends('layouts.SideBar')
@section('content')
    <div class="container mt-2">
        <h1 style="text-align: center">Halaman Laporan</h1>
        <hr>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-square-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
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
                            <td>{{ $item->Id_Laporan }}</td>
                            <td>{{ $item->tanggal_laporan }}</td>
                            <td>{{ $item->tanggal_mulai }}</td>
                            <td>{{ $item->tanggal_akhir }}</td>
                            <td>
                                <a href="{{ route('EditLaporan', $item->Id_Laporan) }}" class="btn btn-warning">Edit</a>
                                <a href="{{ route('DetailLaporan', $item->Id_Laporan) }}" class="btn btn-info">Detail</a>
                                <form action="{{ route('DeleteLaporan', $item->Id_Laporan) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
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