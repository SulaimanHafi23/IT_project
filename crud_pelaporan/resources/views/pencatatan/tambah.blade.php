@extends('layout')

@section('konten')

<div class="container mt-5">
    <h4 class="text-center mb-4">Tambah Pencatatan</h4>

    <form action="{{ route('Pencatatan.submit') }}" method="post" class="p-4 border rounded shadow-sm bg-light">
        @csrf
        <div class="mb-3">
            <label for="Tanggal_Pencatatan" class="form-label">Tanggal Pencatatan</label>
            <input type="date" name="Tanggal_Pencatatan" id="Tanggal_Pencatatan" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="Tanggal_Mulai" class="form-label">Tanggal Mulai</label>
            <input type="date" name="Tanggal_Mulai" id="Tanggal_Mulai" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="Tanggal_Akhir" class="form-label">Tanggal Akhir</label>
            <input type="date" name="Tanggal_Akhir" id="Tanggal_Akhir" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="Id_Admin" class="form-label">ID Admin</label>
            <input type="number" name="Id_Admin" id="Id_Admin" class="form-control" required>
        </div>

        <div class="text-center">
            <button class="btn btn-primary btn-lg">Tambah</button>
        </div>
    </form>
</div>

@endsection
