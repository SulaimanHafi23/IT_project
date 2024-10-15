@extends('layout')

@section('konten')

<h4>Tambah Pencatatan</h4>

<form action="{{ route('Pencatatan.submit') }}" method="post">
@csrf
    <label>Tanggal_Pencatatan</label>
    <input type="date" name="Tanggal_Pencatatan" class="form-control mb-2">
    <label>Tanggal_Mulai</label>
    <input type="date" name="Tanggal_Mulai" class="form-control mb-2">
    <label>Tanggal_Akhir</label>
    <input type="date" name="Tanggal_Akhir" class="form-control mb-2">
    <label>Id_Admin</label>
    <input type="number" name="Id_Admin" class="form-control mb-2">

    <button class="btn btn-primary">Tambah</button>
</form>
    
@endsection