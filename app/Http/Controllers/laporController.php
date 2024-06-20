<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang_masuk;

class laporController extends Controller
{
    //
    public function masuk()
    {
        $barang_masuk = barang_masuk::all();
        return view('lapor.laporan_masuk',compact('barang_masuk'));
    }
}
