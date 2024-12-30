@extends('Layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profil karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-square-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Profil</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            @if ($karyawan->Gambar_Karyawan)
                                <img src="{{ asset('storage/' . $karyawan->Gambar_Karyawan) }}" alt="Foto Karyawan"
                                    class="img-thumbnail">
                            @else
                                <img src="https://via.placeholder.com/150" alt="Foto Karyawan"
                                    class="img-thumbnail">
                            @endif
                        </div>  
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $karyawan->Nama_Karyawan }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>{{ $karyawan->Alamat }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Telepon</th>
                                    <td>{{ $karyawan->Nomor_Telepon }}</td>
                                </tr>
                                <tr>
                                    <th>Posisi Jabatan</th>
                                    <td>{{ $karyawan->Posisi_Jabatan }}</td>
                                </tr>
                                <tr>
                                    <th>Gaji</th>
                                    <td>Rp {{ number_format($karyawan->Gaji, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Masuk</th>
                                    <td>{{ $karyawan->Tanggal_Masuk }}</td>
                                </tr>
                                <tr>
                                    <th>Shift Kerja</th>
                                    <td>{{ $karyawan->Shift_Kerja }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ $karyawan->Tanggal_Lahir }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
