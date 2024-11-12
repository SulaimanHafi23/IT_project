@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ubah Data Karyawan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('TampilKaryawan') }}">Karyawan</a></li>
                        <li class="breadcrumb-item active">Ubah Karyawan</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </section>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Form Ubah Data Karyawan</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('UpdateKaryawan', $karyawan->Id_Karyawan) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT') <!-- Change to PUT for updates -->

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="Nama_Karyawan" class="form-label">Nama Karyawan</label>
                                        <input type="text" class="form-control" name="Nama_Karyawan" id="Nama_Karyawan"
                                            value="{{ old('Nama_Karyawan', $karyawan->Nama_Karyawan) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="Alamat" class="form-label">Alamat</label>
                                        <textarea class="form-control" name="Alamat" id="Alamat" required>{{ old('Alamat', $karyawan->Alamat) }}</textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="Nomor_Telepon" class="form-label">Nomor Telepon</label>
                                        <input type="text" class="form-control" name="Nomor_Telepon" id="Nomor_Telepon"
                                            value="{{ old('Nomor_Telepon', $karyawan->Nomor_Telepon) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="Posisi_Jabatan" class="form-label">Posisi Jabatan</label>
                                        <input type="text" class="form-control" name="Posisi_Jabatan" id="Posisi_Jabatan"
                                            value="{{ old('Posisi_Jabatan', $karyawan->Posisi_Jabatan) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="Tanggal_Lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="Tanggal_Lahir" id="Tanggal_Lahir"
                                            value="{{ old('Tanggal_Lahir', $karyawan->Tanggal_Lahir) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="Shift_Kerja" class="form-label">Shift Kerja</label>
                                        <input type="text" class="form-control" name="Shift_Kerja" id="Shift_Kerja"
                                            value="{{ old('Shift_Kerja', $karyawan->Shift_Kerja) }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="Gaji" class="form-label">Gaji</label>
                                        <input type="number" class="form-control" name="Gaji" id="Gaji"
                                            value="{{ old('Gaji', $karyawan->Gaji) }}" required>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="Id_User" class="form-label">ID Akun</label>
                                        <input type="text" class="form-control" name="Id_User" id="Id_User"
                                            value="{{ old('Id_User', $karyawan->Id_User) }}" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="custom-file">
                                        <label for="Gambar_Karyawan" class="form-label">Foto Karyawan</label>
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="Gambar_Karyawan" accept="image/*">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                                    @if ($karyawan->Gambar_Karyawan)
                                        <img src="{{ asset('storage/' . $karyawan->Gambar_Karyawan) }}"
                                            alt="Foto Karyawan" class="img-thumbnail mt-2" style="width: 100px;">
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">Perbarui Karyawan</button>
                                <a href="{{ route('TampilKaryawan') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
