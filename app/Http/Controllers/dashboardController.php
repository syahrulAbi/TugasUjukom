<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\barang_masuk;
use App\Models\pengguna;
use App\Models\Category;

class dashboardController extends Controller
{
    //
    public function admin()
    {
        $barang_masuk = barang_masuk::count();
        $barang = barang::count();
        $pengguna = pengguna::count();
        $category = Category::count();
        return view('dashboard',compact('barang','pengguna','category','barang_masuk'));
    }
    public function gudang()
    {
        $barang_masuk = barang_masuk::all();
        $barang_masuk_jumlah = barang_masuk::count();
        return view('gudang.dashboard_gudang', compact('barang_masuk','barang_masuk_jumlah'));
    }
}
