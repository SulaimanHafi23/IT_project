<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Akun</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Form Ubah Data Akun</h2>
        <form action="{{route('UpdateAkun', $user->Id_User)}}" method="post">
            @csrf
            <tr>
                <td>
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" value="{{$user->Username}}" id="username" name="username" required>
                    </div>
                </td>
                <td>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" value="{{$user->Password}}" id="password" name="password" required>
                      </div>
                </td>
            </tr>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-primary">Edit</button>
        </form>
        <script src="{{ asset('js/scripts.js') }}"></script>
</body>
</html>