<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang_masuk extends Model
{
    use HasFactory;
    protected $fillable = ['nama_barang','harga','stok','qty','kategori','no_transaksi','tanggal_masuk','total'];
}
