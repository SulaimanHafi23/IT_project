@extends('layouts.SideBar')

@section('content')
    <div class="container mt-5">
        <h1 style="text-align: center">Tambah Laporan</h1>
        <hr>
        <div style="align-content: center">
            <form action="{{ route('BuatLaporan') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tanggal_laporan">Tanggal Laporan</label>
                    <input type="date" name="tanggal_laporan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai</label>
                    <input type="date" name="tanggal_mulai" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="tanggal_akhir">Tanggal Akhir</label>
                    <input type="date" name="tanggal_akhir" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
@endsection
