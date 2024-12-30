<table class="table table-striped table-valign-middle">
    <thead>
        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah Terjual</th>
            <th>Pendapatan Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($produkTerjual as $produk)
            <tr>
                <td>{{ $produk->Nama_Produk }}</td>
                <td>Rp. {{ number_format($produk->Harga_Satuan, 0, ',', '.') }}</td>
                <td>{{ $produk->Jumlah ?? 0 }}</td>
                <td>
                    Rp. {{ number_format(($produk->Jumlah ?? 0) * $produk->Harga_Satuan, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Pagination -->
<div class="mt-3">
    {{ $produkTerjual->links('pagination::bootstrap-4') }}
</div>