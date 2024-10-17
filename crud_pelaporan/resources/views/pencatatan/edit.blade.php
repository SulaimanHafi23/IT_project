@extends('layout')

@section('konten')

<h4>Edit Pencatatan</h4>

<form action="{{ route('Pencatatan.Update', ['id' => $pencatatan->id]) }}" method="POST">
    @csrf
    @method('PUT') <!-- Mengubah metode POST menjadi PUT -->
    
    <div class="mb-3">
        <label for="Tanggal_Pencatatan" class="form-label">Tanggal Pencatatan</label>
        <input type="date" name="Tanggal_Pencatatan" id="Tanggal_Pencatatan" class="form-control" value="{{ $pencatatan->Tanggal_Pencatatan }}" required>
    </div>
    
    <div class="mb-3">
        <label for="Tanggal_Mulai" class="form-label">Tanggal Mulai</label>
        <input type="date" name="Tanggal_Mulai" id="Tanggal_Mulai" class="form-control" value="{{ $pencatatan->Tanggal_Mulai }}" required>
    </div>
    
    <div class="mb-3">
        <label for="Tanggal_Akhir" class="form-label">Tanggal Akhir</label>
        <input type="date" name="Tanggal_Akhir" id="Tanggal_Akhir" class="form-control" value="{{ $pencatatan->Tanggal_Akhir }}" required>
    </div>
    
    <div class="mb-3">
        <label for="Id_Admin" class="form-label">ID Admin</label>
        <input type="number" name="Id_Admin" id="Id_Admin" class="form-control" value="{{ $pencatatan->Id_Admin }}" required>
    </div>
    
    <button class="btn btn-primary">Edit</button>
</form>

@endsection
