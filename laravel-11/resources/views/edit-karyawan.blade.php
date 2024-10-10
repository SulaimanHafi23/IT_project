@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Karyawan</h1>

    <!-- Form untuk edit karyawan -->
    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama Karyawan</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $karyawan->nama }}" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $karyawan->alamat }}" required>
        </div>

        <div class="form-group">
            <label for="nomor_telepon">Nomor Telepon</label>
            <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" value="{{ $karyawan->nomor_telepon }}" required>
        </div>

        <div class="form-group">
            <label for="id_akun">ID Akun</label>
            <input type="text" class="form-control" id="id_akun" name="id_akun" value="{{ $karyawan->id_akun }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $karyawan->tanggal_lahir }}" required>
        </div>

        <div class="form-group">
            <label for="posisi_jabatan">Posisi Jabatan</label>
            <input type="text" class="form-control" id="posisi_jabatan" name="posisi_jabatan" value="{{ $karyawan->posisi_jabatan }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_masuk">Tanggal Masuk</label>
            <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ $karyawan->tanggal_masuk }}" required>
        </div>

        <div class="form-group">
            <label for="gaji">Gaji</label>
            <input type="number" class="form-control" id="gaji" name="gaji" value="{{ $karyawan->gaji }}" required>
        </div>

        <div class="form-group">
            <label for="shift_kerja">Shift Kerja</label>
            <input type="text" class="form-control" id="shift_kerja" name="shift_kerja" value="{{ $karyawan->shift_kerja }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update Karyawan</button>
        <a href="{{ route('karyawan.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </form>
</div>
@endsection
<form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Form fields here -->
    
    <button type="submit" class="btn btn-primary mt-3">Update Karyawan</button>
</form>