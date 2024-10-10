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
            background-color: #faf8f9;
            padding: 20px;
        }

        h1 {
            color: #007acc;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Data Karyawan</h1>

        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form untuk menambah karyawan -->
        <form action="{{ route('karyawan.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <input type="text" name="id_karyawan" class="form-control" placeholder="ID Karyawan" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="nama_karyawan" class="form-control" placeholder="Nama Karyawan" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon" required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3">
                    <input type="text" name="id_akun" class="form-control" placeholder="ID Akun" required>
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal_lahir" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="posisi_jabatan" class="form-control" placeholder="Posisi Jabatan" required>
                </div>
                <div class="col-md-3">
                    <input type="date" name="tanggal_masuk" class="form-control" required>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-md-3">
                    <input type="number" name="gaji" class="form-control" placeholder="Gaji" required>
                </div>
                <div class="col-md-3">
                    <input type="text" name="shift_kerja" class="form-control" placeholder="Shift Kerja" required>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Tambah Karyawan</button>
                </div>
            </div>
        </form>

        <!-- Tabel untuk menampilkan data karyawan -->
        <div class="table-responsive">
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>ID Akun</th>
                        <th>Tanggal Lahir</th>
                        <th>Posisi Jabatan</th>
                        <th>Tanggal Masuk</th>
                        <th>Gaji</th>
                        <th>Shift Kerja</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($karyawans as $karyawan)
                        <tr>
                            <td>{{ $karyawan->id_karyawan }}</td>
                            <td>{{ $karyawan->nama_karyawan }}</td>
                            <td>{{ $karyawan->alamat }}</td>
                            <td>{{ $karyawan->nomor_telepon }}</td>
                            <td>{{ $karyawan->id_akun }}</td>
                            <td>{{ $karyawan->tanggal_lahir }}</td>
                            <td>{{ $karyawan->posisi_jabatan }}</td>
                            <td>{{ $karyawan->tanggal_masuk }}</td>
                            <td>{{ $karyawan->gaji }}</td>
                            <td>{{ $karyawan->shift_kerja }}</td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
