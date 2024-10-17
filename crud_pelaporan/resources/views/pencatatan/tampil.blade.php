@extends('layout')

@section('konten')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4>Daftar Pencatatan</h4>
    <a class="btn btn-primary" href="{{ route('Pencatatan.tambah') }}">Tambah Pencatatan</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Tanggal Pencatatan</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Akhir</th>
            <th>ID Admin</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Pencatatan as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ \Carbon\Carbon::parse($data->Tanggal_Pencatatan)->format('d-m-Y') }}</td>
            <td>{{ $data->Tanggal_Mulai }}</td>
            <td>{{ $data->Tanggal_Akhir }}</td>
            <td>{{ $data->Id_Admin }}</td>
            <td>
                <div class="d-flex">
                    <a href="{{ route('Pencatatan.edit', $data->id) }}" class="btn btn-sm btn-warning me-2">Edit</a>
                    <form action="{{ route('Pencatatan.delete', $data->id )}}" method="post" class="mb-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
