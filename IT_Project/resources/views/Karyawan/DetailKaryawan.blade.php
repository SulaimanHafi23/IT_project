@extends('layouts.SideBar')

@section('content')
<div class="container mt-2">
    <h1 class="text-center">Detail Karyawan</h1>
    <hr>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="card-title">Foto Karyawan</h5>
                    @if ($karyawan->Gambar_Karyawan)
                        <img src="{{ asset('storage/' . $karyawan->Gambar_Karyawan) }}" alt="Foto Karyawan" class="img-thumbnail">
                    @else

                        <img src="https://via.placeholder.com/150" alt="Foto Karyawan" class="img-thumbnail">
                    @endif
                </div>
                <div class="col-md-8">
                    <h5 class="card-title">Informasi Karyawan</h5>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>ID Karyawan:</strong> {{ $karyawan->Id_Karyawan }}</li>
                        <li class="list-group-item"><strong>Nama Karyawan:</strong> {{ $karyawan->Nama_Karyawan }}</li>
                        <li class="list-group-item"><strong>Alamat:</strong> {{ $karyawan->Alamat }}</li>
                        <li class="list-group-item"><strong>Nomor Telepon:</strong> {{ $karyawan->Nomor_Telepon }}</li>
                        <li class="list-group-item"><strong>Posisi Jabatan:</strong> {{ $karyawan->Posisi_Jabatan }}</li>
                        <li class="list-group-item"><strong>Tanggal Lahir:</strong> {{ \Carbon\Carbon::parse($karyawan->Tanggal_Lahir)->format('d-m-Y') }}</li>
                        <li class="list-group-item"><strong>Shift Kerja:</strong> {{ $karyawan->Shift_Kerja }}</li>
                        <li class="list-group-item"><strong>Gaji:</strong> Rp {{ number_format($karyawan->Gaji, 2, ',', '.') }}</li>
                        <li class="list-group-item"><strong>ID Akun:</strong> {{ $karyawan->Id_User }}</li>
                        <li class="list-group-item"><strong>Tanggal Masuk:</strong> {{ \Carbon\Carbon::parse($karyawan->Tanggal_Masuk)->format('d-m-Y') }}</li>
                    </ul>
                </div>
            </div>
            <a href="{{ route('EditKaryawan', $karyawan->Id_Karyawan) }}" class="btn btn-warning mt-3">Edit Karyawan</a>
            <a href="{{ route('TampilKaryawan') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    </div>
</div>
@endsection
