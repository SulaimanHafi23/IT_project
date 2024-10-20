<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .list-karyawan, .form-karyawan {
            margin-bottom: 20px;
            width: 100%;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .actions button {
            margin-right: 5px;
        }
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .form-container input {
            margin-bottom: 10px;
            padding: 8px;
            width: 100%;
        }
        .alert {
            color: green;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Alert -->
        @if (session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- List Karyawan -->
        <div class="list-karyawan">
            <h2>List Karyawan</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama</th>
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
                        <td class="actions">
                            <a href="{{ route('karyawan.edit', ['karyawan' => $karyawan->id_karyawan]) }}">
                                <button style="background-color: yellow;">Edit</button>
                            </a>                                                        
                            <form action="{{ route('karyawan.destroy', $karyawan->id_karyawan) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background-color: red;" onclick="return confirm('Yakin ingin menghapus karyawan ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Form Tambah Karyawan -->
        <div class="form-karyawan">
            <h2>Tambah Karyawan</h2>
            @if ($errors->any())
                <div style="color: red;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('karyawan.store') }}" method="POST">
                @csrf
                <div class="form-container">
                    <input type="text" name="id_karyawan" placeholder="ID Karyawan" value="{{ old('id_karyawan') }}" required>
                    <input type="text" name="nama_karyawan" placeholder="Nama Karyawan" value="{{ old('nama_karyawan') }}" required>
                    <input type="text" name="alamat" placeholder="Alamat" value="{{ old('alamat') }}" required>
                    <input type="text" name="nomor_telepon" placeholder="Nomor Telepon" value="{{ old('nomor_telepon') }}" required>
                    <input type="text" name="id_akun" placeholder="ID Akun" value="{{ old('id_akun') }}" required>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                    <input type="text" name="posisi_jabatan" placeholder="Posisi Jabatan" value="{{ old('posisi_jabatan') }}" required>
                    <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required>
                    <input type="number" name="gaji" placeholder="Gaji" value="{{ old('gaji') }}" required>
                    <input type="text" name="shift_kerja" placeholder="Shift Kerja" value="{{ old('shift_kerja') }}" required>
                    <button type="submit" style="background-color: blue; color: white;">Tambah</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
