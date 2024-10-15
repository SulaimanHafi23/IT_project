@extends('layout')

@section('konten')

<h4>Edit Pencatatan</h4>

<form action="{{ route('Pencatatan.Update', ['id' => $pencatatan->id]) }}" method="PATCH">
    @csrf
    <input type="text" name="No" value="1">
    <input type="date" name="Tanggal_Pencatatan">
    <input type="date" name="Tanggal_Mulai">
    <input type="date" name="Tanggal_Akhir">
    <input type="text" name="Id_Admin">

    <button class="btn btn-primary">Edit</button>
</form>
    
@endsection