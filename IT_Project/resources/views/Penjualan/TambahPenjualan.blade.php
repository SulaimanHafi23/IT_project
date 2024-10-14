@extends('layouts.SideBar')

@section('content')
    <div class="container mt-5">
        <h1 style="text-align: center">Tambah Penjualan</h1>
        <hr>
        <div style="align-content: center">
            <form action="{{ route('penjualan.TambahPenjualan') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="Total_Harga" class="form-label">Total Harga</label>
                    <input type="number" class="form-control" id="Total_Harga" name="Total_Harga" placeholder="Total Harga"
                        required>
                </div>

                <div class="mb-3">
                    <label for="Id_Karyawan" class="form-label">ID Karyawan</label>
                    <input type="text" class="form-control" id="Id_Karyawan" name="Id_Karyawan"
                        placeholder="ID Karyawan">
                </div>

                <div class="mb-3">
                    <label for="Tanggal_Penjualan" class="form-label">Tanggal Penjualan</label>
                    <input type="date" class="form-control" id="Tanggal_Penjualan" name="Tanggal_Penjualan" required>
                </div>

                <div class="mb-3">
                    <label for="Metode_Pembayaran" class="form-label">Metode Pembayaran</label>
                    <input type="text" class="form-control" id="Metode_Pembayaran" name="Metode_Pembayaran"
                        placeholder="Metode Pembayaran" required>
                </div>

                <h2 class="my-4">Detail Barang</h2>

                <table class="table table-bordered" id="barangTable">
                    <thead class="table-light">
                        <tr>
                            <th>ID Produk</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="text" class="form-control" name="detail_penjualan[0][Id_Produk]"
                                    placeholder="ID Produk"></td>
                            <td><input type="number" class="form-control" name="detail_penjualan[0][Harga_Satuan]"
                                    placeholder="Harga Satuan" required></td>
                            <td><input type="number" class="form-control" name="detail_penjualan[0][Jumlah]"
                                    placeholder="Jumlah" required></td>
                            <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Hapus</button></td>
                        </tr>
                    </tbody>
                </table>

                <button type="button" class="btn btn-primary my-3" onclick="addRow()">Tambah Barang</button><br><br>

                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>

    <script>
        let rowIndex = 1;

        function addRow() {
            const table = document.getElementById('barangTable').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow();
            newRow.innerHTML = `
                    <td><input type="text" class="form-control" name="detail_penjualan[${rowIndex}][Id_Produk]" placeholder="ID Produk"></td>
                    <td><input type="number" class="form-control" name="detail_penjualan[${rowIndex}][Harga_Satuan]" placeholder="Harga Satuan" required></td>
                    <td><input type="number" class="form-control" name="detail_penjualan[${rowIndex}][Jumlah]" placeholder="Jumlah" required></td>
                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Hapus</button></td>
                `;
            rowIndex++;
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
        }
    </script>
@endsection
