<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Penjualan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use App\Http\Controllers\Controller;

class PembayaranController extends Controller
{
    public function lihat()
    {
        // Ambil penjualan terakhir beserta pembayaran terkait
        $penjualan = Penjualan::with('pembayaran')->orderBy('created_at', 'desc')->first();

        if (!$penjualan) {
            return redirect()->route('TampilPenjualan')->with('error', 'Data penjualan tidak ditemukan.');
        }

        // Ambil detail penjualan terkait
        $detail_penjualan = DetailPenjualan::where('Id_Penjualan', $penjualan->Id_Penjualan)
            ->join('produk', 'detail_penjualan.Id_Produk', '=', 'produk.Id_Produk')
            ->select('detail_penjualan.*', 'produk.Nama_Produk', 'produk.Harga_Satuan')
            ->get();

        // Cek apakah pembayaran sudah ada, jika belum buat pembayaran baru
        if (!$penjualan->pembayaran) {
            $pembayaran = Pembayaran::create([
                'Id_Penjualan' => $penjualan->Id_Penjualan,
                'Total_Pembayaran' => $penjualan->Total_Harga,
                'Tanggal_Pembayaran' => Carbon::now(),
                'Status_Pembayaran' => 'Terbuat',
                'Referensi_Pembayaran' => null,
            ]);
        } else {
            $pembayaran = $penjualan->pembayaran;
        }

        // Set konfigurasi Midtrans
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Set parameter transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $pembayaran->Id_Penjualan,
                'gross_amount' => (int) $pembayaran->Total_Pembayaran,
            ],
            'customer_details' => [
                'first_name' => 'Budi',
                'last_name' => 'Pratama',
                'email' => 'budi.pra@example.com',
                'phone' => '08111222333',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        try {
            if (!$pembayaran->Referensi_Pembayaran) {
                // Dapatkan Snap Token
                $snapToken = Snap::getSnapToken($params);
            } else {
                $snapToken = $pembayaran->Referensi_Pembayaran;
            }

            // Perbarui pembayaran dengan Snap Token
            $pembayaran->update([
                'Referensi_Pembayaran' => $snapToken,
            ]);

            // Kirim data ke view
            return view('Pembayaran.Pembayaran', compact('penjualan', 'detail_penjualan', 'snapToken'));
        } catch (\Exception $e) {
            return redirect()->route('Pembayaran.Pembayaran')->with('error', 'Terjadi kesalahan saat memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function submit(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed === $request->signature_key) {
            // Proses pembayaran
            $pembayaran = Pembayaran::find($request->order_id);

            if (!$pembayaran) {
                return redirect()->route('TampilPenjualan')->with('error', 'Data pembayaran tidak ditemukan.');
            }

            $pembayaran->update([
                'Status_Pembayaran' => 'Terbayar',
                'Tanggal_Pembayaran' => now(),
            ]);

            return redirect()->route('TampilPenjualan')->with('success', 'Pembayaran berhasil dilakukan!');
        }

        return redirect()->route('TampilPenjualan')->with('error', 'Signature key tidak valid. Pembayaran gagal.');
    }

    public function detail($id_penjualan)
    {
        $penjualan = Penjualan::with('pembayaran')->where('Id_Penjualan', $id_penjualan)->first();
        
        if (!$penjualan) {
            return redirect()->route('TampilPenjualan')->with('error', 'Data penjualan tidak ditemukan.');
        }

        return view('Pembayaran.DetailPembayaran', compact('penjualan'));
    }
}
