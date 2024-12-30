@extends('layouts.konten')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Data Bobot SAW</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('Beranda') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('TampilTPK') }}">Bobot</a></li>
                        <li class="breadcrumb-item active">Tambah Bobot SAW</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Form Input Data Bobot SAW</h3>
                        </div>
                        <div class="card-body">
                            <!-- Form Input -->
                            <form action="{{ route('SubmitTPK') }}" method="POST" id="bobotForm">
                                @csrf
                                <div class="form-group">
                                    <label for="Tanggal_Mulai">Tanggal Mulai Penjualan</label>
                                    <input type="date" name="Tanggal_Mulai"
                                        class="form-control @error('Tanggal_Mulai') is-invalid @enderror" required>
                                    @error('Tanggal_Mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="Tanggal_Akhir">Tanggal Akhir Penjualan</label>
                                    <input type="date" name="Tanggal_Akhir"
                                        class="form-control @error('Tanggal_Akhir') is-invalid @enderror" required>
                                    @error('Tanggal_Akhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tabel Skala Perbandingan SAATY -->
                                <h4>Skala Perbandingan SAATY</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nilai</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Kriteria/Alternatif A sama penting dengan kriteria/alternatif B</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>A sedikit lebih penting dari B</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>A jelas lebih penting dari B</td>
                                        </tr>
                                        <tr>
                                            <td>7</td>
                                            <td>A sangat jelas lebih penting dari B</td>
                                        </tr>
                                        <tr>
                                            <td>9</td>
                                            <td>Mutlak lebih penting dari B</td>
                                        </tr>
                                        <tr>
                                            <td>2, 4, 6, 8</td>
                                            <td>Apabila ragu-ragu antara dua nilai yang berdekatan</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Harga Satuan</th>
                                            <th>Jumlah Terjual</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Harga Satuan</td>
                                            <td><input type="number" name="field_11" class="form-control" value="1"
                                                    readonly step="any"></td>
                                            <td><input type="number" name="field_12" class="form-control" id="field_12"
                                                    step="any"></td>
                                            <td><input type="number" name="field_13" class="form-control" id="field_13"
                                                    step="any"></td>
                                        </tr>
                                        <tr>
                                            <td>Jumlah Terjual</td>
                                            <td><input type="number" name="field_21" class="form-control" id="field_21"
                                                    step="any"></td>
                                            <td><input type="number" name="field_22" class="form-control" value="1"
                                                    readonly step="any"></td>
                                            <td><input type="number" name="field_23" class="form-control" id="field_23"
                                                    step="any"></td>
                                        </tr>
                                        <tr>
                                            <td>Stok</td>
                                            <td><input type="number" name="field_31" class="form-control" id="field_31"
                                                    step="any"></td>
                                            <td><input type="number" name="field_32" class="form-control" id="field_32"
                                                    step="any"></td>
                                            <td><input type="number" name="field_33" class="form-control" value="1"
                                                    readonly step="any"></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="form-group">
                                    <label for="ci">CI</label>
                                    <input type="number" name="ci" class="form-control" id="ci" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="ri">RI</label>
                                    <input type="number" name="ri" class="form-control" id="ri" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="cr">CR</label>
                                    <input type="number" name="cr" class="form-control" id="cr" readonly>
                                </div>

                                <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                                <a href="{{ route('TampilTPK') }}" class="btn btn-secondary">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fungsi untuk menghitung CI, RI, dan CR
            function calculateCIandCR() {
                let field_21 = parseFloat(document.getElementById('field_21').value);
                let field_31 = parseFloat(document.getElementById('field_31').value);
                let field_32 = parseFloat(document.getElementById('field_32').value);

                if (isNaN(field_21) || isNaN(field_31) || isNaN(field_32) || field_21 == 0 || field_31 == 0 ||
                    field_32 == 0) {
                    return; // Tidak menghitung jika ada field yang kosong atau nol
                }

                let comparisonMatrix = [
                    [1, field_21, field_31],
                    [1 / field_21, 1, field_32],
                    [1 / field_31, 1 / field_32, 1]
                ];

                // Perhitungan AHP
                let n = comparisonMatrix.length;
                let columnSums = Array(n).fill(0);

                comparisonMatrix.forEach(row => {
                    row.forEach((value, index) => {
                        columnSums[index] += value;
                    });
                });

                // Normalisasi Matriks AHP
                let normalizedMatrix = [];
                for (let i = 0; i < n; i++) {
                    normalizedMatrix[i] = [];
                    for (let j = 0; j < n; j++) {
                        normalizedMatrix[i][j] = comparisonMatrix[i][j] / columnSums[j];
                    }
                }

                // Eigen Vector
                let eigenVector = [];
                for (let i = 0; i < n; i++) {
                    eigenVector[i] = normalizedMatrix[i].reduce((acc, value) => acc + value, 0) / n;
                }

                let weightedSum = eigenVector.map((_, i) =>
                    comparisonMatrix[i].reduce((acc, value, j) => acc + value * eigenVector[j], 0)
                );

                // Menghitung lambdaMax
                let lambdaMax = weightedSum.reduce((acc, value, i) => acc + value / eigenVector[i], 0) / n;

                // Menghitung CI dan CR
                let ci = (lambdaMax - n) / (n - 1);
                let ri = [0, 0, 0.58, 0.9, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49][n] || 1.49;
                let cr = ci / ri;

                document.getElementById('ci').value = ci.toFixed(4);
                document.getElementById('ri').value = ri.toFixed(4);
                document.getElementById('cr').value = cr.toFixed(4);
            }

            // Menambahkan event listener untuk perhitungan otomatis pada field
            document.getElementById('field_21').addEventListener('input', calculateCIandCR);
            document.getElementById('field_31').addEventListener('input', calculateCIandCR);
            document.getElementById('field_32').addEventListener('input', calculateCIandCR);

            // Fungsi untuk mengupdate field yang berlawanan
            function updateField(inputField, targetField, inverse = false) {
                let value = parseFloat(inputField.value);
                if (!isNaN(value) && value != 0) { // Periksa apakah nilainya valid dan bukan nol
                    targetField.value = inverse ? (1 / value).toFixed(4) : value.toFixed(4);
                    calculateCIandCR(); // Memanggil perhitungan setelah field diperbarui
                } else {
                    targetField.value = '';
                }
            }

            // Event listener untuk semua field input agar memperbarui field yang berlawanan secara otomatis
            document.getElementById('field_12').addEventListener('input', function() {
                updateField(this, document.getElementById('field_21'), true);
            });

            document.getElementById('field_21').addEventListener('input', function() {
                updateField(this, document.getElementById('field_12'), true);
            });

            document.getElementById('field_31').addEventListener('input', function() {
                updateField(this, document.getElementById('field_13'), true);
            });

            document.getElementById('field_32').addEventListener('input', function() {
                updateField(this, document.getElementById('field_23'), true);
            });

            document.getElementById('field_13').addEventListener('input', function() {
                updateField(this, document.getElementById('field_31'), true);
            });

            document.getElementById('field_23').addEventListener('input', function() {
                updateField(this, document.getElementById('field_32'), true);
            });
        });
    </script>
@endsection
