<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT_Project</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            background-color: #212529;
            padding: 20px;
            color: white;
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
            position: absolute;
            bottom: 20px;
            width: 40%;
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

        .profile .dropdown-toggle::after {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <div class=" d-flex flex-row">
        <!-- Sidebar -->
        <div class="sidebar d-flex flex-column p-3">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <i class="bi bi-bootstrap" style="font-size: 1.5rem;"></i>
                <span class="fs-4 ms-2">Hafidzah</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <ul class="nav nav-pills flex-column mb-auto">
                    @yield('sidebar')
                    <li class="nav-item">
                        <a href="{{ route('Beranda') }}" class="nav-link {{ Route::is('Beranda') ? 'active' : '' }}">
                            <i class="bi bi-speedometer2"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('TampilAkun') }}"
                            class="nav-link {{ Route::is('TampilAkun') ? 'active' : '' }}">
                            <i class="bi bi-person-circle"></i>
                            Akun
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('TampilKaryawan') }}"
                            class="nav-link {{ Route::is('TampilKaryawan') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            Karyawan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('TampilPenjualan') }}"
                            class="nav-link {{ Route::is('TampilPenjualan') ? 'active' : '' }}">
                            <i class="bi bi-table"></i>
                            Penjualan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('produks.index') }}"
                            class="nav-link {{ Route::is('produks.index') ? 'active' : '' }}">
                            <i class="bi bi-grid"></i>
                            Produk
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('TampilLaporan') }}"
                            class="nav-link {{ Route::is('TampilLaporan') ? 'active' : '' }}">
                            <i class="bi bi-journal"></i>
                            Laporan
                        </a>
                    </li>
                </ul>
                <hr><br>
                <hr style="margin-bottom: 0px;">
                <div class="profile d-flex align-items-center" style="padding-bottom:5px;">
                    <img src="https://via.placeholder.com/40" alt="profile">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            mdo
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </div>
                </div>
        </div>
        {{-- content --}}
        @yield('content')
    </div>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5.3 JS Bundle with Popper -->
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script>
            @if (session('success'))
                Swal.fire({
                    icon: "success",
                    title: "BERHASIL",
                    text: "{{ session('success') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @elseif (session('error'))
                Swal.fire({
                    icon: "error",
                    title: "GAGAL!",
                    text: "{{ session('error') }}",
                    showConfirmButton: false,
                    timer: 2000
                });
            @endif
            
            document.addEventListener('DOMContentLoaded', function () {
                @if (session('success') || session('error'))
                var toastLiveExample = document.getElementById('liveToast');
                var toast = new bootstrap.Toast(toastLiveExample);
                toast.show();
                @endif
            });
            </script>
    </script>



</html>
