@extends('layouts.SideBar')

@section('content')
    <div class="container mt-2">
        <h1 style="text-align: center">Halaman </h1>
        <hr>
        <!-- Content -->
        <div class="container-fluid">
            <!-- Dashboard cards -->
            <div class="row g-3">
                <div class="card text-white bg-success mb-3" style="max-width: 17rem; margin:3px 5px;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="display-8">
                            <h4>16</h4>
                        </div>
                        <i class="bi bi-cart" style="font-size: 2rem;"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Transaksi Hari ini</h5>
                    </div>
                    <div class="card-footer bg-transparent border-light">
                        <a href="#" class="text-white text-decoration-none">Selengkapnya <i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <div class="card text-white bg-success mb-3" style="max-width: 17rem; margin:3px 5px;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="display-8">
                            <h4>23</h4>
                        </div>
                        <i class="bi bi-cart" style="font-size: 2rem;"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Total Produk</h5>
                    </div>
                    <div class="card-footer bg-transparent border-light">
                        <a href="#" class="text-white text-decoration-none">Selengkapnya <i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="card text-white bg-success mb-3" style="max-width: 17rem; margin:3px 5px;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="display-8">
                            <h4>4</h4>
                        </div>
                        <i class="bi bi-cart" style="font-size: 2rem;"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Total Karyawan</h5>
                    </div>
                    <div class="card-footer bg-transparent border-light">
                        <a href="#" class="text-white text-decoration-none">Selengkapnya <i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>

                <div class="card text-white bg-success mb-3" style="max-width: 17rem; margin:3px 5px;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="display-8">
                            <h4>Rp 1.000.000</h4>
                        </div>
                        <i class="bi bi-cart" style="font-size: 2rem;"></i>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Pendapatan Hari ini</h5>
                    </div>
                    <div class="card-footer bg-transparent border-light">
                        <a href="#" class="text-white text-decoration-none">Selengkapnya <i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>


                <!-- Chart section -->
                <div class="chart-container">
                    <h5 class="chart-title">Total Penjualan</h5>
                    <div class="chart">
                        <!-- Chart can be integrated using Chart.js or any chart library -->
                        <p>Chart placeholder (Januari - Juli 2024)</p>
                    </div>
                </div>

                <!-- Product table section -->
                <div class="table-container">
                    <h5>Produk Terlaris Bulan Ini</h5>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga Rp</th>
                                <th>Unit Terjual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Paracetamol Tablet</td>
                                <td>12,000</td>
                                <td>300</td>
                                <td><i class="bi bi-search"></i></td>
                            </tr>
                            <tr>
                                <td>Neuralgin Rhema Tablet</td>
                                <td>7,000</td>
                                <td>256</td>
                                <td><i class="bi bi-search"></i></td>
                            </tr>
                            <tr>
                                <td>Betadine Antiseptic</td>
                                <td>19,200</td>
                                <td>212</td>
                                <td><i class="bi bi-search"></i></td>
                            </tr>
                            <tr>
                                <td>Bodrex Migra Tablet</td>
                                <td>2,800</td>
                                <td>196</td>
                                <td><i class="bi bi-search"></i></td>
                            </tr>
                            <tr>
                                <td>Cetirizine hydrochloride</td>
                                <td>6,500</td>
                                <td>179</td>
                                <td><i class="bi bi-search"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
