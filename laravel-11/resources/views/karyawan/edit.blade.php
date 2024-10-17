<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Karyawan</title>
</head>
<body>
    <div class="container">
        <h2>Edit Karyawan</h2>
        <form action="{{ route('karyawan.update', $karyawan->id_karyawan) }}" method="POST">
            @csrf
            @method('PUT')
        
            <input type="text" name="id_karyawan" value="{{ old('id_karyawan', $karyawan->id_karyawan) }}" required>
            <input type="text" name="nama_karyawan" value="{{ old('nama_karyawan', $karyawan->nama_karyawan) }}" required>
            <input type="text" name="alamat" value="{{ old('alamat', $karyawan->alamat) }}" required>
            <input type="text" name="nomor_telepon" value="{{ old('nomor_telepon', $karyawan->nomor_telepon) }}" required>
            <input type="text" name="id_akun" value="{{ old('id_akun', $karyawan->id_akun) }}" required>
            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $karyawan->tanggal_lahir) }}" required>
            <input type="text" name="posisi_jabatan" value="{{ old('posisi_jabatan', $karyawan->posisi_jabatan) }}" required>
            <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $karyawan->tanggal_masuk) }}" required>
            <input type="number" name="gaji" value="{{ old('gaji', $karyawan->gaji) }}" required>
            <input type="text" name="shift_kerja" value="{{ old('shift_kerja', $karyawan->shift_kerja) }}" required>
        
            <button type="submit">Update</button>
        </form>
        
    </div>
</body>
</html>
