@extends('layouts.SideBar')
@section('content')
    <div class="container mt-2">
        <h1 style="text-align: center">Halaman Karyawan</h1>
        <hr>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-square-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a href="{{ route('TambahKaryawan') }}" class="btn btn-primary mb-3">Tambah Karyawan</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Karyawan</th>
                    <th>Nama Karyawan</th>
                    <th>ID Akun</th>
                    <th>Shift Kerja</th>
                    <th>Gaji</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($karyawan as $data)
                    <tr>
                        <td>{{ $data->Id_Karyawan }}</td>
                        <td>{{ $data->Nama_Karyawan }}</td>
                        <td>{{ $data->Id_User }}</td>
                        <td>{{ $data->Shift_Kerja }}</td>
                        <td>Rp {{ number_format($data->Gaji, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('DetailKaryawan', $data->Id_Karyawan) }}"
                                class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('EditKaryawan', $data->Id_Karyawan) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('DeleteKaryawan', $data->Id_Karyawan) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                              </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
