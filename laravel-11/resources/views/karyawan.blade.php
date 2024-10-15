<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f8ff;
            padding: 20px;
        }

        h1 {
            color: #007acc;
            text-align: center;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }

        .section {
            padding: 20px;
            border: 1px solid #007acc;
            border-radius: 8px;
            background-color: #ffffff;
            margin-bottom: 20px;
        }

        .form-section {
            width: 100%;
            border: 1px solid #007acc;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .list-section {
            width: 100%;
            border: 1px solid #007acc;
            padding: 20px;
            border-radius: 8px;
            background-color: #f9f9f9;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .alert {
            margin-top: 20px;
        }

        input.form-control {
            font-size: 0.9rem;
        }

        button {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Karyawan</h1>
    </div>

    <div class="container mt-4">
        <!-- List Karyawan -->
        <div class="col-md-5 list-section">
            <h2>List Karyawan</h2>
            <!-- Menampilkan pesan sukses jika ada -->
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabel untuk menampilkan data karyawan -->
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>ID Karyawan</th>
                            <th>Nama Karyawan</th>
                            <th>Posisi Jabatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawans as $karyawan)
                            <tr>
                                <td>{{ $karyawan->id_karyawan }}</td>
                                <td>{{ $karyawan->nama_karyawan }}</td>
                                <td>{{ $karyawan->posisi_jabatan }}</td>
                                <td>
                                    <a href="{{ route('karyawan.edit', $karyawan->id_karyawan) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('karyawan.destroy', $karyawan->id_karyawan) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form Tambah Karyawan -->
        <div class="col-md-5 form-section">
            <h2>Tambah Karyawan</h2>
            <form action="{{ route('karyawan.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="id_karyawan" class="form-control" placeholder="ID Karyawan" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="nama_karyawan" class="form-control" placeholder="Nama Karyawan" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="id_akun" class="form-control" placeholder="ID Akun" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="date" name="tanggal_lahir" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="posisi_jabatan" class="form-control" placeholder="Posisi Jabatan" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="date" name="tanggal_masuk" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="number" name="gaji" class="form-control" placeholder="Gaji" required>
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="shift_kerja" class="form-control" placeholder="Shift Kerja" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
