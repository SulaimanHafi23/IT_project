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
        </div>
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
                                        <!-- Nama Karyawan -->
                                        <div class="mb-3">
                                            <label for="Nama_Karyawan" class="form-label">Nama Karyawan</label>
                                            <input type="text" class="form-control @error('Nama_Karyawan') is-invalid @enderror" 
                                                id="Nama_Karyawan" name="Nama_Karyawan" value="{{ old('Nama_Karyawan') }}" required>
                                            @error('Nama_Karyawan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Alamat -->
                                        <div class="mb-3">
                                            <label for="Alamat" class="form-label">Alamat</label>
                                            <textarea class="form-control @error('Alamat') is-invalid @enderror" 
                                                id="Alamat" name="Alamat" rows="3" required>{{ old('Alamat') }}</textarea>
                                            @error('Alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Nomor Telepon -->
                                        <div class="mb-3">
                                            <label for="Nomor_Telepon" class="form-label">Nomor Telepon</label>
                                            <input type="text" class="form-control @error('Nomor_Telepon') is-invalid @enderror" 
                                                id="Nomor_Telepon" name="Nomor_Telepon" value="{{ old('Nomor_Telepon') }}" required>
                                            @error('Nomor_Telepon')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Posisi Jabatan -->
                                        <div class="mb-3">
                                            <label for="Posisi_Jabatan" class="form-label">Posisi Jabatan</label>
                                            <input type="text" class="form-control @error('Posisi_Jabatan') is-invalid @enderror" 
                                                id="Posisi_Jabatan" name="Posisi_Jabatan" value="{{ old('Posisi_Jabatan') }}" required>
                                            @error('Posisi_Jabatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Tanggal Lahir -->
                                        <div class="mb-3">
                                            <label for="Tanggal_Lahir" class="form-label">Tanggal Lahir</label>
                                            <input type="date" class="form-control @error('Tanggal_Lahir') is-invalid @enderror" 
                                                id="Tanggal_Lahir" name="Tanggal_Lahir" value="{{ old('Tanggal_Lahir') }}" required>
                                            @error('Tanggal_Lahir')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <!-- Shift Kerja -->
                                        <div class="mb-3">
                                            <label for="Shift_Kerja" class="form-label">Shift Kerja</label>
                                            <input type="text" class="form-control @error('Shift_Kerja') is-invalid @enderror" 
                                                id="Shift_Kerja" name="Shift_Kerja" value="{{ old('Shift_Kerja') }}" required>
                                            @error('Shift_Kerja')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Gaji -->
                                        <div class="mb-3">
                                            <label for="Gaji" class="form-label">Gaji</label>
                                            <input type="number" class="form-control @error('Gaji') is-invalid @enderror" 
                                                id="Gaji" name="Gaji" value="{{ old('Gaji') }}" step="0.01" required>
                                            @error('Gaji')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Tanggal Masuk -->
                                        <div class="mb-3">
                                            <label for="Tanggal_Masuk" class="form-label">Tanggal Masuk</label>
                                            <input type="date" class="form-control @error('Tanggal_Masuk') is-invalid @enderror" 
                                                id="Tanggal_Masuk" name="Tanggal_Masuk" value="{{ old('Tanggal_Masuk') }}" required>
                                            @error('Tanggal_Masuk')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- Foto Karyawan -->
                                        <div class="mb-3">
                                            <label for="Gambar_Karyawan" class="form-label">Foto Karyawan</label>
                                            <input type="file" class="form-control @error('Gambar_Karyawan') is-invalid @enderror" 
                                                id="Gambar_Karyawan" name="Gambar_Karyawan" accept="image/*">
                                            @error('Gambar_Karyawan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <!-- ID Akun -->
                                        <div class="mb-3">
                                            <label for="Id_User" class="form-label">ID Akun</label>
                                            <select class="form-control @error('Id_User') is-invalid @enderror" 
                                                id="Id_User" name="Id_User" required>
                                                <option value="" disabled selected>Pilih Akun</option>
                                                @foreach ($user as $akun)
                                                    <option value="{{ $akun->id }}" {{ old('Id_User') == $akun->id ? 'selected' : '' }}>
                                                        {{ $akun->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('Id_User')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
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
@endsection
