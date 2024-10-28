<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Apotek Hafidzah</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .footer {
            background-color: #343a40;
            text-align: center;
            padding: 10px 0;
            color: gray;
            margin-top: auto;
            color: white;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            /* Membuat sidebar memenuhi seluruh tinggi halaman */
            width: 280px;
            background-color: #343a40;
            padding: 20px;
            color: white;
        }

        .content {
            margin-left: 280px;
            /* Jarak konten ke kiri agar tidak tertutup sidebar */
            /* padding: 20px; */
            width: calc(100% - 280px);
            /* Pastikan konten tidak tumpang tindih dengan sidebar */
        }

        .sidebar .nav-link {
            color: white;
            font-size: 1.1rem;
        }

        .sidebar .nav-link.active {
            background-color: #0d6efd;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
        }

        .sidebar .nav-link i {
            margin-right: 10px;
        }

        .profile {
            position: relative;
            bottom: 20px;
            color: white;
            padding-left: 15px;
        }

        .profile img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            object-fit: cover;
            margin-right: 10px;
        }

        .profile .dropdown-toggle {
            color: white;
            border: none;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body class="d-flex flex-column">
    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column bg-dark text-white">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <i class="bi bi-shop" style="font-size: 3.5rem;"></i>
            <span class="fs-4 ms-2">Apotek Hafidzah</span>
        </a>
        <hr>
        <div class="profile d-flex align-items-center mt-3">
            {{-- <img src="https://via.placeholder.com/40" alt="profile" class="rounded-circle me-2"> --}}
            <i class="bi bi-person-circle" style="font-size: 2.5rem; margin:0px 20px"></i>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"
                    style="background-color: transparent; border: none; color: white;">
                    Nama Admin
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
        </div>
        <hr style="margin-top: 0px;">
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('Beranda') }}" class="nav-link text-white {{ Route::is('Beranda') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Beranda
                </a>
            </li>
            <li>
                <a href="{{ route('TampilAkun') }}"
                    class="nav-link text-white {{ Route::is('TampilAkun') ? 'active' : '' }}">
                    <i class="bi bi-person-circle"></i> Data Akun
                </a>
            </li>
            <li>
                <a href="{{ route('TampilKaryawan') }}"
                    class="nav-link text-white {{ Route::is('TampilKaryawan') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Data Karyawan
                </a>
            </li>
            <li>
                <a href="{{ route('produks.index') }}"
                    class="nav-link text-white {{ Route::is('produks.index') ? 'active' : '' }}">
                    <i class="bi bi-grid"></i> Data Produk
                </a>
            </li>
            <li>
                <a href="{{ route('TampilPenjualan') }}"
                    class="nav-link text-white {{ Route::is('TampilPenjualan') ? 'active' : '' }}">
                    <i class="bi bi-table"></i> Penjualan
                </a>
            </li>
            <li>
                <a href="{{ route('TampilLaporan') }}"
                    class="nav-link text-white {{ Route::is('TampilLaporan') ? 'active' : '' }}">
                    <i class="bi bi-journal"></i> Laporan
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <!-- Header -->
        <div class="header d-flex justify-content-between align-items-center"
            style="border-top: 5px solid black; border-bottom: 1px solid #ccc;">
            <div class="d-flex align-items-center">
            </div>
            <div class="icons d-flex align-items-center">
                <i class="bi bi-search" style="font-size: 2rem; margin:0px 10px"></i>
                <i class="bi bi-person-circle" style="font-size: 2rem; margin:0px 20px"></i>
            </div>
        </div>


        @yield('content')
    </div>
    <!-- Footer -->
    <div class="footer">
        <p>©CopyRight</p>
    </div>
    </div>

    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
