@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Akun</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Akun</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Akun</h3>
                            <div class="card-tools">
                                <a href="{{ route('TambahAkun') }}">
                                    <button type="button" class="btn btn btn-primary">Tambah Akun</button>
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Akun</th>
                                        <th>username</th>
                                        <th>email</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                @foreach ($user as $no => $dataakun)
                                    <tr>
                                        <td>{{ $no + 1 }}</td>
                                        <td>{{ $dataakun->id }}</td>
                                        <td>{{ $dataakun->name }}</td>
                                        <td>{{ $dataakun->email }}</td>
                                        <td>{{ $dataakun->level }}</td>
                                        <td>
                                            <a href="{{ route('EditAkun', $dataakun->id) }}">
                                                <button type="button" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </a>
                                            <form action="{{ route('DeleteAkun', $dataakun->id) }}" method="POST"
                                                style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" onclick="hapus(this)" class="btn btn-danger btn-sm" id="delete-button">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Akun</th>
                                        <th>name</th>
                                        <th>email</th>
                                        <th>Level</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

@endsection
