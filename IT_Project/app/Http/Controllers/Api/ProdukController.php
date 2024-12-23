<?php

namespace App\Http\Controllers\Api;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all produk
        $produk = Produk::latest()->paginate(5);

        //return collection of produk as a resource
        return new ProdukResource(true, 'List Data Posts', $produk);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'Nama_Produk' => 'required',
            'Kategori' => 'required',
            'Harga_Satuan' => 'required|numeric',
            'Tanggal_Masuk' => 'required|date',
            'Stok' => 'required|numeric',
            'Keterangan' => 'nullable|string',
            'Id_Karyawan' => 'required|exists:karyawan,Id_Karyawan',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $produk = Produk::create($request->all());

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Ditambahkan!', $produk);
    }

    /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $produk = Produk::find($id);
        return new ProdukResource(true, 'Detail Data Produk!', $produk);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {

        //define validation rules
        $validator = Validator::make($request->all(), [
            'Nama_Produk' => 'required',
            'Kategori' => 'required',
            'Harga_Satuan' => 'required|numeric',
            'Tanggal_Masuk' => 'nullable|date',
            'Stok' => 'required',
            'Keterangan' => 'required|string',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $produk = Produk::find($id);

        //find post by ID
        $data = [
            'Nama_Produk' => $request->Nama_Produk,
            'Kategori' => $request->Kategori,
            'Harga_Satuan' => $request->Harga_Satuan,
            'Stok' => $request->Stok,
            'Shift_Kerja' => $request->Shift_Kerja,
            'Keterangan' => $request->Keterangan,
        ];
    
        $produk->update($data);

        return redirect()->route('produks.index')->with('success', 'Data Produk berhasil diperbarui.');

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Diubah!', $post);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find post by ID
        $produk = Produk::find($id);

        //delete post
        $produk->delete();

        //return response
        return new ProdukResource(true, 'Data Produk Berhasil Dihapus!', null);
    }
}