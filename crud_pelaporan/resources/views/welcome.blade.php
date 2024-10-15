<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Laravel</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
</head>
<body>

    <h1 class="text-center mt-3"> selamat datang di aplikasi</h1>

    <div class="text-center">
        <a href="{{ route('Pencatatan.tampil')}}" class="btn btn-primary">Kelola Catatan</a>
    </div>
</body>
</html>