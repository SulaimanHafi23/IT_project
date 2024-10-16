@extends('layouts.SideBar')

@section('content')
<div class="container">
    <h1>Edit Laporan</h1>
    <form action="{{ route('UpdateLaporan', $laporan->Id_Laporan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="Tanggal_laporan">Tanggal Laporan</label>
            <input type="date" name="Tanggal_laporan" class="form-control" value="{{ $laporan->Tanggal_laporan }}" disabled>
        </div>
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="{{ $laporan->tanggal_mulai }}" required>
        </div>
        <div class="form-group">
            <label for="tanggal_akhir">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" class="form-control" value="{{ $laporan->tanggal_akhir }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
