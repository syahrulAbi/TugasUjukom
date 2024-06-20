<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\barang_masuk;
use App\Models\Category;

class barangMasukController extends Controller
{
    //
    public function index()
    {
        $barang = barang::all();
        $barang_masuk = barang_masuk::all();
        return view('gudang.data_barang_masuk', compact('barang', 'barang_masuk'));
    }

    public function create()
    {
        $barang = barang::all();
        $barang_masuk = barang_masuk::all();

        return view('gudang.create_data_barang_masuk', compact('barang', 'barang_masuk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'harga' => 'required|max:255',
            'stok' => 'required|max:255',
            'qty' => 'required|max:255',
            'kategori' => 'required|max:255',
            'no_transaksi' => 'required|max:255',
            'tanggal_masuk' => 'required|max:255',
            'total' => 'required|max:255',
        ]);

        barang_masuk::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'qty' => $request->qty,
            'kategori' => $request->kategori,
            'no_transaksi' => $request->no_transaksi,
            'tanggal_masuk' => $request->tanggal_masuk,
            'total' => $request->total,
        ]);

        return redirect()->route('barang_masuk.index')->with('success', 'berhasil.');
    }
    /* 
    public function update(Request $request, $id)
    {
        $request->validate([
            'qty' => 'required|max:255' . $id,
            'no_transaksi' => 'required|max:255' . $id,
            'tanggal_masuk' => 'required' . $id,
            'total' => 'required' . $id,
        ]);

        $barang_masuk = barang_masuk::find($id);
        $barang_masuk->qty = $request->qty;
        $barang_masuk->no_transaksi = $request->no_transaksi;
        $barang_masuk->tanggal_masuk = $request->tanggal_masuk;
        $barang_masuk->total = $request->total;
        $barang_masuk->save();

        return redirect()->route('barang_masuk.index')->with('success', 'berhasil.');
    }

    public function destroy($id)
    {
        $barang_masuk = barang_masuk::find($id);
        $barang_masuk->delete();

        return redirect()->route('barang_masuk.index')->with('success', 'berhasil.');
    } */
}
