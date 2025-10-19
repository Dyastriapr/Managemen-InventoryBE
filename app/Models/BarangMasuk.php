<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';

    protected $fillable = [
        'tanggal_masuk',
        'kode_barang',
        'jumlah_masuk',
        'penerima',
        'keterangan',
    ];
}
