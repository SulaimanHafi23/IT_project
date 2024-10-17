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
    </style>
</head>
<body>

    <div class="container">
        <!-- List Karyawan -->
        <div class="list-karyawan">
            <h2>List Karyawan</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID Karyawan</th>
                        <th>Nama Karyawan</th>
                        <th>Alamat</th>
                        <th>ID Akun</th>
                        <th>Posisi Jabatan</th>
                        <th>Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($karyawans as $karyawan)
                    <tr>
                        <td>{{ $karyawan->id }}</td>
                        <td>{{ $karyawan->nama }}</td>
                        <td>{{ $karyawan->alamat }}</td>
                        <td>{{ $karyawan->id_akun }}</td>
                        <td>{{ $karyawan->posisi_jabatan }}</td>
                        <td>{{ $karyawan->gaji }}</td>
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
                    <input type="text" name="nama" placeholder="Nama Karyawan" required>
                    <input type="text" name="alamat" placeholder="Alamat" required>
                    <input type="text" name="id_akun" placeholder="ID Akun" required>
                    <input type="text" name="posisi_jabatan" placeholder="Posisi Jabatan" required>
                    <input type="number" name="gaji" placeholder="Gaji" required>
                    <button type="submit" style="background-color: blue; color: white;">Tambah</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
