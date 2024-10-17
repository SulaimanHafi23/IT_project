<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APOTEK HAFIDZAH</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <style>
        body {
            background-color: #f8f9fa; /* Warna latar belakang */
            display: flex; /* Menggunakan flexbox */
            flex-direction: column; /* Mengatur arah kolom */
            min-height: 100vh; /* Memastikan tinggi minimal 100% viewport */
        }
        .header {
            background-color: #4CAF50; /* Warna hijau */
            color: white;
            padding: 20px;
            border-radius: 5px;
        }
        .welcome-text {
            margin-top: 50px;
            font-size: 2rem;
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff; /* Warna biru */
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Warna biru lebih gelap saat hover */
            border-color: #0056b3;
        }
        .apotek-image {
            width: 100%;
            max-width: 600px; /* Atur lebar maksimum gambar */
            margin-top: 30px;
            border-radius: 10px; /* Bulatkan sudut gambar */
        }
        .footer {
            margin-top: auto; /* Memastikan footer berada di bawah */
            padding: 20px; /* Padding footer */
            text-align: center; /* Teks rata tengah */
            background-color: #ffffff; /* Warna latar belakang footer */
            border-top: 1px solid #eaeaea; /* Garis atas footer */
            position: relative; /* Mengatur posisi relative */
        }
    </style>
</head>
<body>

    <div class="header text-center">
        <h1>APOTEK HAFIDZAH</h1>
    </div>

    <div class="container text-center mt-5">
        <div class="welcome-text">Selamat Datang Tuan!</div>
        <p class="mt-4">Silakan klik tombol di bawah untuk mengelola pencatatan apotek.</p>
        <a href="{{ route('Pencatatan.tampil')}}" class="btn btn-primary btn-lg">Kelola Pencatatan</a>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Apotek Hafidzah. Semua hak dilindungi.</p>
    </div>

</body>
</html>
