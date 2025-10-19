<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        $data = Barang::all();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:100',
            'stok_minimum' => 'required|integer|min:0',
            'stok_sekarang' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'lokasi_gudang' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'stok_minimum.required' => 'Stok minimum wajib diisi.',
            'stok_sekarang.required' => 'Stok sekarang wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
            'lokasi_gudang.required' => 'Lokasi gudang wajib diisi.',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validateData->errors()
            ], 422);
        }

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'stok_minimum' => $request->stok_minimum,
            'stok_sekarang' => $request->stok_sekarang,
            'satuan' => $request->satuan,
            'lokasi_gudang' => $request->lokasi_gudang,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Barang berhasil ditambahkan.'
        ], 201);
    }

    public function edit($id)
    {
        $data = Barang::find($id);
        return response()->json(['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $validateData = Validator::make($request->all(), [
            'nama_barang' => 'required|string|max:255',
            'kode_barang' => 'required|string|max:100',
            'stok_minimum' => 'required|integer|min:0',
            'stok_sekarang' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'lokasi_gudang' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'kode_barang.required' => 'Kode barang wajib diisi.',
            'stok_minimum.required' => 'Stok minimum wajib diisi.',
            'stok_sekarang.required' => 'Stok sekarang wajib diisi.',
            'satuan.required' => 'Satuan wajib diisi.',
            'lokasi_gudang.required' => 'Lokasi gudang wajib diisi.',
        ]);

        if ($validateData->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validateData->errors()
            ], 422);
        }

        $barang = Barang::where('id', $id)->first();
        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kode_barang' => $request->kode_barang,
            'stok_minimum' => $request->stok_minimum,
            'stok_sekarang' => $request->stok_sekarang,
            'satuan' => $request->satuan,
            'lokasi_gudang' => $request->lokasi_gudang,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Barang berhasil diperbarui.'
        ], 200);
    }
    public function destroy($id)
    {
        $barang = Barang::find($id);

        if (!$barang) {
            return response()->json([
                'status' => 'error',
                'message' => 'Barang tidak ditemukan.'
            ], 404);
        }

        $barang->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Barang berhasil dihapus.'
        ], 200);
    }
}
