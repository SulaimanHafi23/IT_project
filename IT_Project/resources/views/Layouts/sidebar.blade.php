<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('Beranda') }}" class="brand-link" style="padding: 20px 0px 10px 0px;">
        <img src="{{ asset('assets/img/Apotek Hafidzah.png') }}" alt="Logo"
            class="brand-image" style="opacity: .8; width:100%; height: 100%; margin-left:0px;"><br>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                {{-- <img src="{{ asset('assets/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Menu untuk Admin -->
                @if (Auth::check() && Auth::user()->level === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('Beranda') }}" class="nav-link {{ Route::is('Beranda') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Beranda</p>
                        </a>
                    </li>
                    <li class="nav-header">Menu</li>
                    <li class="nav-item">
                        <a href="{{ route('TampilAkun') }}"
                            class="nav-link {{ Route::is('TampilAkun') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-user-circle"></i>
                            <p>Akun</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('TampilKaryawan') }}"
                            class="nav-link {{ Route::is('TampilKaryawan') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>Karyawan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('produks.index') }}"
                            class="nav-link {{ Route::is('produks.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-capsules"></i>
                            <p>Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#"
                            class="nav-link {{ Route::is('TampilPenjualan') || Route::is('TampilLaporan') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-money-bill-wave"></i>
                            <p>Penjualan<i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('TampilPenjualan') }}"
                                    class="nav-link {{ Route::is('TampilPenjualan') ? 'active' : '' }}">
                                    <i class="far fa-calendar-alt nav-icon"></i>
                                    <p>Penjualan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('TampilLaporan') }}"
                                    class="nav-link {{ Route::is('TampilLaporan') ? 'active' : '' }}">
                                    <i class="fas fa-book nav-icon"></i>
                                    <p>Laporan</p>
                                </a>
                            </li>
                        </ul>
                        <li class="nav-item">
                            <a href="{{ route('TampilTPK') }}"
                                class="nav-link {{ Route::is('TampilTPK') ? 'active' : '' }}">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Produk Terbaik</p>
                            </a>
                        </li>
                    </li>

                    <!-- Menu untuk Karyawan -->
                @elseif (Auth::check() && Auth::user()->level === 'karyawan')
                    <li class="nav-item">
                        <a href="{{ route('produks.index') }}"
                            class="nav-link {{ Route::is('produks.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-capsules"></i>
                            <p>Produk</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('TampilPenjualan') }}"
                            class="nav-link {{ Route::is('TampilPenjualan') ? 'active' : '' }}">
                            <i class="far fa-calendar-alt nav-icon"></i>
                            <p>Penjualan</p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="button" onclick="hapus(this)" class="nav-link">
                            <i class="fas fa-sign-out-alt nav-icon"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
