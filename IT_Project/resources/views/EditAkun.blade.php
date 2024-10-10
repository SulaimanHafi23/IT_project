<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Akun</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Form Ubah Data Akun</h2>
        <form action="{{route('UpdateAkun', $akun->Id_Akun)}}" method="post">
            @csrf
            <tr>
                <td>
                    <!-- ID Akun -->
                    <div class="mb-3">
                      <label for="id_akun" class="form-label">ID Akun</label>
                      <input type="text" class="form-control" value="{{$akun->Id_Akun}}" id="id_akun" name="id_akun" required>
                    </div>
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" value="{{$akun->Username}}" id="username" name="username" required>
                    </div>
                </td>
                <td>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" value="{{$akun->Password}}" id="password" name="password" required>
                      </div>
                </td>
                <td>
                    <!-- Level -->
                    <div class="mb-3">
                        <label class="form-label">Level</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="{{$akun->level}}" name="level" id="admin" value="admin" required>
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" value="{{$akun->level}}" name="level" id="karyawan" value="karyawan" required>
                            <label class="form-check-label" for="karyawan">Karyawan</label>
                        </div>
                    </div>
                </td>
            </tr>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
        <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>