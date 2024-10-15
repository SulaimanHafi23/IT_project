@extends('layout')

@section('konten')
 
<div class="d-flex">
    <h4>Daftar Pencatatan</h4>
    <div class="ms-auto">
        <a class="btn btn-primary" href="{{ route('Pencatatan.tambah') }}">Tambah Pencatatan</a>
    </div>
</div>
       
<table class="table">
    <tr>
        <th>No</th>
        <th>Tanggal_Pencatatan</th>
        <th>Tanggal_Mulai</th>
        <th>Tanggal_Akhir</th>
        <th>Id_Admin</th>
    </tr>
    @foreach($Pencatatan as $no=>$data)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ \Carbon\Carbon::parse($data->Tanggal_Pencatatan)->format('d-m-Y') }}</td>
        <td>{{ $data->Tanggal_Mulai }}</td>
        <td>{{ $data->Tanggal_Akhir }}</td>
        <td>{{ $data->Id_Admin }}</td>
        <td>
            <a href="{{ route('Pencatatan.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
            <form action="{{ route('Pencatatan.delete', $data->id )}}" method="post">
                @csrf
                <button class="btn btn-sm btn-danger">Hapus</button>
            </form>
        </td>
    </tr>
        
    @endforeach
</table>

@endsection