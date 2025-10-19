<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    public function index()
    {
        $data = BarangMasuk::all();
        return response()->json(['data' => $data]);
    }

    public function store(Request $request)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'tanggal_masuk' => 'required|date',
                'kode_barang' => 'required|string|max:100',
                'jumlah_masuk' => 'required|integer',
                'penerima' => 'required|string|max:255',
                'keterangan' => 'nullable|string|max:50',
            ]);

            if ($validateData->fails()) {
                return response()->json([
                    'status' => 'error',
                    'errors' => $validateData->errors()
                ], 422);
            }

            $barangMasuk = BarangMasuk::create($validateData->validated());

            return response()->json([
                'status' => 'success',
                'message' => 'Data barang masuk berhasil ditambahkan.',
                'data' => $barangMasuk
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
