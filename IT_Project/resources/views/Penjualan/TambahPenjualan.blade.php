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
        <h1 class="h4">Tambah Penjualan</h1>
    </div>

    <!-- Form Section -->
    <form action="{{ route('TambahPenjualan') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="Tanggal_Penjualan" class="form-label">Tanggal</label>
                <input type="text" class="form-control" id="Tanggal_Penjualan" name="Tanggal_Penjualan"
                    value="{{ date('Y-m-d') }}" disabled>
                <input type="hidden" name="Tanggal_Penjualan" value="{{ date('Y-m-d') }}">
            </div>
            <div class="col-md-3">
                <label for="Id_Karyawan" class="form-label">Kasir</label>
                <select class="form-select" id="Id_Karyawan" name="Id_Karyawan" required>
                    <option value="" disabled selected>Pilih Kasir</option>
                    @foreach ($karyawan as $kasir)
                        <option value="{{ $kasir->Id_Karyawan }}">{{ $kasir->Nama_Karyawan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="produk" class="form-label">Produk</label>
                <select class="form-select" id="produk" name="produk_id" required>
                    <option value="" disabled selected>Pilih Produk</option>
                    @foreach ($produk as $item)
                        <option value="{{ $item->Id_Produk }}" data-harga="{{ $item->Harga_Satuan }}">
                            {{ $item->Nama_Produk }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <label for="Jumlah" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="Jumlah" name="Jumlah" required min="1">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-primary w-100" id="add-product"><i class="bi bi-plus"></i> Tambah</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-9">
                <h5>Produk</h5>
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
                        <!-- Baris ditambahkan otomatis disini -->
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <div class="total-box">
                    <p>Id Penjualan:
                        <strong>
                            <input type="text" id="Id_Penjualan" name="Id_Penjualan" class="form-control" readonly>
                        </strong>
                    </p>
                    <p class="total-amount">
                        Total:
                        <strong>
                            <input type="text" id="total-amount-display" class="form-control" disabled value="0">
                            <input type="hidden" id="total-amount" name="Total_Harga" value="0">
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
                    <option selected>Tunai</option>
                    <option value="Transfer">Transfer</option>
                    <!-- Tambahkan opsi lainnya jika diperlukan -->
                </select>
            </div>
            <div class="col-md-4">
                <label for="uang" class="form-label">Uang</label>
                <input type="number" class="form-control" id="uang" name="uang" value="" required>
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
                <button type="submit" class="btn btn-success w-100">Proses Transaksi</button>
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
        const jumlah = $('#Jumlah').val();

        // Validasi jika produk dan jumlah valid
        if (!produkId || jumlah <= 0) {
            alert('Silakan pilih produk dan masukkan jumlah yang valid.');
            return;
        }

        // Cek apakah produk sudah ada di tabel
        const existingRow = $(`#product-table-body tr[data-id="${produkId}"]`);
        if (existingRow.length > 0) {
            // Jika produk sudah ada, update jumlah dan subtotal
            const existingJumlah = parseInt(existingRow.find('.jumlah').text());
            const newJumlah = existingJumlah + parseInt(jumlah);
            const newSubtotal = newJumlah * hargaSatuan;

            existingRow.find('.jumlah').text(newJumlah);
            existingRow.find('.subtotal').text(newSubtotal.toLocaleString('id-ID'));
        } else {
            // Jika produk belum ada, tambahkan baris baru
            const newRow = `
                <tr data-id="${produkId}">
                    <td>${$('#product-table-body tr').length + 1}</td>
                    <td>${produkNama}</td>
                    <td class="jumlah">${jumlah}</td>
                    <td>${hargaSatuan.toLocaleString('id-ID')}</td>
                    <td class="subtotal">${(hargaSatuan * jumlah).toLocaleString('id-ID')}</td>
                    <td>
                        <input type="hidden" name="produk_id[]" value="${produkId}">
                        <input type="hidden" name="Jumlah[]" value="${jumlah}">
                        <button type="button" class="btn btn-danger" onclick="removeRow(this)">🗑 Hapus</button>
                    </td>
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
        $('#add-product').click(function() {
            addRow();
        });

        // Fetch the new penjualan ID
        $.ajax({
            url: '/generate-id-penjualan', // Pastikan endpoint ini sudah ada
            type: 'GET',
            success: function(response) {
                if (response && response.Id_Penjualan) {
                    $('#Id_Penjualan').val(response.Id_Penjualan); // Menampilkan ID Penjualan di input
                } else {
                    console.error('Kesalahan: ID Penjualan tidak ditemukan dalam respons.');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });

        // Menghitung kembalian saat uang dimasukkan
        $('#uang').on('input', function() {
            const uang = parseFloat($(this).val()) || 0;
            const total = parseFloat($('#total-amount').val()) || 0;
            const kembalian = uang - total;
            $('#kembalian').val(kembalian >= 0 ? kembalian : 0);
        });
    });
</script>

@endsection
