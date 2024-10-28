@extends('layouts.SideBar')

@section('content')
    <div class="container mt-2">
        <h1 style="text-align: center">Halaman Akun</h1>
        <hr>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-square-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div style="align-content: center">
            <a href="{{ route('TambahAkun') }}">
                <button class="btn btn-primary" type="button">Tambah Data</button>
            </a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Id Akun</th>
                    <th scope="col">username</th>
                    <th scope="col">Level</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $no => $dataakun)
                    <tr>
                        <td>{{ $no + 1 }}</td>
                        <td>{{ $dataakun->Id_User }}</td>
                        <td>{{ $dataakun->Username }}</td>
                        <td>{{ $dataakun->Level }}</td>
                        <td>
                            <a href="{{ route('EditAkun', $dataakun->Id_User) }}">
                                <button type="button" class="btn btn-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                            </a>
                            <form action="{{ route('DeleteAkun', $dataakun->Id_User) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
