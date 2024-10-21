@extends('layouts.SideBar')
@section('content')
    <div class="container mt-5">
        <h1 style="text-align: center">Halaman Karyawan</h1>
        <hr>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('TambahKaryawan') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="Nama_Karyawan" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="Nama_Karyawan" name="Nama_Karyawan"
                            value="{{ old('Nama_Karyawan') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="Alamat" name="Alamat" rows="3" required>{{ old('Alamat') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="Nomor_Telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="Nomor_Telepon" name="Nomor_Telepon"
                            value="{{ old('Nomor_Telepon') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Posisi_Jabatan" class="form-label">Posisi Jabatan</label>
                        <input type="text" class="form-control" id="Posisi_Jabatan" name="Posisi_Jabatan"
                            value="{{ old('Posisi_Jabatan') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Tanggal_Lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="Tanggal_Lahir" name="Tanggal_Lahir"
                            value="{{ old('Tanggal_Lahir') }}" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="Shift_Kerja" class="form-label">Shift Kerja</label>
                        <input type="text" class="form-control" id="Shift_Kerja" name="Shift_Kerja"
                            value="{{ old('Shift_Kerja') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Gaji" class="form-label">Gaji</label>
                        <input type="number" class="form-control" id="Gaji" name="Gaji" step="0.01"
                            value="{{ old('Gaji') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Tanggal_Masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" id="Tanggal_Masuk" name="Tanggal_Masuk"
                            value="{{ old('Tanggal_Masuk') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="Gambar_Karyawan" class="form-label">Foto Karyawan</label>
                        <input type="file" class="form-control" id="Gambar_Karyawan" name="Gambar_Karyawan" accept="image/*">
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
@endsection
