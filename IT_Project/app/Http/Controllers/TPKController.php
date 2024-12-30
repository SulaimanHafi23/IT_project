<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\HasilSaw;
use App\Models\BobotCiRi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TPKController extends Controller
{
    public function Tampil(){
        $Bobot = BobotCiRi::all();
        return view('TPK.TampilTPK', compact('Bobot'));
    }

    public function Tambah(){
        return view('TPK.TambahTPK');
    }

    public function Submit(Request $request){

        $request->validate([
            'field_21' => 'Required',
            'field_31' => 'Required',
            'field_32' => 'Required',
            'field_12' => 'Required',
            'field_13' => 'Required',
            'field_23' => 'Required',
            'Tanggal_Mulai' => 'Required',
            'Tanggal_Akhir' => 'Required'
        ]);

        // Matriks perbandingan AHP
        $comparisonMatrix = [
            [1,                     $request->field_12,     $request->field_13  ],      // Harga Satuan dibandingkan dengan Harga Satuan, Total Terjual, Stok
            [$request->field_21,    1,                      $request->field_23  ],    // Total Terjual Perbulan dibandingkan dengan Harga Satuan, Total Terjual, Stok
            [$request->field_31,    $request->field_32,     1                   ],  // Stok dibandingkan dengan Harga Satuan, Total Terjual, Stok
        ];

        // Perhitungan AHP
        $n = count($comparisonMatrix);
        $columnSums = array_fill(0, $n, 0);
        foreach ($comparisonMatrix as $row) {
            foreach ($row as $colIndex => $value) {
                $columnSums[$colIndex] += $value;
            }
        }

        // Normalisasi matriks AHP
        $normalizedMatrix = [];
        for ($i = 0; $i < $n; $i++) {
            for ($j = 0; $j < $n; $j++) {
                $normalizedMatrix[$i][$j] = $comparisonMatrix[$i][$j] / $columnSums[$j];
            }
        }

        // Menghitung Eigen Vektor
        $eigenVector = [];
        for ($i = 0; $i < $n; $i++) {
            $eigenVector[$i] = array_sum($normalizedMatrix[$i]) / $n;
        }

        $Harga_Satuan   = $eigenVector[0];
        $Jumlah_Terjual = $eigenVector[1];
        $Stok           = $eigenVector[2];
        
        // Menghitung Weighted Sum
        $weightedSum = [];
        for ($i = 0; $i < $n; $i++) {
            $weightedSum[$i] = 0;
            for ($j = 0; $j < $n; $j++) {
                $weightedSum[$i] += $comparisonMatrix[$i][$j] * $eigenVector[$j];
            }
        }

        // Menghitung lambdaMax
        $lambdaMax = 0;
        for ($i = 0; $i < $n; $i++) {
            $lambdaMax += $weightedSum[$i] / $eigenVector[$i];
        }
        
        $lambdaMax = $lambdaMax / $n;

        // Menghitung Consistency Index (CI)
        $ci = ($lambdaMax - $n) / ($n - 1);

        // Menghitung Consistency Ratio (CR)
        $riValues = [
            1 => 0.00,
            2 => 0.00,
            3 => 0.58,
            4 => 0.90,
            5 => 1.12,
            6 => 1.24,
            7 => 1.32,
            8 => 1.41,
            9 => 1.45,
            10 => 1.49
        ];

        $ri = $riValues[$n] ?? 1.49; // Default RI untuk n > 10
        $cr = $ri > 0 ? $ci / $ri : 0;
        
        $tanggalMulai = $request->Tanggal_Mulai;
        $tanggalAkhir = $request->Tanggal_Akhir;
        
        $bobotCiRi = new BobotCiRi();
        $bobotCiRi->Tanggal_Mulai = $tanggalMulai;
        $bobotCiRi->Tanggal_Akhir = $tanggalAkhir;
        $bobotCiRi->Harga_Satuan = $Harga_Satuan;
        $bobotCiRi->Jumlah_Terjual = $Jumlah_Terjual;
        $bobotCiRi->Stok = $Stok;
        $bobotCiRi->ci = $ci;
        $bobotCiRi->ri = $ri;
        $bobotCiRi->cr = $cr;
        $bobotCiRi->save();


        $produkData = Produk::with(['detailPenjualan' => function ($query) use ($tanggalMulai, $tanggalAkhir) {
            $query->whereBetween('created_at', [$tanggalMulai, $tanggalAkhir]); // Filter berdasarkan rentang tanggal
        }])->withSum(['detailPenjualan' => function ($query) use ($tanggalMulai, $tanggalAkhir) {
            $query->whereBetween('created_at', [$tanggalMulai, $tanggalAkhir]); // Filter berdasarkan rentang tanggal
        }], 'Jumlah')->get();

        $produkData = $produkData->map(function ($item) {
            $item->Jumlah = $item->detail_penjualan_sum_jumlah;
            unset($item->detail_penjualan_sum_jumlah);
            return $item;
        });

        // Normalisasi SAW
        $normalizedSaw = [
            'Harga_Satuan' => [],
            'Jumlah' => [],
            'Stok' => [],
        ];

        // Benefit (Harga Satuan, Total Terjual)
        $benefitCriteria = ['Harga_Satuan', 'Jumlah'];
        // Cost (Stok)
        $costCriteria = ['Stok'];

        // Normalisasi berdasarkan Benefit (untuk benefit kriteria semakin besar semakin baik)
        foreach ($produkData as $produk) {
            $hargaSatuan = $produk['Harga_Satuan'];
            $totalTerjual = $produk['Jumlah'];
            $Stok = $produk['Stok'];

            // Menormalisasi Harga Satuan dan Total Terjual (Benefit)
            $normalizedSaw['Harga_Satuan'][] = $hargaSatuan / max(array_column($produkData->toArray(), 'Harga_Satuan'));
            
            if (!max(array_column($produkData->toArray(), 'Jumlah'))) {
                $normalizedSaw['Jumlah'][] = 0;
            } else {
                $normalizedSaw['Jumlah'][] = $totalTerjual / max(array_column($produkData->toArray(), 'Jumlah'));
            }
            
            // Menormalisasi Stok (Cost)
            $normalizedSaw['Stok'][] = min(array_column($produkData->toArray(), 'Stok')) / $Stok;
        }
        
        // Menambahkan bobot
        $bobot = [
            'Harga_Satuan'  => $eigenVector[0], // Bobot untuk Harga Satuan
            'Jumlah'        => $eigenVector[1], // Bobot untuk Total Terjual
            'Stok'          => $eigenVector[2]         // Bobot untuk Stok
        ];

        // Inisialisasi array hasil SAW
        $sawResults = [];

        $bobotTerbaru = BobotCiRi::latest()->first();

        foreach ($produkData as $index => $produk) {
            $nilai = ($normalizedSaw['Harga_Satuan'][$index] * $bobot['Harga_Satuan']) +
            ($normalizedSaw['Stok'][$index] * $bobot['Stok']) +
            ($normalizedSaw['Jumlah'][$index] * $bobot['Jumlah']);
            
            $sawResults[] = [
                'produk'    => $produk['Nama_Produk'],
                'nilai'     => $nilai,
            ];
            
            HasilSaw::create([
                'Id_Bobot'  => $bobotTerbaru->id,
                'Nama_Produk' => $produk['Nama_Produk'],
                'Skor' => $nilai,
            ]);
        }

        usort($sawResults, function ($a, $b) {
            return $b['nilai'] <=> $a['nilai'];
        });

        return redirect()->route('TampilTPK')->with('success', 'Data berhasil disimpan.');
    }

    public function Detail($id){

        $HasilSaw = HasilSaw::with('bobot_ci_ri')->where('Id_Bobot', $id)->get();
        return view('TPK.DetailTPK', compact('HasilSaw'));
    }

    public function Delete($id)
    {
        // Find and delete the BobotCiRi record by ID
        $bobot = BobotCiRi::find($id);
        if ($bobot) {
            $bobot->delete();
        }

        // Find all associated HasilSaw records and delete each
        $hasilsaw = HasilSaw::where('Id_bobot', $id)->get();
        foreach ($hasilsaw as $hasil) {
            $hasil->delete();
        }

        // Redirect with success message
        return redirect()->route('TampilTPK')->with('success', 'Data Perhitungan TPK berhasil dihapus.');
    }
}
