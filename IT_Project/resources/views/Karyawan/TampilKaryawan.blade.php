@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Karyawan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Karyawan</h3>
                            <div class="card-tools">
                                <a href="{{ route('TambahKaryawan') }}">
                                    <button type="button" class="btn btn btn-primary">Tambah Karyawan</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
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
                                                    class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ route('DeleteKaryawan', $data->Id_Karyawan) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="hapus(this)" class="btn btn-danger btn-sm"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID Karyawan</th>
                                        <th>Nama Karyawan</th>
                                        <th>ID Akun</th>
                                        <th>Shift Kerja</th>
                                        <th>Gaji</th>
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
