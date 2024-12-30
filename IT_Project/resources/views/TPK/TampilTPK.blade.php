@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Bobot</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item active">Bobot</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Bobot Ci Ri</h3>
                            <div class="card-tools">
                                <!-- Tombol Tambah Bobot -->
                                <a href="{{ route('TambahTPK') }}">
                                    <button type="button" class="btn btn-primary">Tambah Bobot</button>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Terjual</th>
                                        <th>Stok</th>
                                        <th>CI</th>
                                        <th>RI</th>
                                        <th>CR</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Bobot as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->Harga_Satuan }}</td>
                                            <td>{{ $item->Jumlah_Terjual }}</td>
                                            <td>{{ $item->Stok }}</td>
                                            <td>{{ $item->ci }}</td>
                                            <td>{{ $item->ri }}</td>
                                            <td>{{ $item->cr }}</td>
                                            <td>
                                                <a href="{{ route('DetailTPK', $item->id) }}" class="btn btn-info">
                                                    <i class="fas fa-info"></i>
                                                </a>
                                                <form action="{{ route('DeleteTPK', $item->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" onclick="hapus(this)" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Terjual</th>
                                        <th>Stok</th>
                                        <th>CI</th>
                                        <th>RI</th>
                                        <th>CR</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
