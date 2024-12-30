@extends('layouts.konten')
@section('content')
    <div class="preloader flex-column justify-content-center align-items-center" id="preloader">
        <img class="animation__shake" src="{{ asset('assets/img/Apotek Hafidzah.png') }}" alt="AdminLTELogo" height="60"
            width="240">
    </div>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Beranda</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <!-- Penjualan Hari ini -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $penjualan }}</h3>
                            <p>Penjualan Hari ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('TampilPenjualan') }}" class="small-box-footer">Selengkapnya <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Produk -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $produk }}</h3>
                            <p>Total Produk</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('produks.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Karyawan -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $karyawan }}</h3>
                            <p>Total Karyawan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('TampilKaryawan') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Pendapatan Hari ini -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><sup style="font-size: 20px">Rp.</sup>{{ $pendapatan }}</h3>
                            <p>Pendapatan Hari ini</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="{{ route('TampilPenjualan') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <!-- Produk dan Penjualan -->
            <div class="card">
                <div class="card-header border-0">
                    <h3 class="card-title">Produk dan Penjualan</h3>
                </div>
                <div class="card-body table-responsive p-0" id="produk-container">
                    @include('partials.produk-table', ['produkTerjual' => $produkTerjual])
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            fetchProduk(url);
        });

        function fetchProduk(url) {
            $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function() {
                    $('#preloader').show(); // Show preloader before AJAX call
                },
                success: function(response) {
                    $('#produk-container').html(response);
                },
                complete: function() {
                    $('#preloader').hide(); // Hide preloader after data is loaded
                },
                error: function(xhr) {
                    console.error('Gagal memuat data produk:', xhr);
                }
            });
        }
    </script>
@endsection
