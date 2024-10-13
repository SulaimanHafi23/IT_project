@extends('layouts.SideBar')
@section('SideBar')
    <li>
        <a href="{{ route('Beranda') }}" class="nav-link">
            <i class="bi bi-speedometer2"></i>
            Beranda
        </a>
    </li>
    <li>
        <a href="{{ route('TampilAkun') }}" class="nav-link active">
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
        <h1 style="text-align: center">Halaman Akun</h1>
        <hr>
        <div style="align-content: center">
            <a href="{{ route('TambahAkun') }}">
                <button class="btn btn-primary" type="button">Tambah Data</button>
            </a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">username</th>
                    <th scope="col">Level</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akun as $no => $dataakun)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $dataakun->Username }}</td>
                        <td>{{ $dataakun->level }}</td>
                        <td>
                            <a href="{{ route('EditAkun', $dataakun->Id_Akun) }}">
                                <button type="button" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </a>
                            <form action="{{ route('DeleteAkun', $dataakun->Id_Akun) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
      </div>
    </div>
@endsection
