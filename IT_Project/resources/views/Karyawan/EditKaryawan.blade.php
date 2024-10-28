@extends('layouts.SideBar')
@section('content')
    <div class="container mt-2">
        <h1 style="text-align: center">Halaman Karyawan</h1>
        <hr>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('UpdateKaryawan', $karyawan->Id_Karyawan) }}" method="POST" enctype="multipart/form-data">
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
                <label for="Gambar_Karyawan" class="form-label">Gambar Karyawan</label>
                <input type="file" class="form-control" name="Gambar_Karyawan" id="Gambar_Karyawan" accept="image/*">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                @if ($karyawan->Gambar_Karyawan)
                <img src="{{ asset('storage/' . $karyawan->Gambar_Karyawan) }}" alt="Foto Karyawan" class="img-thumbnail mt-2" style="width: 100px;">
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Perbarui Karyawan</button>
            <a href="{{ route('TampilKaryawan') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection
