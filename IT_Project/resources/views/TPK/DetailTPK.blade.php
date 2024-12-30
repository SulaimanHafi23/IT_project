@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Data TPK</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('TampilTPK') }}">TPK</a></li>
                        <li class="breadcrumb-item active">Detail TPK</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="padding:6px 20px;">
                            <h3 class="card-title">Detail TPK ID: {{ $HasilSaw->first()->Bobot_Ci_Ri->id }}</h3>
                        </div>
                        <div class="card-body">
                            <strong>
                                <h2 class="card-title"><Strong>Tanggal Masuk :</Strong> {{ $HasilSaw->first()->Bobot_Ci_Ri->Tanggal_Masuk }}</h2>
                            </strong>
                            <br>
                            <strong>
                                <h2 class="card-title"><Strong>Tanggal Akhir :</Strong> {{ $HasilSaw->first()->Bobot_Ci_Ri->Tanggal_Akhir }}</h2>
                            </strong>
                            <br><br>
                            
                            <h3><strong>Data Bobot</strong></h3>
                            <hr>
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah Terjual</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $HasilSaw->first()->Bobot_Ci_Ri->Harga_Satuan }}</td>
                                            <td>{{ $HasilSaw->first()->Bobot_Ci_Ri->Jumlah_Terjual }}</td>
                                            <td>{{ $HasilSaw->first()->Bobot_Ci_Ri->Stok }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah Terjual</th>
                                            <th>Stok</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <h3><strong>Hasil SAW</strong></h3>
                            <hr>
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kriteria</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($HasilSaw as $no => $item)
                                            <tr>
                                                <td>{{ $no + 1 }}</td>
                                                <td>{{ $item->Nama_Produk }}</td>
                                                <td>{{ $item->Skor }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kriteria</th>
                                            <th>Hasil</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <h3><strong>Hasil Perhitungan CI dan RI</strong></h3>
                            <hr>
                            <div class="card-body">
                                <p><strong>CI:</strong> {{ $HasilSaw->first()->Bobot_Ci_Ri->ci }}</p>
                                <p><strong>RI:</strong> {{ $HasilSaw->first()->Bobot_Ci_Ri->ri }}</p>
                                <p><strong>CR (Consistency Ratio):</strong> {{ $HasilSaw->first()->Bobot_Ci_Ri->cr }}</p>
                                @if ($HasilSaw->first()->cr > 0.1)
                                    <div class="alert alert-danger" role="alert">
                                        CR lebih dari 0.1, data tidak dapat disimpan.
                                    </div>
                                @endif
                            </div>

                            <a href="{{ route('TampilTPK') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
