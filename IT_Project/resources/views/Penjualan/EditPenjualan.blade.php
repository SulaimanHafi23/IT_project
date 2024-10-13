@extends('layouts.SideBar')

@section('content')
    <div class="container mt-5">
        <h1 style="text-align: center">Edit Penjualan</h1>
        <hr>    
        <div style="align-content: center">
            <form action="{{ route('penjualan.update', $penjualan->Id_Penjualan) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="Total_Harga" class="form-label">Total Harga</label>
                    <input type="number" class="form-control" id="Total_Harga" name="Total_Harga"
                        value="{{ $penjualan->Total_Harga }}" required>
                </div>

                <div class="mb-3">
                    <label for="Id_Karyawan" class="form-label">ID Karyawan</label>
                    <input type="text" class="form-control" id="Id_Karyawan" name="Id_Karyawan"
                        value="{{ $penjualan->Id_Karyawan }}">
                </div>

                <div class="mb-3">
                    <label for="Tanggal_Penjualan" class="form-label">Tanggal Penjualan</label>
                    <input type="date" class="form-control" id="Tanggal_Penjualan" name="Tanggal_Penjualan"
                        value="{{ $penjualan->Tanggal_Penjualan }}" required>
                </div>

                <div class="mb-3">
                    <label for="Metode_Pembayaran" class="form-label">Metode Pembayaran</label>
                    <input type="text" class="form-control" id="Metode_Pembayaran" name="Metode_Pembayaran"
                        value="{{ $penjualan->Metode_Pembayaran }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
