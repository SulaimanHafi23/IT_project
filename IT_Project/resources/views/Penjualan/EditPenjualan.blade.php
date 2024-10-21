@extends('layouts.Sidebar')
@section('content')

    <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h4">Edit Penjualan</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-sm btn-outline-secondary">Logout</button>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <form action="{{ route('UpdatePenjualan', $penjualan->Id_Penjualan) }}" method="POST">
            @csrf
            @method('PUT') <!-- Menggunakan metode PUT untuk update -->
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="Tanggal_Penjualan" class="form-label">Tanggal</label>
                    <input type="text" class="form-control" id="Tanggal_Penjualan" name="Tanggal_Penjualan"
                        value="{{ $penjualan->Tanggal_Penjualan }}" disabled>
                    <input type="hidden" name="Tanggal_Penjualan" value="{{ $penjualan->Tanggal_Penjualan }}">
                </div>
                <div class="col-md-3">
                    <label for="Id_Karyawan" class="form-label">Kasir</label>
                    <select class="form-select" id="Id_Karyawan" name="Id_Karyawan" required>
                        <option value="" disabled>Pilih Kasir</option>
                        @foreach ($karyawan as $kasir)
                            <option value="{{ $kasir->Id_Karyawan }}"
                                {{ $kasir->Id_Karyawan == $penjualan->Id_Karyawan ? 'selected' : '' }}>
                                {{ $kasir->Nama_Karyawan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="produk" class="form-label">Produk</label>
                    <select class="form-select" id="produk" name="produk_id[]" required>
                        <option value="" disabled>Pilih Produk</option>
                        @foreach ($produk as $item)
                            <option value="{{ $item->Id_Produk }}" data-harga="{{ $item->Harga_Satuan }}">
                                {{ $item->Nama_Produk }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-1">
                    <label for="Jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" id="Jumlah" name="Jumlah[]" required min="1">
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-primary w-100" id="add-product"><i class="bi bi-plus"></i>
                        Tambah</button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9">
                    <h5>Detail Penjualan</h5>
                    <table class="table table-bordered product-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="product-table-body">
                            @foreach ($penjualan->detailPenjualan as $index => $detail)
                                <tr data-id="{{ $detail->produk_id }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->produk->Nama_Produk }}</td>
                                    <td>
                                        <input type="number" class="form-control jumlah" name="Jumlah[]"
                                            value="{{ $detail->Jumlah }}" required min="1">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control harga-satuan" name="Harga_Satuan[]"
                                            value="{{ $detail->Harga_Satuan }}" readonly>
                                    </td>
                                    <td class="subtotal">
                                        {{ number_format($detail->Harga_Satuan * $detail->Jumlah, 2, ',', '.') }}</td>
                                    <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">🗑
                                            Hapus</button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                    <div class="total-box">
                        <p>Id Penjualan:
                            <strong>
                                <input type="text" id="Id_Penjualan" name="Id_Penjualan" class="form-control" readonly
                                    value="{{ $penjualan->Id_Penjualan }}">
                            </strong>
                        </p>
                        <p class="total-amount">
                            Total:
                            <strong>
                                <input type="text" id="total-amount-display" class="form-control" disabled
                                    value="{{ $penjualan->Total_Harga }}">
                                <input type="hidden" id="total-amount" name="Total_Harga"
                                    value="{{ $penjualan->Total_Harga }}">
                            </strong>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Payment Section -->
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="Metode_Pembayaran" class="form-label">Metode Pembayaran</label>
                    <select id="Metode_Pembayaran" class="form-select" name="Metode_Pembayaran" required>
                        <option value="Tunai" {{ $penjualan->Metode_Pembayaran == 'Tunai' ? 'selected' : '' }}>Tunai
                        </option>
                        <option value="Transfer" {{ $penjualan->Metode_Pembayaran == 'Transfer' ? 'selected' : '' }}>
                            Transfer</option>
                        <!-- Tambahkan opsi lainnya jika diperlukan -->
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="uang" class="form-label">Uang</label>
                    <input type="number" class="form-control" id="uang" name="uang"
                        value="{{ old('uang', $penjualan->Uang) }}" required>
                </div>
                <div class="col-md-4">
                    <label for="kembalian" class="form-label">Kembalian</label>
                    <input type="number" class="form-control" id="kembalian" name="kembalian" value="" disabled>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="row mt-3">
                <div class="col-md-6">
                    <button type="button" class="btn btn-info w-100">Cetak Transaksi</button>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success w-100">Update Transaksi</button>
                </div>
            </div>
        </form>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let rowIndex = 0;

        function addRow() {
            const produkSelect = $('#produk option:selected');
            const produkId = produkSelect.val();
            const produkNama = produkSelect.text();
            const hargaSatuan = produkSelect.data('harga');
            const jumlah = parseInt($('#Jumlah').val());

            // Validasi jika produk dan jumlah valid
            if (!produkId || jumlah <= 0) {
                alert('Silakan pilih produk dan masukkan jumlah yang valid.');
                return;
            }

            // Cek apakah produk sudah ada di tabel
            const existingRow = $(`#product-table-body tr[data-id="${produkId}"]`);
            if (existingRow.length > 0) {
                // Jika produk sudah ada, update jumlah dan subtotal
                const existingJumlah = parseInt(existingRow.find('.jumlah').val());
                const newJumlah = existingJumlah + jumlah;
                existingRow.find('.jumlah').val(newJumlah).trigger('input'); // Memicu event input untuk update subtotal
            } else {
                // Jika produk belum ada, tambahkan baris baru
                const newRow = `
            <tr data-id="${produkId}">
                <td>${$('#product-table-body tr').length + 1}</td>
                <td>${produkNama}</td>
                <td>
                    <input type="number" class="form-control jumlah" name="Jumlah[]" value="${jumlah}" required min="1" data-harga="${hargaSatuan}">
                </td>
                <td>
                    <input type="text" class="form-control harga-satuan" name="Harga_Satuan[]" value="${hargaSatuan.toLocaleString('id-ID')}" readonly>
                </td>
                <td class="subtotal">${(hargaSatuan * jumlah).toLocaleString('id-ID')}</td>
                <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">🗑 Hapus</button></td>
            </tr>
        `;
                $('#product-table-body').append(newRow);
            }

            // Update total keseluruhan
            updateTotal();

            // Reset input setelah menambahkan produk
            $('#produk').val('').change();
            $('#Jumlah').val(1);
        }


        function removeRow(button) {
            const row = $(button).closest('tr');
            row.remove();

            // Update total setelah menghapus
            updateTotal();
        }

        function updateTotal() {
            let total = 0;
            $('#product-table-body tr').each(function() {
                const subtotal = parseInt($(this).find('.subtotal').text().replace(/\./g, ''));
                total += subtotal;
            });

            // Update total pada elemen yang tampil di halaman
            $('#total-amount-display').val(total.toLocaleString('id-ID'));

            // Simpan total ke input hidden yang akan dikirim ke server
            $('#total-amount').val(total);
        }

        $(document).ready(function() {
            // Tambahkan produk saat tombol diklik
            $('#add-product').click(addRow);

            // Menghitung kembalian saat uang dimasukkan
            $('#uang').on('input', function() {
                const uang = parseFloat($(this).val()) || 0;
                const total = parseFloat($('#total-amount').val()) || 0;
                const kembalian = uang - total;
                $('#kembalian').val(kembalian >= 0 ? kembalian : 0);
            });

            // Update total secara otomatis ketika jumlah diubah
            $(document).on('input', '.jumlah', function() {
                const row = $(this).closest('tr');
                const jumlah = parseInt($(this).val());
                const hargaSatuan = parseFloat(row.find('.harga-satuan').val());
                const subtotal = jumlah * hargaSatuan;
                row.find('.subtotal').text(subtotal.toLocaleString('id-ID'));

                // Update total setelah mengubah jumlah
                updateTotal();
            });
        });
    </script>

@endsection
