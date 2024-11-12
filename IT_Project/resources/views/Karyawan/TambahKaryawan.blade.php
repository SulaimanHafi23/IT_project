@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('TampilKaryawan') }}">Karyawan</a></li>
                        <li class="breadcrumb-item active">Tambah Karyawan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Input Data Karyawan</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('TambahKaryawan') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Nama_Karyawan" class="form-label">Nama Karyawan</label>
                                            <input type="text" class="form-control" id="Nama_Karyawan"
                                                name="Nama_Karyawan" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="Alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control" id="Alamat" name="Alamat" rows="3" required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="Nomor_Telepon" class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control" id="Nomor_Telepon"
                                                name="Nomor_Telepon" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="Posisi_Jabatan" class="form-label">Posisi Jabatan</label>
                                            <input type="text" class="form-control" id="Posisi_Jabatan"
                                                name="Posisi_Jabatan" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="Tanggal_Lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="Tanggal_Lahir"
                                                name="Tanggal_Lahir" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="Shift_Kerja" class="form-label">Shift Kerja</label>
                                            <input type="text" class="form-control" id="Shift_Kerja" name="Shift_Kerja" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="Gaji" class="form-label">Gaji</label>
                                            <input type="number" class="form-control" id="Gaji" name="Gaji"
                                                step="0.01" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="Tanggal_Masuk" class="form-label">Tanggal Masuk</label>
                                            <input type="date" class="form-control" id="Tanggal_Masuk"
                                                name="Tanggal_Masuk" required>
                                        </div>

                                        <div class="mb-3">
                                            <div class="custom-file">
                                                <label for="Gambar_Karyawan" class="form-label">Foto Karyawan</label>
                                                <input type="file" class="custom-file-input" id="exampleInputFile" name="Gambar_Karyawan" accept="image/*">
                                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                              </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="Id_User" class="form-label">ID Akun</label>
                                            <select class="form-select" id="Id_User" name="Id_User" required>
                                                <option value="" disabled selected>Pilih Akun</option>
                                                @foreach ($user as $akun)
                                                    <option value="{{ $akun->Id_User }}">{{ $akun->Username }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('TampilKaryawan') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
