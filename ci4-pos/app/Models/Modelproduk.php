<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelproduk extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'kodebarcode';

    protected $allowedFields = [
        'kodebarcode',
        'namaproduk',
        'produk_satid',
        'produk_katid',
        'stok_tersedia',
        'harga_beli',
        'harga_jual',
        'gambar'
    ];
}